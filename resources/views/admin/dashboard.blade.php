@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        @php
            $stats = [
                ['title' => 'Total Users', 'value' => $data['totalUsers'], 'icon' => 'fa-users', 'bg' => 'bg-blue-50', 'text' => 'text-blue-600'],
                ['title' => 'Total Balance', 'value' => 'EGP ' . number_format($data['totalBalances'], ), 'icon' => 'fa-wallet', 'bg' => 'bg-green-50', 'text' => 'text-green-600'],
                ['title' => 'Total Transactions', 'value' => $data['totalTransfers'], 'icon' => 'fa-right-left', 'bg' => 'bg-purple-50', 'text' => 'text-purple-600'],
                ['title' => 'Pending Withdrawals', 'value' => $data['pendingWithdrawals'], 'icon' => 'fa-clock-rotate-left', 'bg' => 'bg-orange-50', 'text' => 'text-orange-600'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-4 transition hover:shadow-md">
            <div class="{{ $stat['bg'] }} {{ $stat['text'] }} p-4 rounded-2xl">
                <i class="fa-solid {{ $stat['icon'] }} text-lg"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">{{ $stat['title'] }}</p>
                <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $stat['value'] }}</h3>
            </div>
        </div>
        @endforeach
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
            <h2 class="font-bold text-lg text-gray-900">Recent Withdraw Requests</h2>
            <a href="{{ route('admin.withdrawals.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">View All Withdraw Requests</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Method</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Account / Wallet</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($recentWithdrawals as $withdrawal)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-sm border border-indigo-100">
                                {{ strtoupper(substr($withdrawal->user->name, 0, 2)) }}
                            </div>
                            <span class="font-semibold text-gray-900">{{ $withdrawal->user->name }}</span>
                        </td>
                        <td class="px-6 py-4 text-gray-900 font-medium">EGP {{ number_format($withdrawal->amount, 2) }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center text-gray-600">
                                <i class="fa-solid fa-wallet text-blue-400 mr-2"></i> {{ ucfirst($withdrawal->method) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-mono text-sm">
                            {{ $withdrawal->account_details['number'] ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-gray-500 text-sm">
                            {{ $withdrawal->created_at->format('d M Y') }}<br>
                            <span class="text-xs text-gray-400">{{ $withdrawal->created_at->format('h:i A') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                {{ $withdrawal->status == 'approved' ? 'bg-green-100 text-green-700' :
                                   ($withdrawal->status == 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                                {{ ucfirst($withdrawal->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.users.show', $withdrawal->user->id) }}"
                                    class="text-blue-600 hover:text-blue-900">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
