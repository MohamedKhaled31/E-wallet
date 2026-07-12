<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyWallet - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans text-gray-800 antialiased">
<div class="flex min-h-screen">
    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between fixed h-full z-10">

        @if(auth()->user()->role === 'admin')
            @include('layouts.parts.admin.sidebar')
        @else
            @include('layouts.parts.user.sidebar')
        @endif

    </aside>

    <div class="flex-1 ml-64 flex flex-col min-h-screen">
        <header
            class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-10 sticky top-0 z-50">
            <h2 class="text-xl font-bold text-gray-900">@yield('title', 'Dashboard')</h2>
            <div class="flex items-center gap-3 pl-4 border-l border-gray-100">
                <span class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</span>
                <div
                    class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md">
                    {{ mb_substr(preg_replace('/[^\p{L}\p{N}]/u', '', auth()->user()->name), 0, 1, 'UTF-8') ?: 'U' }}
                </div>
            </div>
        </header>

        <main class="p-10 flex-1 bg-gray-50/50">
            @yield('content')
        </main>
    </div>
</div>
</body>

</html>
