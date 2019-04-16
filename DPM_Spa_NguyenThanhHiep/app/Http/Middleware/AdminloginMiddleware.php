<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminloginMiddleware
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
        if(Auth::check())
        {
            $user = Auth::User();
            if($user ->user_status == 2)
            {
                return $next($request);
            }
            else
                return redirect('/');
        }  
        else
        {
            return redirect('/dangnhap');
        }
    }
}
