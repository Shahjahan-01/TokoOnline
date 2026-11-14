<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // form checkout untuk 1 produk (udah pasti login karena kena middleware cek.login)
    public function create(Product $product)
    {
        return view('products.checkout', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:' . max($product->stock, 1)],
            'payment_method' => ['required', 'in:cod,transfer'],
            'proof_image' => ['required_if:payment_method,transfer', 'nullable', 'image', 'max:2048'],
            'recipient_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'notes' => ['nullable', 'string'],
        ]);

        if ($product->stock < $data['quantity']) {
            return back()->withErrors(['quantity' => 'Stok produk tidak mencukupi.'])->withInput();
        }

        $proofPath = null;
        if ($request->hasFile('proof_image')) {
            $proofPath = $request->file('proof_image')->store('bukti-transfer', 'public');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $data['quantity'],
            'price' => $product->price,
            'total_price' => $product->price * $data['quantity'],
            'payment_method' => $data['payment_method'],
            'proof_image' => $proofPath,
            'recipient_name' => $data['recipient_name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'postal_code' => $data['postal_code'] ?? null,
            'notes' => $data['notes'] ?? null,
            'status' => 'menunggu_pembayaran',
        ]);

        // kurangin stok produk begitu pesanan dibuat
        $product->decrement('stock', $data['quantity']);

        return redirect()->route('orders.index')
            ->with('success', 'Pesanan berhasil dibuat, silakan tunggu konfirmasi dari toko.');
    }
}
