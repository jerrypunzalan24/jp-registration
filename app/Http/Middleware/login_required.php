<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;

class login_required
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
        if($request->session()->has('login')){ 
            return $next($request);   
        }
        return redirect('/login');
    }
}
