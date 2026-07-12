@extends('layouts.app')

@section('title', 'Top Up Balance')


@section('content')
<div class="max-w-md mx-auto py-12 px-4">
    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-slate-900">Top Up Balance</h2>
            <p class="text-slate-500 text-sm mt-1">Select an amount or enter your own</p>
        </div>

        <form action="{{ route('stripe.pay') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-600 mb-3">Quick Select</label>
                <div class="grid grid-cols-3 gap-3">
                    @foreach([100, 500, 1000, 2000, 3000, 5000] as $amount)
                        <button type="button"
                                onclick="setAmount({{ $amount }})"
                                class="bg-slate-50 hover:bg-blue-50 text-slate-700 hover:text-blue-600 font-bold py-2 rounded-xl border border-slate-200 transition-all text-sm">
                            {{ $amount }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-600 mb-2">Or enter amount (EGP)</label>
                <div class="relative">
                    <span class="absolute left-4 top-3.5 text-slate-400">EGP</span>
                    <input type="number" name="amount" id="amountInput" min="50" step="1"
                           class="w-full pl-16 pr-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none transition"
                           placeholder="0.00" required>
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-slate-200 flex items-center justify-center gap-2">
                Pay with Card
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </form>
    </div>
</div>

<script>
function setAmount(value) {
    document.getElementById('amountInput').value = value;
}
</script>
@endsection
