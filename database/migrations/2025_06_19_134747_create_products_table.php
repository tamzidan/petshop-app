<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable(); // Deskripsi produk, boleh kosong
            $table->integer('point_cost'); // Biaya poin untuk menukarkan produk ini
            $table->string('image')->nullable(); // Nama file gambar produk, boleh kosong
            $table->integer('stock')->default(0); // Stok produk, defaultnya 0
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};