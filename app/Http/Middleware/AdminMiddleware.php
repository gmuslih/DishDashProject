<?php

// app/Http/Middleware/AdminMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is an admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);  // Allow the request to proceed
        }

        // If not admin, redirect to dashboard with error message
        return redirect('/dashboard')->with('error', 'You do not have permission to perform this action.');
    }
}

