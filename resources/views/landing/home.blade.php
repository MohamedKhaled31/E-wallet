<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>MyWallet - Secure E-Wallet</title>
</head>

<body class="bg-white text-gray-900 font-sans">

    <nav class="flex justify-between items-center py-6 px-12 border-b border-gray-50">
        <div class="flex items-center gap-2 font-bold text-2xl text-blue-600">
            <i class="fa-solid fa-wallet"></i> MyWallet
        </div>
        <div class="flex gap-8 text-sm font-medium text-gray-600">
            <a href="#home" class="hover:text-blue-600 transition">Home</a>
            <a href="#features" class="hover:text-blue-600 transition">Features</a>
            <a href="#how-it-works" class="hover:text-blue-600 transition">How It Works</a>
        </div>
        <div class="flex items-center gap-4">
            <a href="/login" class="text-sm font-medium hover:text-blue-600">Login</a>
            <a href="/register"
                class="bg-blue-600 text-white px-6 py-2 rounded-xl text-sm font-bold shadow-lg shadow-blue-200">Create
                Account</a>
        </div>
    </nav>

    <section id="home" class="text-center py-24 px-4">
        <span class="text-blue-600 text-xs font-bold bg-blue-50 px-4 py-1.5 rounded-full uppercase tracking-widest">
            <i class="fa-solid fa-shield-check mr-2"></i> Secure. Fast. Reliable.
        </span>
        <h1 class="text-7xl font-extrabold mt-8 mb-8 leading-[1.1]">Your Money.<br>Your Way.</h1>
        <p class="text-gray-500 max-w-lg mx-auto mb-12 text-lg">MyWallet is a secure and easy-to-use e-wallet that helps
            you send, receive and manage your money anytime, anywhere.</p>

        <div class="flex justify-center gap-4">
            <a href="{{ route('register') }}"
                class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-blue-700 transition block">
                Create Account
            </a>

            <a href="{{ route('login') }}"
                class="border border-gray-200 px-10 py-4 rounded-2xl font-bold text-gray-700 hover:border-blue-600 transition block">
                Login
            </a>
        </div>

        <div class="flex justify-center gap-12 mt-16 text-gray-600">
            <div class="flex items-center gap-2"><i class="fa-solid fa-shield text-blue-500"></i> Bank-level Security
            </div>
            <div class="flex items-center gap-2"><i class="fa-solid fa-bolt text-blue-500"></i> Instant Transactions
            </div>
            <div class="flex items-center gap-2"><i class="fa-solid fa-headphones text-blue-500"></i> 24/7 Support</div>
        </div>
    </section>

    <section id="features" class="py-24 bg-gray-50 px-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl transition">
                <i class="fa-solid fa-shield text-blue-600 text-3xl mb-6"></i>
                <h3 class="font-bold text-lg mb-2">Secure & Safe</h3>
                <p class="text-sm text-gray-500">Bank-level security to protect your data.</p>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl transition">
                <i class="fa-solid fa-bolt text-blue-600 text-3xl mb-6"></i>
                <h3 class="font-bold text-lg mb-2">Fast Transactions</h3>
                <p class="text-sm text-gray-500">Send money instantly with no complications.</p>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl transition">
                <i class="fa-solid fa-wallet text-blue-600 text-3xl mb-6"></i>
                <h3 class="font-bold text-lg mb-2">Multiple Options</h3>
                <p class="text-sm text-gray-500">Top up, withdraw and pay conveniently.</p>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl transition">
                <i class="fa-solid fa-clock text-blue-600 text-3xl mb-6"></i>
                <h3 class="font-bold text-lg mb-2">24/7 Access</h3>
                <p class="text-sm text-gray-500">Manage your money anytime, anywhere.</p>
            </div>
        </div>
    </section>

    <section id="how-it-works" class="py-24 text-center">
        <h2 class="text-4xl font-bold mb-16">How MyWallet Works</h2>
        <div class="flex justify-center items-center gap-8 px-12">

            <div class="flex flex-col items-center">
                <div
                    class="w-20 h-20 bg-blue-50 text-blue-600 text-3xl rounded-3xl flex items-center justify-center mb-6 shadow-inner">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <p class="font-bold text-lg">Create Account</p>
            </div>

            <i class="fa-solid fa-arrow-right text-gray-300 text-2xl"></i>

            <div class="flex flex-col items-center">
                <div
                    class="w-20 h-20 bg-green-50 text-green-600 text-3xl rounded-3xl flex items-center justify-center mb-6 shadow-inner">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <p class="font-bold text-lg">Top Up Your Wallet</p>
            </div>

            <i class="fa-solid fa-arrow-right text-gray-300 text-2xl"></i>

            <div class="flex flex-col items-center">
                <div
                    class="w-20 h-20 bg-purple-50 text-purple-600 text-3xl rounded-3xl flex items-center justify-center mb-6 shadow-inner">
                    <i class="fa-solid fa-right-left"></i>
                </div>
                <p class="font-bold text-lg">Send & Receive</p>
            </div>
        </div>
    </section>

    <section id="security" class="py-12 px-12">
        <div class="bg-gray-900 rounded-3xl p-16 flex justify-between items-center text-white">
            <div>
                <h2 class="text-4xl font-bold mb-4">Ready to take control of your money?</h2>
                <p class="text-gray-400 text-lg">Join thousands of users who trust MyWallet.</p>
            </div>

            <a href="{{ route('register') }}"
                class="bg-blue-600 px-10 py-5 rounded-2xl font-bold text-lg text-white hover:bg-blue-700 transition shadow-lg shadow-blue-500/20 block text-center">
                Create Your Account
            </a>
        </div>
    </section>

    <footer class="bg-gray-50 py-16 px-12">
        <div class="grid grid-cols-4 gap-8">
            <div>
                <div class="flex items-center gap-2 font-bold text-xl text-blue-600 mb-4">
                    <i class="fa-solid fa-wallet"></i> MyWallet
                </div>
                <p class="text-sm text-gray-500">A secure and easy way to manage your money anytime, anywhere.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Quick Links</h4>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#how-it-works">How It Works</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Support</h4>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>Help Center</li>
                    <li>FAQs</li>
                    <li>Privacy Policy</li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Contact Us</h4>
                <p class="text-sm text-gray-600">mohamedkhaled3119@gmail.com</p>
                <p class="text-sm text-gray-600">+20 1068200980</p>
            </div>
        </div>
        <div class="mt-12 pt-8 border-t border-gray-200 text-center text-sm text-gray-500">
            © 2026 MyWallet. All rights reserved.
        </div>
    </footer>

</body>

</html>
