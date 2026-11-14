<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedBigInteger('price'); // harga satuan waktu order dibuat
            $table->unsignedBigInteger('total_price');

            // pembayaran
            $table->enum('payment_method', ['cod', 'transfer']);
            $table->string('proof_image')->nullable(); // bukti transfer, wajib kalau metode transfer

            // data pengiriman, biar barang bisa nyampe ke pembeli
            $table->string('recipient_name');
            $table->string('phone');
            $table->text('address');
            $table->string('city');
            $table->string('postal_code')->nullable();
            $table->text('notes')->nullable();

            $table->enum('status', [
                'menunggu_pembayaran',
                'diproses',
                'dikirim',
                'selesai',
                'dibatalkan',
            ])->default('menunggu_pembayaran');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
