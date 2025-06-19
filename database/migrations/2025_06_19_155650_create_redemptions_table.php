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
        Schema::create('redemptions', function (Blueprint $table) {
            $table->id();
            // Foreign key untuk user yang melakukan penukaran
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Foreign key untuk produk yang ditukarkan
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('points_used'); // Jumlah poin yang digunakan untuk penukaran ini
            $table->string('unique_code')->unique(); // Kode unik manual untuk klaim
            $table->enum('status', ['pending', 'claimed', 'cancelled'])->default('pending'); // Status penukaran
            $table->timestamp('claimed_at')->nullable(); // Waktu klaim oleh admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redemptions');
    }
};
