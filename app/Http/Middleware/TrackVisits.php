<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visit;
use Illuminate\Support\Facades\Auth;

class TrackVisits
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->is('admin/*') && !$request->is('livewire/*')) {
            try {
                Visit::create([
                    'ip_address' => $request->ip(),
                    'url' => $request->path(),
                    'user_agent' => $request->userAgent(),
                    'user_id' => Auth::id(),
                ]);
            } catch (\Exception $e) {
                // Do not fail request if analytics fail
            }
        }

        return $next($request);
    }
}
