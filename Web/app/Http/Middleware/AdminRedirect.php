<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminRedirect
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->email !== 'admin@gmail.com') {
            return redirect('/home'); // Redirect to home if not admin
        }
        return $next($request);
    }
}
