<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PelatihOrAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $request->user()['role'] == 'pelatih' || $request->user()['role'] == 'admin'
            ? $next($request)
            : abort(redirect()->back()->with('err', 'unauthorized'));
    }
}
