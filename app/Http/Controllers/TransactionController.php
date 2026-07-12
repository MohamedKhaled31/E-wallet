<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;


class TransactionController extends Controller
{
    public function index(TransactionRequest $request)
    {
        $query = auth()->user()->wallet->transactions()->latest();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('ref')) {
            $query->where('reference_id', $request->ref);
        }

        $transactions = $query->paginate(15)->withQueryString();

        return view('wallet.transactions', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = auth()->user()->wallet->transactions()
            ->findOrFail($id);

        return view('wallet.transaction-details', compact('transaction'));
    }
}
