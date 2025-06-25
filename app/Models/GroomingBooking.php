<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroomingBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_phone',
        'pet_type',
        'grooming_type',
        'price',
        'booking_date',
        'booking_time',
        'transaction_code',
        'status',
    ];

    // Kolom yang harus otomatis di-cast ke tipe data tertentu
    protected $casts = [
        'booking_date' => 'date',
        'booking_time' => 'datetime', // Akan di-cast ke Carbon untuk format waktu
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}