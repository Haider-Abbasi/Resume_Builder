<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and is an admin
        if (Auth::check() && Auth::user()->user_type === 'admin') {
            // User is an admin, allow access to the requested page
            return $next($request);
        }

        // User is not an admin, redirect them to a suitable route or show an error message
        return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
    }
}
