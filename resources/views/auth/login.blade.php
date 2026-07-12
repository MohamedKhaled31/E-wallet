<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyWallet</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

<div class="w-full max-w-md p-8 bg-white rounded-3xl border border-gray-100 shadow-sm">
    <div class="text-center mb-8">
        <div class="bg-blue-600 text-white w-12 h-12 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-200">
            <i class="fa-solid fa-wallet text-xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-900">Welcome Back</h2>
        <p class="text-gray-500 text-sm mt-1">Please enter your details</p>
    </div>

    <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="text-xs font-semibold text-gray-500 block mb-2">Email Address</label>
            <input type="email" name="email" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all">
        </div>
        <div>
            <label class="text-xs font-semibold text-gray-500 block mb-2">Password</label>
            <input type="password" name="password" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-500 outline-none transition-all">
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-3 rounded-xl hover:bg-blue-700 transition-all shadow-md shadow-blue-100">
            Sign In
        </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-6">
        Don't have an account? <a href="{{ route('register.show') }}" class="text-blue-600 font-bold hover:underline">Register</a>
    </p>
</div>
</body>
</html>
