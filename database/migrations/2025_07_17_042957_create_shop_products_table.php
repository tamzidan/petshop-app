<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_shop_products_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shop_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->bigInteger('price')->default(0); // Menggunakan bigInteger untuk harga dalam Rupiah tanpa desimal
            $table->string('stock_status')->default('Tersedia'); // Contoh: 'Tersedia', 'Habis'
            $table->string('link_tokopedia')->nullable();
            $table->string('link_shopee')->nullable();
            $table->string('link_whatsapp')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shop_products');
    }
};