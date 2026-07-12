@extends('layouts.app')

@section('title', 'Transaction Details')

@section('content')
    <div class="max-w-2xl mx-auto py-10">
        <a href="{{ route('transactions.index') }}"
           class="inline-flex items-center text-sm text-gray-500 hover:text-blue-600 mb-6 transition">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back to History
        </a>

        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-900">Transaction Details</h2>
                <span
                    class="px-3 py-1 rounded-full text-xs font-semibold
    {{ $transaction->status == 'completed'
        ? 'bg-emerald-50 text-emerald-700'
        : ($transaction->status == 'pending'
            ? 'bg-amber-50 text-amber-700'
            : 'bg-red-50 text-red-700') }}">
                    {{ ucfirst($transaction->status) }}
                </span>
            </div>

            <div class="space-y-6">
                <div class="flex justify-between items-center border-b border-gray-50 pb-4">
                    <span class="text-gray-500">Transaction Type</span>
                    <span
                        class="font-semibold text-gray-800 capitalize">{{ str_replace('_', ' ', $transaction->type) }}</span>
                </div>

                <div class="flex justify-between items-center border-b border-gray-50 pb-4">
                    <span class="text-gray-500">Amount</span>
                    <span
                        class="text-2xl font-black {{ $transaction->direction == 'credit' ? 'text-green-600' : 'text-gray-900' }}">
                        {{ $transaction->direction == 'credit' ? '+' : '-' }}{{ number_format($transaction->amount, 2) }}
                    </span>
                </div>

                <div class="flex justify-between items-center border-b border-gray-50 pb-4">
                    <span class="text-gray-500">Date & Time</span>
                    <span
                        class="font-medium text-gray-800">{{ $transaction->created_at->format('M d, Y - h:i A') }}</span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Reference ID</span>
                    <span
                        class="font-mono text-sm bg-gray-50 px-3 py-1 rounded-lg text-gray-600">{{ $transaction->id }}</span>
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-gray-100">
                <button onclick="window.print()"
                        class="w-full flex items-center justify-center gap-2 py-3 border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 transition">
                    <i class="fa-solid fa-print"></i> Print Receipt
                </button>
            </div>
        </div>
    </div>
@endsection
