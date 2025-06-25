<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_grooming_bookings_table.php

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
        Schema::create('grooming_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Bisa null jika guest booking
            $table->string('customer_name');
            $table->string('customer_phone'); // Nomor WhatsApp pelanggan
            $table->string('pet_type'); // 'kitten' atau 'adult'
            $table->string('grooming_type'); // 'grooming max all', 'grooming super', 'grooming premium'
            $table->integer('price'); // Harga grooming
            $table->date('booking_date');
            $table->time('booking_time');
            $table->string('transaction_code')->unique(); // Kode unik transaksi
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grooming_bookings');
    }
};