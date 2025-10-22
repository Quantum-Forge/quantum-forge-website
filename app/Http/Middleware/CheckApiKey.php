<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requiredKey = env('NEWS_INTERNAL_API_KEY');

        // If no key configured, deny by default to avoid exposing unauthenticated API.
        if (empty($requiredKey)) {
            return response()->json([
                'message' => 'API key is not configured',
            ], 503);
        }

        $providedKey = $request->header('X-Api-Key');
        if ($providedKey !== $requiredKey) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        return $next($request);
    }
}