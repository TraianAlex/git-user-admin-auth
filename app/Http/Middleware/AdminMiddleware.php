<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!auth()->guard('admins')->check()){
            return redirect()->back();
        }

        return $next($request);
    }
}
