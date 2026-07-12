@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Withdraw Requests</h2>
            <p class="text-sm text-gray-500">Manage and monitor all user withdrawal requests.</p>
        </div>

        <form action="{{ route('admin.withdrawals.index') }}" method="GET"
            class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-6 flex flex-wrap gap-4 items-center">

            <div class="flex-1 min-w-[250px]">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by user name, email or ID..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <div class="flex gap-2">
                <select name="status" onchange="this.form.submit()"
                    class="border border-gray-200 rounded-xl px-4 py-2 text-sm text-gray-700 focus:outline-none">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>

                <input type="date" name="date" value="{{ request('date') }}" onchange="this.form.submit()"
                    class="border border-gray-200 rounded-xl px-4 py-2 text-sm text-gray-700 focus:outline-none">
            </div>
        </form>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">User</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Amount</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Method</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Account</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($withdrawals as $w)
                            <tr class="hover:bg-gray-50/50 transition duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    #{{ str_pad($w->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4 flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center text-xs font-bold">
                                        {{ strtoupper(substr($w->user->name, 0, 2)) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-gray-900">{{ $w->user->name }}</span>
                                        <span class="text-xs text-gray-400">{{ $w->user->email }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm font-bold text-gray-700">EGP
                                    {{ number_format($w->amount, 2) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <i class="fa-solid fa-wallet text-blue-500 mr-1"></i> {{ ucfirst($w->method) }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 font-mono">
                                    {{ $w->account_details['number'] ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $w->created_at->format('d M Y') }}
                                    <div class="text-xs text-gray-400">{{ $w->created_at->format('h:i A') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold
                                {{ $w->status == 'approved'
                                    ? 'bg-green-100 text-green-700'
                                    : ($w->status == 'pending'
                                        ? 'bg-amber-100 text-amber-700'
                                        : ($w->status == 'rejected'
                                            ? 'bg-red-100 text-red-700'
                                            : 'bg-blue-100 text-blue-700')) }}">
                                        {{ ucfirst($w->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('admin.withdrawals.show', $w->id) }}"
                                        class="text-gray-400 hover:text-indigo-600 transition duration-200"
                                        title="View Details">
                                        <i class="fa-solid fa-eye text-lg"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-gray-400">No withdrawal requests
                                    found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-gray-100">
                {{ $withdrawals->links() }}
            </div>
        </div>
    </div>
@endsection
