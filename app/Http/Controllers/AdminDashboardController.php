<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard');
    }

    public function index()
{
    $data = [
        'totalUsers' => User::where('role', '!=', 'admin')->count(),
        'totalBalances' => Wallet::sum('balance'),
        'totalTopUps' => WalletTransaction::where('type', 'topup')->sum('amount'),
        'totalTransfers' => Transfer::count(),
        'pendingWithdrawals' => WithdrawalRequest::where('status', 'pending')->count(),
    ];

    $recentWithdrawals = WithdrawalRequest::with('user')->latest()->take(5)->get();

    return view('admin.dashboard', compact('data', 'recentWithdrawals'));
}

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
