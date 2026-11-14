<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Kaos Polos Cotton Combed', 'price' => 75000, 'stock' => 25, 'description' => 'Kaos polos bahan cotton combed 30s, adem dan nyaman dipakai harian.'],
            ['name' => 'Sepatu Sneakers Casual', 'price' => 250000, 'stock' => 10, 'description' => 'Sepatu sneakers cocok buat jalan-jalan atau nongkrong.'],
            ['name' => 'Tas Ransel Laptop', 'price' => 180000, 'stock' => 15, 'description' => 'Tas ransel muat laptop 15 inch, banyak kompartemen.'],
            ['name' => 'Jaket Hoodie Fleece', 'price' => 120000, 'stock' => 20, 'description' => 'Hoodie fleece tebal, hangat buat cuaca dingin.'],
            ['name' => 'Topi Baseball Cap', 'price' => 45000, 'stock' => 30, 'description' => 'Topi keren buat gaya kasual sehari-hari.'],
            ['name' => 'Botol Minum Stainless', 'price' => 60000, 'stock' => 18, 'description' => 'Botol minum stainless steel 500ml, tahan panas dan dingin.'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
