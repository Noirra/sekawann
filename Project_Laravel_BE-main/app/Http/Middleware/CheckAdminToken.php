<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminToken
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah token ada dalam header Authorization
        if (!$request->bearerToken()) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        // Periksa apakah token valid
        if (!Auth::guard('admin-api')->check()) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        // Lanjutkan dengan proses permintaan jika token valid
        return $next($request);
    }
}
