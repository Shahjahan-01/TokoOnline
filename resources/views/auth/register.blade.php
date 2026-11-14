@extends('layouts.app')

@section('title', 'Daftar - Toko Kita')

@section('content')

    <div class="max-w-md mx-auto bg-white border border-slate-200 rounded-xl p-8">
        <h1 class="text-2xl font-bold mb-1">Buat Akun</h1>
        <p class="text-slate-500 text-sm mb-6">Daftar sebagai pembeli, gratis kok.</p>

        @if ($errors->any())
            <div class="mb-5 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Nomor HP</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border border-slate-300 rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" class="w-full border border-slate-300 rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="w-full border border-slate-300 rounded-lg px-3 py-2">
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg">
                Daftar
            </button>
        </form>

        <p class="text-sm text-slate-500 mt-5 text-center">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600 font-medium">Masuk di sini</a>
        </p>
    </div>

@endsection
