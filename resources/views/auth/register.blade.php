<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - MyWallet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md p-8 bg-white rounded-3xl border border-gray-100 shadow-sm">
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <i class="fa-solid fa-wallet text-3xl"></i>
        </div>

        <h2 class="text-2xl font-bold text-gray-900">Create Account</h2>
        <p class="text-gray-500 text-sm mt-1">Start your journey with MyWallet</p>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 text-red-600 p-4 rounded-xl text-xs mb-4">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="text-xs font-semibold text-gray-500 block mb-2">Full Name</label>
            <input type="text" name="name" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none" required>
        </div>

        <div>
            <label class="text-xs font-semibold text-gray-500 block mb-2">Email Address</label>
            <input type="email" name="email" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none" required>
        </div>

        <div>
            <label class="text-xs font-semibold text-gray-500 block mb-2">Phone Number</label>
            <input type="text" name="phone" placeholder="01xxxxxxxxx" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none" required>
        </div>

        <div>
            <label class="text-xs font-semibold text-gray-500 block mb-2">Password</label>
            <input type="password" name="password" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none" required>
        </div>

        <div>
            <label class="text-xs font-semibold text-gray-500 block mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none" required>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-3 rounded-xl hover:bg-blue-700 transition-all">
            Sign Up
        </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-6">
        Already have an account? <a href="{{ route('login.show') }}" class="text-blue-600 font-bold hover:underline">Login</a>
    </p>
</div>
</body>
</html>
