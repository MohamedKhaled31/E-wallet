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
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600 bg-blue-50/60 font-semibold' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }} rounded-xl transition-all">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>
        <a href="{{ route('admin.users.index') }}"
           class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.users.*') ? 'text-blue-600 bg-blue-50/60 font-semibold' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }} rounded-xl transition-all">
            <i class="fa-solid fa-users"></i> Users
        </a>
        <a href="{{ route('admin.withdrawals.index') }}"
           class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.withdrawals.*') ? 'text-blue-600 bg-blue-50/60 font-semibold' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }} rounded-xl transition-all">
            <i class="fa-solid fa-file-invoice-dollar"></i> Withdraw Requests
        </a>
    </nav>
</div>
<div class="p-6 border-t border-gray-50">
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit"
                class="w-full flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 font-medium rounded-xl transition-all">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
        </button>
    </form>
</div>
