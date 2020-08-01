<?php

namespace App\Http\Middleware;

use Closure;
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
    public function handle($request, Closure $next)
    {
        if((Auth::check())) {
            $role = Auth::user()->role;
            $type = Auth::user()->type;
            if($role=='Admin' && $type=='1'){
                return $next($request);
            }else{
                return redirect(url('/admin-login'));
            }

        }else{
            return redirect(url('/admin-login'));
        }
    }
}
