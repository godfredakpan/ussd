<?php

namespace App\Http\Middleware;
use Auth;
use App\Models\Role;
use Closure;

class Verify
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
            return $next($request);
        }else{
            return redirect(route('login'));
        }
    }
}
