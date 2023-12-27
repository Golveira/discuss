<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Usernotnull\Toast\Concerns\WireToast;

class RedirectIfBanned
{
    use WireToast;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->isBanned()) {
            toast()->warning('This account is banned')->pushOnNextPage();

            Auth::logout();

            return redirect()->route('home');
        }

        return $next($request);
    }
}
