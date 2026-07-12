<?php

namespace App\Services;

use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class TopUpService
{
    public function execute(Wallet $wallet, float $amount)
    {
        return DB::transaction(function () use ($wallet, $amount) {
            $wallet->increment('balance', $amount);

            return $wallet->transactions()->create([
                'amount' => $amount,
                'type'   => 'topup',
                'status' => 'completed',
            ]);
        });
    }
}
