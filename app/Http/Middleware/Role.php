<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
{
    $user = auth('admin')->user();
    if (!$user || !in_array($user->role, $roles)) {
        abort(403, 'Akses ditolak.');
    }
    return $next($request);
}

}
