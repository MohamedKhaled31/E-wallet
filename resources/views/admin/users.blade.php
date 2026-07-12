@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Users</h2>

        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-6 flex justify-between items-center">
            <form action="{{ route('admin.users.index') }}" method="GET" class="relative w-full md:w-96">
                <input type="text" name="search" placeholder="Search by name, email or phone..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400"></i>
            </form>
            <button class="px-4 py-2 border border-gray-200 rounded-xl text-sm font-medium hover:bg-gray-50">
                <i class="fa-solid fa-download mr-2"></i> Export
            </button>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">User</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Phone</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Joined Date</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-6 py-4 flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <span class="font-semibold text-gray-900">{{ $user->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $user->phone ?? '+20 100 000 0000' }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-bold
                            {{ $user->status == 'active' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.users.show', $user->id) }}"
                                    class="text-blue-600 hover:text-blue-900">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-6 border-t border-gray-100">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
