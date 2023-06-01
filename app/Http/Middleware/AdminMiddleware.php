<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!isAdmin() & !isSuperAdmin()) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
