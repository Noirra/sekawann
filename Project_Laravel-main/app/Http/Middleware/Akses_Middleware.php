<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Akses_Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user || !in_array($user->user_level, $roles)) {
            $errorMessage = 'Anda tidak mempunyai hak akses untuk mengakses halaman ini dan melakukan aksi ini!';
            return abort(403, $errorMessage);
        }

        return $next($request);
    }
}