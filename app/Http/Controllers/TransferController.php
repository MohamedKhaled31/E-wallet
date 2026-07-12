<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferRequest;
use App\Services\WalletService;
use Illuminate\Support\Facades\Auth;
use Exception;

class TransferController extends Controller
{
    protected $service;

    public function __construct(WalletService $service)
    {
        $this->service = $service;
    }

    public function show(){
        return view('wallet.transfer');
    }

    public function store(TransferRequest $request)
    {
        try {
            $this->service->makeTransfer(Auth::id(), $request->receiver_email, $request->amount, $request->reference);
            return back()->with('success', 'Transfer completed successfully!');
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
