<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsStudent
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in to continue.');
        }

        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Admins cannot book tickets.');
        }

        return $next($request);
    }
}
