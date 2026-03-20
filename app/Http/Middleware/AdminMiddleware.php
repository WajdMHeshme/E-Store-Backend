<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || $user->role !== User::ROLE_ADMIN) {
            return response()->json([
                'message' => 'Unauthorized - this is for admins only.'
            ], 403);
        }

        return $next($request);
    }
}
