<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            return redirect('/'); // Przekierowanie, jeśli nie jest administratorem
        }

        return $next($request);
    }
}
