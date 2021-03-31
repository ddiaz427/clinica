<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Session;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                Session::flash('flash_message', 'Para ingresar a esta sección debes estar logueado!!');
                return redirect()->guest(route('login'));
            }
        }
		/*else{
			if(!$this->auth->user()->hasAccess()){
				if ($request->ajax()) {
					return response('Unauthorized.', 401);
				} else {
					Session::flash('flash_message', 'No tienes permiso para ingresar a esta sección!!');
					return redirect()->guest(route('home'));
				}
			}
		}*/

        return $next($request);
    }
}
