<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DoctorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!isDoctor()) {
            return redirect()->route('doctor.login');
        }
        return $next($request);
    }
}
