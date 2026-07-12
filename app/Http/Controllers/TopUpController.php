<?php

namespace App\Http\Controllers;

use App\Models\TopUp;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class TopUpController extends Controller
{
    public function show()
    {
        return view('wallet.topup');
    }

    public function createSession(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $wallet = auth()->user()->wallet;
        $amount = $request->amount;

        $userEmail = auth()->user()->email;

        $session = Session::create([
            'payment_method_types' => ['card'],

            'customer_email' => $userEmail,

            'line_items' => [[
                'price_data' => [
                    'currency' => 'egp',
                    'product_data' => ['name' => 'Wallet Top-up'],
                    'unit_amount' => $amount * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('wallet.topup.success', ['amount' => $amount, 'wallet_id' => $wallet->id]),
            'cancel_url' => route('wallet.topup.show'),
        ]);

        return redirect($session->url);
    }

    public function handleSuccess(Request $request)
    {
        $amount = $request->amount;
        $walletId = $request->wallet_id;

        DB::transaction(function () use ($amount, $walletId) {
            $topUp = TopUp::create([
                'user_id' => Wallet::findOrFail($walletId)->user_id,
                'wallet_id' => $walletId,
                'amount' => $amount,
                'status' => 'paid',
            ]);
            $wallet = Wallet::findOrFail($walletId);

            $balanceBefore = $wallet->balance;
            $balanceAfter = $wallet->balance + $amount;

            $wallet->increment('balance', $amount);

            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'type' => 'top_up',
                'direction' => 'credit',
                'amount' => $amount,
                'balance_before' => $balanceBefore,
                'balance_after' => $balanceAfter,
                'description' => 'Wallet top-up via Payment Gateway',
                'status' => 'completed',
                'reference_type' => 'TopUp',
                'reference_id' => $topUp->id,
            ]);
        });

        return redirect()->route('wallet.index')->with('success', 'Top-up successful!.');
    }
}
