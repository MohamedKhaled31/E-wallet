@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold text-gray-900">User Details</h1>
        <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-gray-900">← Back to Users</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 col-span-2 flex items-center gap-6">
            <div class="w-20 h-20 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-2xl">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">{{ $user->name }}</h2>
                <p class="text-gray-500">{{ $user->email }}</p>
                <p class="text-gray-400 text-sm">Joined: {{ $user->created_at->format('d M Y') }}</p>
            </div>
        </div>

        <div class="bg-blue-600 p-6 rounded-3xl shadow-lg text-white">
            <p class="text-blue-100 text-sm">Current Balance</p>
            <h3 class="text-3xl font-bold mt-1">EGP {{ number_format($user->wallet->balance ?? 0, 2) }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50">
            <h2 class="font-bold text-lg text-gray-900">Transaction History</h2>
        </div>
        <table class="w-full text-left">
            <thead class="bg-gray-50/50">
                <tr>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Type</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Amount</th>
                    <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($user->wallet->transactions ?? [] as $transaction)
                <tr>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ ucfirst($transaction->type) }}</td>
                    <td class="px-6 py-4 {{ $transaction->amount > 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $transaction->amount > 0 ? '+' : '' }}{{ number_format($transaction->amount, 2) }}
                    </td>
                    <td class="px-6 py-4 text-gray-500">{{ $transaction->created_at->format('d M Y, h:i A') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-400">No transactions found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
