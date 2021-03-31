<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class PermisoMiddleware
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
		if(Auth::user()->hasAccess()){
        	return $next($request);
		}
		else{
			Session::flash('flash_message', 'No tienes permiso para ingresar a esta sección!!');
			return redirect()->guest(route('home'));
		}
    }
}
