<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number', // Tambahkan ini
        'phone_number_verified_at', // Tambahkan ini
        'password',
        'role',
        'points',
        'otp_code', // Tambahkan ini
        'otp_expires_at', // Tambahkan ini
        'referral_code', // Tambahkan ini
        'referred_by', // Tambahkan ini
        'first_transaction_awarded', // Tambahkan ini
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp_code', // Sembunyikan OTP
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_number_verified_at' => 'datetime', // Cast ini
        'otp_expires_at' => 'datetime', // Cast ini
        'password' => 'hashed',
        'first_transaction_awarded' => 'boolean', // Cast ini
    ];

        // Relasi untuk mendapatkan user yang mereferral user ini
    public function referrerUser()
    {
        return $this->belongsTo(User::class, 'referred_by', 'referral_code');
    }

    // Relasi untuk mendapatkan user-user yang direferral oleh user ini
    public function referredUsers()
    {
        return $this->hasMany(User::class, 'referred_by', 'referral_code');
    }

    // Relasi ke Redemption
    public function redemptions()
    {
        return $this->hasMany(Redemption::class);
    }

    // Relasi ke GroomingBooking
    public function groomingBookings()
    {
        return $this->hasMany(GroomingBooking::class);
    }

    // Relasi ke CatHotelBooking
    public function HotelBookings()
    {
        return $this->hasMany(HotelBooking::class);
    }

}
