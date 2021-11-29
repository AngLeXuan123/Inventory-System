<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class checkAdmin
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
        if(Auth::check()){

             //if user is not admin take him to his dashboard
            if(Auth::user()->isUser()){
                return redirect(route('userHome'));
            }

             //allow admin to proceed with request
            else if(Auth::user()->isAdmin()){
                return $next($request);
            }
        }
        abort(404);
    }
}