@extends('layouts.app')

@section('title', 'Toko Kita - Belanja Online')

@section('content')

    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-slate-800">Selamat Datang di Toko Kita</h1>
        <p class="text-slate-500 mt-2">Belanja produk pilihan langsung dari toko kami, gampang dan aman.</p>
    </div>

    @if ($products->isEmpty())
        <div class="text-center text-slate-400 py-16">
            Belum ada produk yang dijual saat ini.
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden hover:shadow-lg transition">
                    <div class="h-44 bg-slate-100 flex items-center justify-center">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-slate-300 text-sm">Tidak ada gambar</span>
                        @endif
                    </div>

                    <div class="p-4">
                        <h2 class="font-semibold text-slate-800 truncate">{{ $product->name }}</h2>
                        <p class="text-indigo-600 font-bold mt-1">{{ $product->formatted_price }}</p>
                        <p class="text-xs text-slate-400 mt-1">Stok: {{ $product->stock }}</p>

                        @if ($product->stock > 0)
                            <a href="{{ route('checkout.create', $product) }}"
                               class="mt-3 block text-center bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2 rounded-lg">
                                Checkout
                            </a>
                        @else
                            <button disabled class="mt-3 w-full text-center bg-slate-200 text-slate-400 text-sm font-medium py-2 rounded-lg cursor-not-allowed">
                                Stok Habis
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
