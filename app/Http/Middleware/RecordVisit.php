<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visit;
use Carbon\Carbon;

class RecordVisit
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only record GET requests and skip Filament admin routes
        if ($request->isMethod('get') && !str_starts_with($request->path(), 'admin')) {
            try {
                Visit::create([
                    'path' => '/'.$request->path(),
                    'ip' => $request->ip(),
                    'visited_at' => Carbon::now(),
                ]);
            } catch (\Throwable $e) {
                // Silently ignore recording errors to avoid user-facing issues
            }
        }

        return $response;
    }
}
