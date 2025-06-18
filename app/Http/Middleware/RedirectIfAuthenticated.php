<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
{
    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            if ($guard === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('dashboard'); // pelanggan/user
        }
    }

    return $next($request);
}

    
    
}
