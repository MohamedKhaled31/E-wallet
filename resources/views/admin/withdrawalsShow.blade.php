@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto py-8 px-4">
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-start mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Request Details: #{{ str_pad($withdrawal->id, 5, '0', STR_PAD_LEFT) }}</h2>
            <span class="px-4 py-1.5 rounded-full text-sm font-bold
                {{ $withdrawal->status == 'approved' ? 'bg-green-100 text-green-700' :
                   ($withdrawal->status == 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                {{ ucfirst($withdrawal->status) }}
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="space-y-4">
                <div><p class="text-sm text-gray-500">User</p><p class="font-semibold text-lg">{{ $withdrawal->user->name }}</p></div>
                <div><p class="text-sm text-gray-500">Email</p><p class="font-medium text-gray-900">{{ $withdrawal->user->email }}</p></div>
            </div>
            <div class="space-y-4">
                <div><p class="text-sm text-gray-500">Amount</p><p class="font-bold text-xl text-blue-600">EGP {{ number_format($withdrawal->amount, 2) }}</p></div>
                <div><p class="text-sm text-gray-500">Method</p><p class="font-medium text-gray-900">{{ ucfirst($withdrawal->method) }}</p></div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-100 flex gap-4">
            <a href="{{ route('admin.withdrawals.index') }}" class="px-6 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl font-medium">Back</a>

            @if($withdrawal->status == 'pending')
                <form action="{{ route('admin.withdrawals.update', $withdrawal->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium transition">Approve Request</button>
                </form>

                <form action="{{ route('admin.withdrawals.update', $withdrawal->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl font-medium transition">Reject Request</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
