@extends('layouts.app')

@section('title', 'Transfer Funds')


@section('content')
    <div class="max-w-md mx-auto py-12 px-4">
        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
            <h2 class="text-2xl font-bold text-slate-900 mb-6 text-center">Transfer Funds</h2>

            @if (session('success'))
                <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-4 text-sm">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-4 text-sm">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('transfer.store') }}" method="POST" id="transferForm" x-data="{ openModal: false, amount: '' }">
                @csrf
                <div class="space-y-4">
                    <input type="email" name="receiver_email" placeholder="Receiver Email Address" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200">
                    <label class="block text-sm font-semibold text-slate-600 mt-4">Select Amount</label>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach ([100, 500, 1000, 2000, 3000, 5000] as $preset)
                            <button type="button" @click="amount = '{{ $preset }}'"
                                :class="amount == '{{ $preset }}' ? 'bg-blue-600 text-white' :
                                    'bg-slate-100 text-slate-700'"
                                class="py-2 rounded-xl font-bold text-sm transition">
                                {{ $preset }}
                            </button>
                        @endforeach
                    </div>

                    <input type="number" name="amount" x-model="amount" placeholder="Or enter custom amount" required
                        min="10" class="w-full px-4 py-3 rounded-xl border border-slate-200">
                    <div class="space-y-4">
                        <input type="text" name="reference" placeholder="Add a note (optional)"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200">
                    </div>
                </div>

                <button type="button"
                    @click="if(document.getElementById('transferForm').checkValidity()) { openModal = true } else { document.getElementById('transferForm').reportValidity() }"
                    class="w-full mt-6 bg-slate-900 text-white py-4 rounded-xl font-bold hover:bg-slate-800 transition">
                    Transfer Now
                </button>

                <div x-show="openModal" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50">
                    <div @click.away="openModal = false"
                        class="bg-white p-6 rounded-3xl max-w-sm w-full text-center shadow-2xl">
                        <h3 class="font-bold text-lg mb-2">Confirm Transfer</h3>
                        <p class="text-slate-500 mb-6">Are you sure you want to transfer <span x-text="amount"></span> EGP?
                        </p>
                        <div class="flex gap-3">
                            <button type="button" @click="openModal = false"
                                class="flex-1 py-3 bg-gray-100 rounded-xl hover:bg-gray-200">Cancel</button>
                            <button type="submit"
                                class="flex-1 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700">Confirm</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
