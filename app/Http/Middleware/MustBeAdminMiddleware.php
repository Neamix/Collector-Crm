<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MustBeAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /*** Allow only admins to access */
        if ( Auth::check() ) {
            if ( Auth::user()->type == ADMIN ) {
                return $next($request);
            }
        }

        /*** If user not admin throw error */
        throw new Exception("Auth Must Be Admin To Be Allowed To Pass Throw");
    }
}
