<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class CheckApiKey
{
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-Key')
            ?? $request->query('api_key')
            ?? $request->query('API_KEY');

        if (! $apiKey) {
            return response()->json([
                'error' => 'API key is required in X-API-Key header.'
            ], 401);
        }

        if (! Str::isUuid($apiKey)) {
            return response()->json([
                'error' => 'Invalid API key format.'
            ], 401);
        }

        $user = User::query()->where('api_key', $apiKey)->first();

        if (! $user) {
            return response()->json([
                'error' => 'Authentication failed. Invalid API key.'
            ], 401);
        }

        $request->attributes->set('apiUser', $user);

        return $next($request);
    }
}