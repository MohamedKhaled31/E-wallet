<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\TopUp;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wallet = $user->wallet;

        $txs = $wallet->transactions()->latest()->take(5)->get();

        $totalTopUps = WalletTransaction::where('wallet_id', $wallet->id)
            ->where('type', 'top_up')
            ->where('status', 'completed')
            ->sum('amount');

        return view('wallet.index', compact('wallet', 'txs', 'totalTopUps'));
    }
}
