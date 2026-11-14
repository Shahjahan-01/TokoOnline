<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'product'])->latest();

        // filter simpel biar admin gampang nyari pesanan per status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'product']);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', 'in:menunggu_pembayaran,diproses,dikirim,selesai,dibatalkan'],
        ]);

        $order->update(['status' => $data['status']]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
