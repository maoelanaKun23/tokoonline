<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || (Auth::user()->role !== 'admin' && Auth::user()->role != 1)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}

