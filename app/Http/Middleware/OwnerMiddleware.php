<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'owner') {
            return $next($request);
        }

        // Arahkan ke dashboard admin jika dia admin, atau ke dashboard biasa jika user
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect('/admin/dashboard')->with('error', 'Anda tidak memiliki akses sebagai owner.');
        }

        return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses sebagai owner.');
    }
}