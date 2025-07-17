<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_xxxxxx_create_cat_hotel_bookings_table.php
    public function up(): void
    {
        Schema::create('hotel_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('transaction_code')->unique();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->integer('number_of_cats'); // Jumlah kucing yang dititip
            $table->date('check_in_date');    // Tanggal masuk
            $table->date('check_out_date');   // Tanggal keluar
            $table->integer('total_price');     // Total biaya
            $table->string('status')->default('pending'); // pending, confirmed, completed, cancelled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_bookings');
    }
};
