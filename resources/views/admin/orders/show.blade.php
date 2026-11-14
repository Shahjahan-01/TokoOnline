@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')

    <a href="{{ route('admin.orders.index') }}" class="text-sm text-indigo-600 hover:underline">&larr; Kembali ke daftar pesanan</a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">

        <div class="lg:col-span-2 bg-white border border-slate-200 rounded-xl p-6">
            <h2 class="font-semibold mb-4">Pesanan #{{ $order->id }}</h2>

            <div class="flex gap-4 mb-6">
                <div class="w-16 h-16 bg-slate-100 rounded-lg overflow-hidden flex items-center justify-center flex-shrink-0">
                    @if ($order->product?->image)
                        <img src="{{ asset('storage/' . $order->product->image) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-[10px] text-slate-300">No img</span>
                    @endif
                </div>
                <div>
                    <p class="font-medium">{{ $order->product?->name ?? 'Produk sudah dihapus' }}</p>
                    <p class="text-sm text-slate-500">{{ $order->quantity }} pcs &times; Rp {{ number_format($order->price, 0, ',', '.') }}</p>
                    <p class="text-sm font-semibold text-indigo-600 mt-1">Total: {{ $order->formatted_total }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 text-sm mb-6">
                <div>
                    <p class="text-slate-400">Pembeli</p>
                    <p class="font-medium">{{ $order->user->name }}</p>
                    <p class="text-slate-500">{{ $order->user->email }}</p>
                </div>
                <div>
                    <p class="text-slate-400">Metode Pembayaran</p>
                    <p class="font-medium uppercase">{{ $order->payment_method }}</p>
                </div>
            </div>

            <div class="border-t pt-4 mb-6">
                <p class="text-slate-400 text-sm mb-2">Alamat Pengiriman</p>
                <p class="font-medium">{{ $order->recipient_name }} &middot; {{ $order->phone }}</p>
                <p class="text-sm text-slate-600 mt-1">{{ $order->address }}, {{ $order->city }} {{ $order->postal_code }}</p>
                @if ($order->notes)
                    <p class="text-sm text-slate-500 mt-2 italic">Catatan: {{ $order->notes }}</p>
                @endif
            </div>

            @if ($order->payment_method === 'transfer')
                <div class="border-t pt-4">
                    <p class="text-slate-400 text-sm mb-2">Bukti Transfer</p>
                    @if ($order->proof_image)
                        <img src="{{ asset('storage/' . $order->proof_image) }}" class="max-w-xs rounded-lg border border-slate-200">
                    @else
                        <p class="text-sm text-slate-400">Belum ada bukti transfer diunggah.</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="bg-white border border-slate-200 rounded-xl p-6 h-fit">
            <h2 class="font-semibold mb-4">Status Pesanan</h2>

            <span class="text-xs px-3 py-1 rounded-full font-medium {{ $order->status_badge }}">{{ $order->status_label }}</span>

            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="mt-5 space-y-3">
                @csrf
                @method('PATCH')

                <select name="status" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm">
                    @foreach (['menunggu_pembayaran' => 'Menunggu Pembayaran', 'diproses' => 'Diproses', 'dikirim' => 'Dikirim', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'] as $key => $label)
                        <option value="{{ $key }}" {{ $order->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 rounded-lg text-sm">
                    Perbarui Status
                </button>
            </form>
        </div>

    </div>

@endsection
