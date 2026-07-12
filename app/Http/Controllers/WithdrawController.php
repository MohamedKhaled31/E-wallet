<?php

namespace App\Http\Controllers;

use App\Http\Requests\WithdrawRequest;
use App\Services\WithdrawService;

class WithdrawController extends Controller
{
    protected $withdrawService;

    public function __construct(WithdrawService $withdrawService)
    {
        $this->withdrawService = $withdrawService;
    }

    public function show()
    {
        return view('wallet.withdraw');
    }

    public function store(WithdrawRequest $request)
    {
        $wallet = auth()->user()->wallet;

        try {
            $this->withdrawService->execute(
                auth()->id(),
                $wallet,
                $request->amount,
                $request->method,
                $request->account_details
            );

            return redirect()->route('transactions.index')
                             ->with('success', 'Withdrawal submitted for processing!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
