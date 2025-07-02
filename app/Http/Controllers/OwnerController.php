<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Untuk query database

class OwnerController extends Controller
{
    /**
     * Menampilkan dashboard owner dengan data referral.
     */
    public function dashboard()
    {
        // Total user yang menggunakan referral
        $totalUsersWithReferral = User::whereNotNull('referred_by')->count();

        // Referral paling banyak digunakan dan siapa saja yang menggunakannya
        $topReferrers = User::select('referred_by', DB::raw('count(*) as total_referred_users'))
                            ->whereNotNull('referred_by')
                            ->groupBy('referred_by')
                            ->orderByDesc('total_referred_users')
                            ->with(['referrerUser' => function ($query) { // Load informasi user referrer
                                $query->select('id', 'name', 'email', 'referral_code');
                            }])
                            ->limit(10) // Tampilkan 10 teratas
                            ->get();

        // Dapatkan detail siapa yang direferral oleh siapa
        $referralDetails = User::with('referrerUser:id,name,referral_code') // User yang mereferral
                                ->whereNotNull('referred_by')
                                ->latest()
                                ->get();

        // Untuk setiap user yang punya referral_code, cari siapa saja yang pakai kodenya
        $myReferrals = collect();
        $usersWithReferralCodes = User::whereNotNull('referral_code')->get();
        foreach ($usersWithReferralCodes as $user) {
            $referredUsers = User::where('referred_by', $user->referral_code)->get();
            if ($referredUsers->isNotEmpty()) {
                $myReferrals->push([
                    'referrer_user' => $user,
                    'referred_users_count' => $referredUsers->count(),
                    'referred_users_list' => $referredUsers->map(function($ru) {
                        return [
                            'name' => $ru->name,
                            'email' => $ru->email, // Atau phone_number
                            'first_transaction_awarded' => $ru->first_transaction_awarded,
                        ];
                    }),
                ]);
            }
        }


        return view('owner.dashboard', compact(
            'totalUsersWithReferral',
            'topReferrers',
            'referralDetails',
            'myReferrals'
        ));
    }

    /**
     * Relasi di model User untuk mendapatkan referrer.
     */
    public function referrerUser()
    {
        return $this->belongsTo(User::class, 'referred_by', 'referral_code');
    }
}