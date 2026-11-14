@extends('layouts.admin')

@section('title', 'Ubah Produk')

@section('content')

    <div class="max-w-xl bg-white border border-slate-200 rounded-xl p-6">

        @if ($errors->any())
            <div class="mb-5 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if ($product->image)
            <div class="w-24 h-24 rounded-lg overflow-hidden bg-slate-100 mb-4">
                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium mb-1">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border border-slate-300 rounded-lg px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full border border-slate-300 rounded-lg px-3 py-2">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full border border-slate-300 rounded-lg px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full border border-slate-300 rounded-lg px-3 py-2">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Ganti Gambar (opsional)</label>
                <input type="file" name="image" accept="image/*" class="w-full border border-slate-300 rounded-lg px-3 py-2 bg-white">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-5 py-2.5 rounded-lg">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.products.index') }}" class="text-slate-500 px-5 py-2.5">Batal</a>
            </div>
        </form>
    </div>

@endsection
