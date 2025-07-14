<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class InventMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user sudah login dan memiliki role = 1 Invent
        if (Auth::check() && Auth::user()->role == 2) {
            return $next($request);
        }

        // Jika tidak, redirect atau tampilkan error
        return redirect()->route('login')->with('error', 'Anda tidak memiliki akses.');
        // Atau: return abort(403, 'Forbidden');
    }
}
