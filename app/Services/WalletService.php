<?php

namespace App\Services;

use App\Models\Transfer;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Exception;
use Illuminate\Support\Facades\DB;

class WalletService
{
    public function makeTransfer(int $senderId, string $receiverEmail, float $amount, ?string $ref = null): Transfer
    {
        return DB::transaction(function () use ($senderId, $receiverEmail, $amount, $ref) {

            $receiver = User::where('email', $receiverEmail)->firstOrFail();
            $receiverId = $receiver->id;

            $sWallet = Wallet::where('user_id', $senderId)->lockForUpdate()->firstOrFail();
            $rWallet = Wallet::where('user_id', $receiverId)->lockForUpdate()->firstOrFail();

            if ($sWallet->status === 'frozen') throw new Exception('Your wallet is frozen.');
            if ($rWallet->status === 'frozen') throw new Exception('Receiver wallet is frozen.');
            if ($sWallet->balance < $amount) throw new Exception('Insufficient wallet balance.');
            if ($senderId === $receiverId) throw new Exception('You cannot transfer money to yourself.');
            if ($amount < 10) throw new Exception('Minimum transfer amount is 10 EGP.');

            $sBefore = $sWallet->balance;
            $rBefore = $rWallet->balance;

            $sWallet->decrement('balance', $amount);
            $rWallet->increment('balance', $amount);

            $sAfter = $sWallet->balance;
            $rAfter = $rWallet->balance;

            $transfer = Transfer::create([
                'sender_id' => $senderId,
                'sender_wallet_id' => $sWallet->id,
                'receiver_id' => $receiverId,
                'receiver_wallet_id' => $rWallet->id,
                'amount' => $amount,
                'reference' => $ref,
                'status' => 'completed',
            ]);

            $transfer->transactions()->createMany([
                [
                    'wallet_id' => $sWallet->id,
                    'related_wallet_id' => $rWallet->id,
                    'type' => 'transfer',
                    'direction' => 'debit',
                    'amount' => $amount,
                    'balance_before' => $sBefore,
                    'balance_after' => $sAfter,
                    'description' => "Transferred to User #" . $receiverId,
                    'status' => 'completed'
                ],
                [
                    'wallet_id' => $rWallet->id,
                    'related_wallet_id' => $sWallet->id,
                    'type' => 'transfer',
                    'direction' => 'credit',
                    'amount' => $amount,
                    'balance_before' => $rBefore,
                    'balance_after' => $rAfter,
                    'description' => "Received from User #" . $senderId,
                    'status' => 'completed'
                ]
            ]);

            return $transfer;
        });
    }
}
