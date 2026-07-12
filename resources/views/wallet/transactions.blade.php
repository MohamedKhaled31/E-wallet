@extends('layouts.app')

@section('title', 'Transaction History')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900">Transaction History</h2>
                <p class="text-gray-500">View and manage your recent wallet activities.</p>
            </div>
        </div>

        <div class="flex items-center gap-2 mb-6 p-1 bg-gray-100 rounded-xl inline-flex">
            @php $filters = ['' => 'All', 'top_up' => 'Top Ups', 'transfer' => 'Transfers']; @endphp
            @foreach ($filters as $key => $label)
                <a href="{{ route('transactions.index', $key ? ['type' => $key] : []) }}"
                    class="px-5 py-2 rounded-lg text-sm font-medium transition-all {{ request('type') == $key || (!request('type') && !$key) ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Transaction</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Description</th>
                        <th class="px-6 py-5 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Balance Before</th>
                        <th class="px-6 py-5 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            Balance After</th>
                        <th class="px-6 py-5 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount
                        </th>
                        <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($transactions as $tx)
                        <tr class="hover:bg-blue-50/50 transition duration-200 cursor-pointer group"
                            onclick="window.location='{{ route('transactions.show', $tx->id) }}';">

                            <td class="px-6 py-6">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full flex items-center justify-center {{ $tx->direction == 'credit' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                        <i
                                            class="fa-solid {{ $tx->type == 'top_up' ? 'fa-arrow-down' : 'fa-paper-plane' }}"></i>
                                    </div>
                                    <div class="font-bold text-gray-900 capitalize">{{ str_replace('_', ' ', $tx->type) }}
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-6 text-sm text-gray-600 italic">
                                @if ($tx->type == 'transfer' && $tx->reference_id)
                                    @php
                                        $transfer = \App\Models\Transfer::find($tx->reference_id);
                                        $receiver = $transfer ? \App\Models\User::find($transfer->receiver_id) : null;
                                    @endphp

                                    Transferred to
                                    {{ $receiver ? $receiver->name : 'User #' . ($transfer->receiver_id ?? '') }}
                                @else
                                    {{ $tx->description ?? 'No description provided' }}
                                @endif
                            </td>

                            <td class="px-6 py-6 text-right text-sm text-gray-500 font-mono">
                                {{ number_format($tx->balance_before, 2) }}</td>

                            <td class="px-6 py-6 text-right text-sm text-gray-900 font-bold font-mono">
                                {{ number_format($tx->balance_after, 2) }}</td>

                            <td class="px-6 py-6 text-right font-bold text-lg text-gray-900">
                                {{ $tx->direction == 'credit' ? '+' : '-' }}{{ number_format($tx->amount, 2) }}
                            </td>

                            <td class="px-6 py-6">
                                @php
                                    $statusColors = [
                                        'completed' => 'bg-emerald-50 text-emerald-700',
                                        'pending' => 'bg-amber-50 text-amber-700',
                                        'rejected' => 'bg-red-50 text-red-700',
                                    ];
                                @endphp
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$tx->status] ?? 'bg-gray-50 text-gray-700' }}">
                                    {{ ucfirst($tx->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $transactions->links() }}
        </div>
    </div>
@endsection
