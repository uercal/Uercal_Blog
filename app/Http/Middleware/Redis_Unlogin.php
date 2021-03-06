<?php

namespace App\Http\Middleware;

use Closure;

use \Illuminate\Support\Facades\Redis;
class Redis_Unlogin
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
        $user = session('login_user');
        if(!$user){
            return redirect('/');
        }
        return $next($request);
    }
}
