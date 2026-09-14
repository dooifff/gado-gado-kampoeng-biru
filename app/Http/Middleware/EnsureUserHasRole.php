<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Pastikan user yang login memiliki salah satu role yang diizinkan.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (auth()->guest()) {
            return redirect()->route('admin.login');
        }

        abort_if(! auth()->user()->hasRole(...$roles), 403);

        return $next($request);
    }
}