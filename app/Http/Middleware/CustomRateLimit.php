<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class CustomRateLimit
{
    /**
     * Handle an incoming request.
     *
     * Usage:
     * ->middleware('custom.rate:login,5,1')
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $key
     * @param  int  $maxAttempts
     * @param  int  $decayMinutes
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $key = 'api', int $maxAttempts = 60, int $decayMinutes = 1): Response
    {
        $signature = $this->resolveRequestSignature($request, $key);

        if (RateLimiter::tooManyAttempts($signature, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($signature);

            return response()->json([
                'success' => false,
                'message' => 'Too many requests. Please try again in ' . $seconds . ' seconds.',
                'retry_after' => $seconds,
            ], 429);
        }

        RateLimiter::hit($signature, $decayMinutes * 60);

        $response = $next($request);

        $response->headers->set('X-RateLimit-Limit', $maxAttempts);
        $response->headers->set('X-RateLimit-Remaining', RateLimiter::remaining($signature, $maxAttempts));
        $response->headers->set('X-RateLimit-Reset', now()->addSeconds(RateLimiter::availableIn($signature))->timestamp);

        return $response;
    }

    /**
     * Make the limiter unique per route + IP/user.
     */
    protected function resolveRequestSignature(Request $request, string $key): string
    {
        $routePart = $request->route()?->uri() ?? $request->path();
        $methodPart = $request->method();

        $userPart = $request->user()
            ? 'user:' . $request->user()->id
            : 'ip:' . $request->ip();

        return implode(':', [
            $key,
            $methodPart,
            $routePart,
            $userPart,
        ]);
    }
}
