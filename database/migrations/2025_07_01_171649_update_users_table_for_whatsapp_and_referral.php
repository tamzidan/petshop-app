<?php
// database/migrations/xxxx_xx_xx_xxxxxx_update_users_table_for_whatsapp_and_referral.php

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
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom nomor_hp
            $table->string('phone_number')->unique()->nullable()->after('email');
            $table->timestamp('phone_number_verified_at')->nullable()->after('phone_number');

            // Menambahkan kolom untuk OTP
            $table->string('otp_code')->nullable()->after('password');
            $table->timestamp('otp_expires_at')->nullable()->after('otp_code');

            // Menambahkan kolom referral
            $table->string('referral_code')->unique()->nullable()->after('points'); // Kode referral user ini
            $table->string('referred_by')->nullable()->after('referral_code'); // Kode referral yang digunakan user ini
            $table->boolean('first_transaction_awarded')->default(false)->after('referred_by'); // Status poin transaksi pertama

            // Mengubah email agar bisa null, karena login utama akan pakai nomor HP
            $table->string('email')->nullable()->change();
            // Menghapus email_verified_at jika tidak lagi digunakan atau biarkan saja
            // $table->dropColumn('email_verified_at'); // Opsional, jika memang tidak butuh verifikasi email sama sekali
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Mengembalikan kolom email menjadi not nullable jika sebelumnya seperti itu
            // Hati-hati dengan ini jika sudah ada data null
            $table->string('email')->nullable(false)->change();

            // Menghapus kolom yang ditambahkan
            $table->dropColumn('phone_number');
            $table->dropColumn('phone_number_verified_at');
            $table->dropColumn('otp_code');
            $table->dropColumn('otp_expires_at');
            $table->dropColumn('referral_code');
            $table->dropColumn('referred_by');
            $table->dropColumn('first_transaction_awarded');

            // Jika sebelumnya dihapus
            // $table->timestamp('email_verified_at')->nullable();
        });
    }
};