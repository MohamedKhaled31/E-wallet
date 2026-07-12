<?php
namespace App\Services;

use App\Models\Wallet;
use App\Models\Transfer;
use Illuminate\Support\Facades\DB;

class TransferService
{
    public function execute(Wallet $senderWallet, Wallet $receiverWallet, float $amount, int $senderId, int $receiverId)
    {
        return DB::transaction(function () use ($senderWallet, $receiverWallet, $amount, $senderId, $receiverId) {

            $transfer = Transfer::create([
                'sender_id' => $senderId,
                'sender_wallet_id' => $senderWallet->id,
                'receiver_id' => $receiverId,
                'receiver_wallet_id' => $receiverWallet->id,
                'amount' => $amount,
                'reference' => uniqid('TRX-'),
            ]);

            $senderWallet->decrement('balance', $amount);
            $receiverWallet->increment('balance', $amount);

            $senderWallet->transactions()->create([
                'type' => 'transfer_out',
                'direction' => 'debit',
                'amount' => $amount,
                'balance_before' => $senderWallet->balance + $amount,
                'balance_after' => $senderWallet->balance,
                'reference_type' => Transfer::class,
                'reference_id' => $transfer->id
            ]);

            $receiverWallet->transactions()->create([
                'type' => 'transfer_in',
                'direction' => 'credit',
                'amount' => $amount,
                'balance_before' => $receiverWallet->balance - $amount,
                'balance_after' => $receiverWallet->balance,
                'reference_type' => Transfer::class,
                'reference_id' => $transfer->id
            ]);

            return $transfer;
        });
    }
}
