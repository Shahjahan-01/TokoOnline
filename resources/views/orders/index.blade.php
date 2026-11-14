@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')

    <h1 class="text-2xl font-bold mb-6">Pesanan Saya</h1>

    @if ($orders->isEmpty())
        <div class="text-center text-slate-400 py-16">
            Kamu belum punya pesanan. <a href="{{ route('home') }}" class="text-indigo-600 font-medium">Yuk belanja</a>.
        </div>
    @else
        <div class="space-y-4">
            @foreach ($orders as $order)
                <div class="bg-white border border-slate-200 rounded-xl p-5 flex flex-col sm:flex-row sm:items-center gap-4 justify-between">
                    <div class="flex gap-4">
                        <div class="w-16 h-16 bg-slate-100 rounded-lg flex items-center justify-center overflow-hidden flex-shrink-0">
                            @if ($order->product?->image)
                                <img src="{{ asset('storage/' . $order->product->image) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-xs text-slate-300">No image</span>
                            @endif
                        </div>
                        <div>
                            <h2 class="font-semibold text-slate-800">{{ $order->product?->name ?? 'Produk sudah dihapus' }}</h2>
                            <p class="text-sm text-slate-500">{{ $order->quantity }} pcs &middot; {{ $order->formatted_total }}</p>
                            <p class="text-xs text-slate-400 mt-1">Dipesan pada {{ $order->created_at->translatedFormat('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-xs px-3 py-1 rounded-full font-medium {{ $order->status_badge }}">
                            {{ $order->status_label }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
