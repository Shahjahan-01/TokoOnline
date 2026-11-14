<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    // landing page, siapa aja boleh liat walau belum login
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();

        return view('products.index', compact('products'));
    }
}
