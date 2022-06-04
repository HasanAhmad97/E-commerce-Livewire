<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class authAdmin
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
        if(session('userType') === 'Admin'){
            return $next($request);
        }
        else{
            session()->flash();
            return redirect()->route('login');
        }
//        return $next($request);
    }
}
