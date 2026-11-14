<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Kita')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800">

    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 flex items-center justify-between h-16">
            <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-xl text-indigo-600">
                🛒 Toko Kita
            </a>

            <div class="flex items-center gap-4 text-sm">
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-slate-600 hover:text-indigo-600">Dashboard Admin</a>
                    @else
                        <a href="{{ route('home') }}" class="text-slate-600 hover:text-indigo-600">Belanja</a>
                        <a href="{{ route('orders.index') }}" class="text-slate-600 hover:text-indigo-600">Pesanan Saya</a>
                    @endif

                    <span class="text-slate-300">|</span>
                    <span class="text-slate-500">Hai, {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-3 py-1.5 rounded-lg">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-indigo-600">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-1.5 rounded-lg">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-8">
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    @if (session('alert'))
        <script>
            alert(@json(session('alert')));
        </script>
    @endif

</body>
</html>
