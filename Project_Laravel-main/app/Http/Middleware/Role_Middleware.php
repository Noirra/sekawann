<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role_Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('failed', 'Silahkan login terlebih dahulu');
        }
        $user = Auth::user();
        if ($user->user_level !== 'admin' && $user->user_level !== 'pengguna') {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}