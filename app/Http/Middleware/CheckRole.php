<?php
//
//namespace App\Http\Middleware;
//
//use Closure;
//use Illuminate\Http\Request;
//use Symfony\Component\HttpFoundation\Response;
//
//class CheckRole
//{
//    /**
//     * Handle an incoming request.
//     *
//     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//     */
//    public function handle(Request $request, Closure $next): Response
//    {
//        return $next($request);
//    }
//}

// app/Http/Middleware/CheckRole.php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check() || auth()->user()->role !== $role) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
