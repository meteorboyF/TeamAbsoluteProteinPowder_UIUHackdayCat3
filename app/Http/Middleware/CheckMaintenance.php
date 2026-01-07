<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Core\SettingService;
use Illuminate\Support\Facades\Auth;

class CheckMaintenance
{
    public function handle(Request $request, Closure $next): Response
    {
        $isDown = (new SettingService())->get('maintenance_mode', false);

        if ($isDown) {
            // Allow admins to bypass
            if (Auth::check() && Auth::user()->hasRole('admin')) {
                return $next($request);
            }

            // Allow login/register logic so admins can login
            if ($request->is('login') || $request->is('register') || $request->is('admin/*')) {
                return $next($request);
            }

            abort(503, 'System in Maintenance Mode');
        }

        return $next($request);
    }
}
