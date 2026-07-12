@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r shadow-sm">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r shadow-sm">
                <p class="font-medium">{{ $errors->first() }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-slate-900 text-white rounded-2xl p-6 shadow-xl shadow-slate-200">
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Available Balance</p>
                <h2 class="text-3xl font-bold mt-2">{{ number_format($wallet->balance, 0) }} EGP</h2>
                <div class="mt-4 flex items-center">
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-500/20 text-green-400">
                        {{ ucfirst($wallet->status) }}
                    </span>
                </div>
            </div>

            <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Total Top-Ups</p>
                <h2 class="text-2xl font-bold text-slate-800 mt-2">{{ number_format($totalTopUps, 0) }} EGP</h2>
            </div>

            <div class="flex items-center">
                <a href="{{ url('/transfer') }}"
                    class="w-full h-full flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl transition-all shadow-lg hover:shadow-blue-200">
                    + New Transfer
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-50 flex justify-between items-center">
                <h3 class="font-bold text-slate-800">Recent Transactions</h3>
                <a href="{{ route('transactions.index') }}"
                    class="text-sm text-blue-600 font-semibold hover:underline">View All</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50">
                        <tr class="text-slate-400 text-xs uppercase tracking-wider">
                            <th class="px-6 py-4">Type</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4 text-right">Amount</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($txs as $tx)
                            <tr class="hover:bg-slate-50 transition-colors cursor-pointer"
                                onclick="window.location='{{ route('transactions.show', $tx->id) }}';">

                                <td class="px-6 py-4 text-sm font-medium text-slate-800">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full flex items-center justify-center {{ $tx->direction == 'credit' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                            <i
                                                class="fa-solid {{ $tx->type == 'top_up' ? 'fa-arrow-down' : ($tx->type == 'withdraw' ? 'fa-arrow-up' : 'fa-paper-plane') }} text-xs"></i>
                                        </div>
                                        <span class="capitalize">{{ str_replace('_', ' ', $tx->type) }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm text-slate-600">{{ $tx->created_at->format('M d, h:i A') }}
                                </td>

                                <td
                                    class="px-6 py-4 text-right font-bold {{ $tx->direction === 'credit' ? 'text-green-600' : 'text-slate-900' }}">
                                    {{ $tx->direction === 'credit' ? '+' : '-' }} {{ number_format($tx->amount, 0) }}
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 rounded-full text-[10px] font-bold
                    {{ $tx->direction === 'credit' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ strtoupper($tx->direction) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-slate-400">No transactions yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
