<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Pastikan ini diimpor
use Illuminate\Support\Facades\Hash; // Pastikan ini diimpor
use Illuminate\Support\Str; // Pastikan ini diimpor
use Carbon\Carbon; // Pastikan ini diimpor

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat User Biasa (Role: user)
        User::updateOrCreate(
            ['email' => 'user@example.com'], // Kondisi untuk mencari/mengupdate
            [
                'name' => 'User Biasa',
                'phone_number' => '6281234567891', // Ganti dengan nomor HP dummy yang valid
                'phone_number_verified_at' => Carbon::now(),
                'password' => Hash::make('password'), // Password default
                'role' => 'user',
                'points' => 100, // Poin awal untuk user biasa
                'referral_code' => Str::random(8), // Kode referral unik
                'referred_by' => null, // Belum direferral
                'first_transaction_awarded' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        // 2. Buat Admin (Role: admin)
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Petshop',
                'phone_number' => '6281234567892', // Ganti dengan nomor HP dummy yang valid
                'phone_number_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'role' => 'admin',
                'points' => 0,
                'referral_code' => Str::random(8),
                'referred_by' => null,
                'first_transaction_awarded' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        // 3. Buat Owner (Role: owner)
        User::updateOrCreate(
            ['email' => 'owner@example.com'],
            [
                'name' => 'Owner Petshop',
                'phone_number' => '6281234567893', // Ganti dengan nomor HP dummy yang valid
                'phone_number_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'role' => 'owner',
                'points' => 0,
                'referral_code' => Str::random(8),
                'referred_by' => null,
                'first_transaction_awarded' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        // Contoh user yang direferral oleh 'user@example.com' (butuh kode referral user@example.com)
        $referrerUser = User::where('email', 'user@example.com')->first();
        if ($referrerUser) {
            User::updateOrCreate(
                ['email' => 'referred.user@example.com'],
                [
                    'name' => 'Referred User',
                    'phone_number' => '6281234567894', // Ganti dengan nomor HP dummy yang valid
                    'phone_number_verified_at' => Carbon::now(),
                    'password' => Hash::make('password'),
                    'role' => 'user',
                    'points' => 10, // Poin awal dari referral
                    'referral_code' => Str::random(8),
                    'referred_by' => $referrerUser->referral_code, // Kode referral dari user@example.com
                    'first_transaction_awarded' => false,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }

        $this->command->info('Default users with roles seeded successfully!');
    }
}