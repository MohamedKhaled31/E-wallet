@extends('layouts.app')

@section('title', 'Withdraw Funds')

@section('content')

    @if ($errors->any())
        <div class="bg-red-50 text-red-600 p-4 rounded-xl text-xs mb-4">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="max-w-xl mx-auto py-10">
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
            <h2 class="text-2xl font-bold mb-6">Withdraw Funds</h2>

            <form action="{{ route('wallet.withdraw.process') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                    <input type="number" name="amount" class="w-full p-4 rounded-xl border border-gray-200"
                        placeholder="0.00" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Withdrawal Method</label>
                    <select name="method" class="w-full p-4 rounded-xl border border-gray-200" required>
                        <option value="Bank transfer">Bank Transfer</option>
                        <option value="Vodafone Cash">Vodafone Cash</option>
                        <option value="Instapay">Instapay</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Account Details (Number/IBAN)</label>
                    <input type="text" name="account_details[number]"
                        class="w-full p-4 rounded-xl border border-gray-200" placeholder="Enter your account number"
                        required>
                </div>

                <button type="submit"
                    class="w-full py-4 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition">
                    Confirm Withdrawal
                </button>
            </form>
        </div>
        <div class="mt-8 p-4 bg-amber-50 border border-amber-100 rounded-xl text-amber-700 text-sm flex items-start gap-3">
            <i class="fa-solid fa-circle-info mt-0.5"></i>
            <div>
                <span class="font-bold block mb-1">Important Note:</span>
                All withdrawal requests are subject to admin review. Your request status will remain "Pending" until it is
                approved and processed.
            </div>
        </div>
    </div>
@endsection
