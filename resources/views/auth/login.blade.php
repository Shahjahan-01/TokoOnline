@extends('layouts.app')

@section('title', 'Masuk - Toko Kita')

@section('content')

    <div class="max-w-md mx-auto bg-white border border-slate-200 rounded-xl p-8">
        <h1 class="text-2xl font-bold mb-1">Masuk</h1>
        <p class="text-slate-500 text-sm mb-6">Masuk dulu buat lanjut checkout ya.</p>

        @if ($errors->any())
            <div class="mb-5 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" class="w-full border border-slate-300 rounded-lg px-3 py-2">
            </div>

            <label class="flex items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" name="remember">
                Ingat saya
            </label>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg">
                Masuk
            </button>
        </form>

        <p class="text-sm text-slate-500 mt-5 text-center">
            Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600 font-medium">Daftar di sini</a>
        </p>

        <div class="text-xs text-slate-400 mt-4 border-t pt-4 text-center">
            Akun admin: admin@tokokita.com / password
        </div>
    </div>

@endsection
