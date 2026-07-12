<div class="p-6">
    <div class="flex items-center gap-3 mb-10">
        <div class="bg-blue-600 text-white p-2.5 rounded-xl shadow-md shadow-blue-200">
            <i class="fa-solid fa-wallet text-xl"></i>
        </div>
        <div>
            <h1 class="font-bold text-lg leading-tight text-gray-900">MyWallet</h1>
        </div>
    </div>

    <nav class="space-y-1">
        <a href="{{ route('wallet.index') }}"
           class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('wallet.index') ? 'text-blue-600 bg-blue-50/60 font-semibold' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }} rounded-xl transition-all">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>
        <a href="{{ route('wallet.topup.show') }}"
           class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('wallet.topup.show') ? 'text-blue-600 bg-blue-50/60 font-semibold' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }} rounded-xl transition-all">
            <i class="fa-solid fa-circle-plus"></i> Top Up
        </a>
        <a href="{{ route('transfer.show') }}"
           class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('transfer.show') ? 'text-blue-600 bg-blue-50/60 font-semibold' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }} rounded-xl transition-all">
            <i class="fa-solid fa-arrows-left-right"></i> Transfer
        </a>
        <a href="{{ route('transactions.index') }}"
           class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('wallet.transactions*') ? 'text-blue-600 bg-blue-50/60 font-semibold' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }} rounded-xl transition-all">
            <i class="fa-solid fa-receipt"></i> Transactions
        </a>
        <a href="{{ route('wallet.withdraw.show') }}"
           class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('wallet.withdraw*') ? 'text-blue-600 bg-blue-50/60 font-semibold' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }} rounded-xl transition-all">
            <i class="fa-solid fa-arrow-down"></i> Withdraw
        </a>
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('profile.edit') ? 'text-blue-600 bg-blue-50/60 font-semibold' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }} rounded-xl transition-all">
            <i class="fa-solid fa-user"></i> Profile
        </a>
    </nav>
</div>
<div class="p-6 border-t border-gray-50">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit"
                class="w-full flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 font-medium rounded-xl transition-all">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
        </button>
    </form>
</div>
