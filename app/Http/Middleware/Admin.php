<?php

namespace App\Http\Middleware;
use Auth;
use App\Models\Role;
use Closure;

class Admin
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
        $danger = array(
            'message' => 'Sorry you are not allowed to view this page',
            'alert-type' => 'error'
        );

        if(Auth::user()->role_id == 2 or Auth::user()->role_id == 5 or Auth::user()->role_id == 1)
        {
            return $next($request);
        }else{
            return redirect()->route('dashboard')->with($danger);
        }
    }
}
