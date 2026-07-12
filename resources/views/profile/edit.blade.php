@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-900">Profile Settings</h2>
        <p class="text-slate-500 text-sm mt-1">Manage your personal information and security.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8">

            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Full Name</label>
                        <input type="text" name="name" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ $user->name }}" required>
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Email Address</label>
                        <input type="email" name="email" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ $user->email }}" required>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Phone Number</label>
                        <input type="text" name="phone" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" value="{{ $user->phone }}" required>
                    </div>
                </div>

                <div class="border-t border-slate-100 my-8"></div>

                <div class="mb-6">
                    <h3 class="text-md font-bold text-slate-900 mb-1">Change Password</h3>
                    <p class="text-slate-400 text-xs mb-4">Leave blank if you don't want to change it.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">New Password</label>
                            <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="••••••••">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-slate-200">
                    Save Changes
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
