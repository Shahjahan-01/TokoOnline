@extends('layouts.admin')

@section('title', 'Pesanan Masuk')

@section('content')

    <div class="flex flex-wrap gap-2 mb-5">
        <a href="{{ route('admin.orders.index') }}" class="text-xs px-3 py-1.5 rounded-full {{ !request('status') ? 'bg-indigo-600 text-white' : 'bg-white border border-slate-200' }}">Semua</a>
        @foreach (['menunggu_pembayaran' => 'Menunggu Pembayaran', 'diproses' => 'Diproses', 'dikirim' => 'Dikirim', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'] as $key => $label)
            <a href="{{ route('admin.orders.index', ['status' => $key]) }}" class="text-xs px-3 py-1.5 rounded-full {{ request('status') == $key ? 'bg-indigo-600 text-white' : 'bg-white border border-slate-200' }}">{{ $label }}</a>
        @endforeach
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-left">
                <tr>
                    <th class="px-4 py-3">Pembeli</th>
                    <th class="px-4 py-3">Produk</th>
                    <th class="px-4 py-3">Jumlah</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Bayar</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr class="border-t">
                        <td class="px-4 py-3">
                            <div class="font-medium">{{ $order->user->name }}</div>
                            <div class="text-xs text-slate-400">{{ $order->user->email }}</div>
                        </td>
                        <td class="px-4 py-3">{{ $order->product?->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $order->quantity }}</td>
                        <td class="px-4 py-3">{{ $order->formatted_total }}</td>
                        <td class="px-4 py-3 uppercase text-xs">{{ $order->payment_method }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs px-2 py-1 rounded-full {{ $order->status_badge }}">{{ $order->status_label }}</span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-600 hover:underline">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-slate-400">Belum ada pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>

@endsection
