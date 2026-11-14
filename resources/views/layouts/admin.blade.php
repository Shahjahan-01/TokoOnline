<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Toko Kita')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800">
    <div class="flex min-h-screen">

        <aside class="w-64 bg-slate-900 text-slate-200 flex-shrink-0">
            <div class="px-6 py-5 text-xl font-bold text-white border-b border-slate-800">
                🛒 Toko Kita
                <div class="text-xs font-normal text-slate-400">Panel Admin</div>
            </div>

            <nav class="mt-4 flex flex-col gap-1 px-3 text-sm">
                <a href="{{ route('admin.dashboard') }}"
                   class="px-3 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}"
                   class="px-3 py-2 rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800' }}">
                    Kelola Produk
                </a>
                <a href="{{ route('admin.orders.index') }}"
                   class="px-3 py-2 rounded-lg {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800' }}">
                    Pesanan Masuk
                </a>
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg hover:bg-slate-800">
                    Lihat Toko
                </a>

                <form action="{{ route('logout') }}" method="POST" class="mt-4">
                    @csrf
                    <button class="w-full text-left px-3 py-2 rounded-lg hover:bg-slate-800 text-red-300">
                        Keluar
                    </button>
                </form>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-6">
                <h1 class="font-semibold text-lg">@yield('title', 'Dashboard')</h1>
                <span class="text-sm text-slate-500">Halo, {{ auth()->user()->name }}</span>
            </header>

            <main class="flex-1 p-6">
                @if (session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
