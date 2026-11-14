<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // halaman "Pesanan Saya", cuma nampilin pesanan milik user yang login
    public function index()
    {
        $orders = Auth::user()->orders()->with('product')->latest()->get();

        return view('orders.index', compact('orders'));
    }
}
