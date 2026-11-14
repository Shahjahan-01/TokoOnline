@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-white rounded-xl border border-slate-200 p-5">
            <p class="text-sm text-slate-500">Total Produk</p>
            <p class="text-2xl font-bold mt-1">{{ $totalProduk }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-5">
            <p class="text-sm text-slate-500">Total Pesanan</p>
            <p class="text-2xl font-bold mt-1">{{ $totalPesanan }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-5">
            <p class="text-sm text-slate-500">Menunggu Pembayaran</p>
            <p class="text-2xl font-bold mt-1 text-yellow-600">{{ $pesananMenunggu }}</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-5">
            <p class="text-sm text-slate-500">Pesanan Selesai</p>
            <p class="text-2xl font-bold mt-1 text-green-600">{{ $pesananSelesai }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <h2 class="font-semibold mb-4">Pesanan Terbaru</h2>

        @if ($pesananTerbaru->isEmpty())
            <p class="text-slate-400 text-sm">Belum ada pesanan masuk.</p>
        @else
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-500 border-b">
                        <th class="py-2">Pembeli</th>
                        <th class="py-2">Produk</th>
                        <th class="py-2">Total</th>
                        <th class="py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesananTerbaru as $order)
                        <tr class="border-b last:border-0">
                            <td class="py-2">{{ $order->user->name }}</td>
                            <td class="py-2">{{ $order->product?->name ?? '-' }}</td>
                            <td class="py-2">{{ $order->formatted_total }}</td>
                            <td class="py-2">
                                <span class="text-xs px-2 py-1 rounded-full {{ $order->status_badge }}">{{ $order->status_label }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

@endsection
