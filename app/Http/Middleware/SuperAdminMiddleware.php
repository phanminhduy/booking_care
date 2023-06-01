<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ( !isSuperAdmin()) {
            return redirect()->route('admin.home');
        }

        return $next($request);
    }
}
