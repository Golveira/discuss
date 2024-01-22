<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Usernotnull\Toast\Concerns\WireToast;

class RedirectIfBanned
{
    use WireToast;

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->isBanned()) {
            toast()->warning('This account is banned')->pushOnNextPage();

            Auth::logout();

            return redirect()->route(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
