<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\WithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminWithdrawalController extends Controller
{
    public function index(Request $request)
    {
        $withdrawals = WithdrawalRequest::query()
            ->with('user')
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->date, function ($query, $date) {
                $query->whereDate('created_at', $date);
            })
            ->latest()
            ->paginate(10);

        return view('admin.withdrawals', compact('withdrawals'));
    }

    public function updateStatus(Request $request, $id)
    {
        $withdrawal = WithdrawalRequest::findOrFail($id);
        $request->validate(['status' => 'required|in:approved,rejected']);

        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'This request has already been processed.');
        }

        DB::transaction(function () use ($withdrawal, $request) {
            $withdrawal->update(['status' => $request->status]);

            if ($request->status === 'rejected') {
                $wallet = Wallet::where('user_id', $withdrawal->user_id)->first();
                $oldBalance = $wallet->balance;
                $wallet->increment('balance', $withdrawal->amount);

                WalletTransaction::create([
                    'wallet_id' => $wallet->id,
                    'amount' => $withdrawal->amount,
                    'type' => 'refund',
                    'description' => 'Refund for rejected withdrawal #' . $withdrawal->id,
                    'direction' => 'debit',
                    'status' => 'completed',
                    'balance_before' => $oldBalance,
                    'balance_after' => $wallet->balance,
                    'reference_type' => WithdrawalRequest::class,
                    'reference_id' => $withdrawal->id
                ]);
            }
        });

        return back()->with('success', 'Withdrawal request updated successfully!');
    }

    public function show($id)
    {
        $withdrawal = WithdrawalRequest::with('user')->findOrFail($id);
        return view('admin.withdrawalsShow', compact('withdrawal'));
    }
}
