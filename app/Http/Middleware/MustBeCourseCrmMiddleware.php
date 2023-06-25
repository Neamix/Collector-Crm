<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;

class MustBeCourseCrmMiddleware
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
        $setting_type = Setting::where('option','system_type')->first();

        if ($setting_type->value != 'course_managment_system') {
            return response([
                'error' => "error: System Admin has to activate course managment mode first"
            ],403);
        }

        return $next($request);
    }
}
