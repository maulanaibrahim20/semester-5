<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = NULL)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->role_id == 1) {
                return redirect("/kepala_puskesmas/dashboard");
            } else if (Auth::user()->role_id == 2) {
                return redirect("/kepala_desa/dashboard");
            } else if (Auth::user()->role_id == 3) {
                return redirect("/kepala_kecamatan/dashboard");
            } else if (Auth::user()->role_id == 4) {
                return redirect("/admin/dashboard");
            } else if (Auth::user()->role_id == 5) {
                return redirect("/bidan/dashboard");
            }
        }

        return $next($request);
    }
}
