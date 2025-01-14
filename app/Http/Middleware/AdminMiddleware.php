<?php


// app/Http/Middleware/AdminMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->email !== 'admin@gmail.com') {
            return redirect('/user-dashboard');  // Redirect non-admins to user dashboard
        }

        return $next($request);
    }
}


