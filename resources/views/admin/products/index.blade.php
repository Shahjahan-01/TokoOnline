@extends('layouts.admin')

@section('title', 'Kelola Produk')

@section('content')

    <div class="flex justify-between items-center mb-5">
        <h2 class="font-semibold text-lg">Daftar Produk</h2>
        <a href="{{ route('admin.products.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-lg">
            + Tambah Produk
        </a>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500 text-left">
                <tr>
                    <th class="px-4 py-3">Gambar</th>
                    <th class="px-4 py-3">Nama Produk</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Stok</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="border-t">
                        <td class="px-4 py-3">
                            <div class="w-12 h-12 bg-slate-100 rounded-lg overflow-hidden flex items-center justify-center">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-[10px] text-slate-300">No img</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $product->name }}</td>
                        <td class="px-4 py-3">{{ $product->formatted_price }}</td>
                        <td class="px-4 py-3">{{ $product->stock }}</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-indigo-600 hover:underline">Ubah</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Yakin mau hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-400">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>

@endsection
