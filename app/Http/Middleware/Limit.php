<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use App\Models\Role;
use Illuminate\Support\Facades\Redirect;

class Limit
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
            'message' => 'Please contact the finance team to activate your account for request',
            'alert-type' => 'error'
        );

        if(Auth::user()->limit !== 0)
        {
            return $next($request);
        }else{
            return redirect()->back('dashboard')->with($danger);
        }
    }
}
