@extends('layouts.app')

@section('title', 'Checkout - ' . $product->name)

@section('content')

    <div class="max-w-2xl mx-auto">
        <a href="{{ route('home') }}" class="text-sm text-indigo-600 hover:underline">&larr; Kembali belanja</a>

        <h1 class="text-2xl font-bold mt-3 mb-6">Checkout Pesanan</h1>

        <div class="bg-white border border-slate-200 rounded-xl p-5 mb-6 flex gap-4">
            <div class="w-20 h-20 bg-slate-100 rounded-lg flex items-center justify-center overflow-hidden flex-shrink-0">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                @else
                    <span class="text-xs text-slate-300">No image</span>
                @endif
            </div>
            <div>
                <h2 class="font-semibold text-slate-800">{{ $product->name }}</h2>
                <p class="text-indigo-600 font-bold">{{ $product->formatted_price }}</p>
                <p class="text-xs text-slate-400">Stok tersedia: {{ $product->stock }}</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('checkout.store', $product) }}" method="POST" enctype="multipart/form-data" class="bg-white border border-slate-200 rounded-xl p-6 space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Jumlah</label>
                <input type="number" name="quantity" min="1" max="{{ $product->stock }}" value="{{ old('quantity', 1) }}"
                       class="w-full border border-slate-300 rounded-lg px-3 py-2">
            </div>

            <div class="border-t border-slate-100 pt-4">
                <h3 class="font-semibold mb-3">Alamat Pengiriman</h3>

                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium mb-1">Nama Penerima</label>
                        <input type="text" name="recipient_name" value="{{ old('recipient_name', auth()->user()->name) }}"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Nomor HP</label>
                        <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Alamat Lengkap</label>
                        <textarea name="address" rows="3" class="w-full border border-slate-300 rounded-lg px-3 py-2">{{ old('address') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium mb-1">Kota / Kabupaten</label>
                            <input type="text" name="city" value="{{ old('city') }}"
                                   class="w-full border border-slate-300 rounded-lg px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Kode Pos</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code') }}"
                                   class="w-full border border-slate-300 rounded-lg px-3 py-2">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Catatan (opsional)</label>
                        <textarea name="notes" rows="2" class="w-full border border-slate-300 rounded-lg px-3 py-2">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-4">
                <h3 class="font-semibold mb-3">Metode Pembayaran</h3>

                <div class="space-y-2">
                    <label class="flex items-center gap-2 border border-slate-300 rounded-lg px-3 py-2 cursor-pointer">
                        <input type="radio" name="payment_method" value="cod" onclick="document.getElementById('proof-section').classList.add('hidden')" {{ old('payment_method') == 'cod' ? 'checked' : '' }}>
                        <span>Bayar di Tempat (COD)</span>
                    </label>
                    <label class="flex items-center gap-2 border border-slate-300 rounded-lg px-3 py-2 cursor-pointer">
                        <input type="radio" name="payment_method" value="transfer" onclick="document.getElementById('proof-section').classList.remove('hidden')" {{ old('payment_method') == 'transfer' ? 'checked' : '' }}>
                        <span>Transfer Bank</span>
                    </label>
                </div>

                <div id="proof-section" class="{{ old('payment_method') == 'transfer' ? '' : 'hidden' }} mt-3">
                    <label class="block text-sm font-medium mb-1">Upload Bukti Transfer</label>
                    <input type="file" name="proof_image" accept="image/*" class="w-full border border-slate-300 rounded-lg px-3 py-2 bg-white">
                    <p class="text-xs text-slate-400 mt-1">Silakan transfer ke rekening BCA 1234567890 a.n. Toko Kita, lalu upload buktinya di sini.</p>
                </div>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg">
                Buat Pesanan
            </button>
        </form>
    </div>

@endsection
