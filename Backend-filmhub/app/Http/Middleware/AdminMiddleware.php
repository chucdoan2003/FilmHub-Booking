<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    $user = Auth::user();

    if ($user && ($user->status === 'admin' || $user->status === 'manager')) {
        return $next($request);
    }

    return redirect()->route('movies.index')->with('error', 'Bạn không có quyền truy cập!');
}
}
