<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Product::count();
        $totalPesanan = Order::count();
        $pesananMenunggu = Order::where('status', 'menunggu_pembayaran')->count();
        $pesananSelesai = Order::where('status', 'selesai')->count();
        $pesananTerbaru = Order::with(['user', 'product'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProduk',
            'totalPesanan',
            'pesananMenunggu',
            'pesananSelesai',
            'pesananTerbaru'
        ));
    }
}
