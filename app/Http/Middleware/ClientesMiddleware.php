<?php

namespace App\Http\Middleware;

use Closure;

class ClientesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'clientes')
    {   
        if(!auth()->guard($guard)->check()){
            return redirect()->route('/login');
        }
        return $next($request);
    }
}
