<?php
namespace App\Services;

use App\Models\Wallet;
use App\Models\WithdrawalRequest;
use Illuminate\Support\Facades\DB;
use Exception;

class WithdrawService
{
    public function execute(int $userId, Wallet $wallet, float $amount, string $method, array $accountDetails)
{
    if ($wallet->balance < $amount) {
        throw new Exception("Insufficient balance for withdrawal.");
    }

    return DB::transaction(function () use ($userId, $wallet, $amount, $method, $accountDetails) {

        $withdrawalRequest = WithdrawalRequest::create([
            'user_id' => $userId,
            'wallet_id' => $wallet->id,
            'amount' => $amount,
            'method' => $method,
            'account_details' => $accountDetails,
            'status' => 'pending'
        ]);

        $oldBalance = $wallet->balance;
        $wallet->decrement('balance', $amount);

        $wallet->transactions()->create([
            'type' => 'withdraw',
            'direction' => 'debit',
            'amount' => $amount,
            'status' => 'pending',
            'balance_before' => $oldBalance,
            'balance_after' => $wallet->balance,
            'reference_type' => WithdrawalRequest::class,
            'reference_id' => $withdrawalRequest->id
        ]);

        return $withdrawalRequest;
    });
}
}
