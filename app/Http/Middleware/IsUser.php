<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsUser
{

    public function handle($request, Closure $next)
    {
        if (Auth::user() && (Auth::user()->role == 'user')) {
            return $next($request);
        }

        return redirect('/');
    }
}
