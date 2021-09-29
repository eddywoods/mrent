<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
         if ($request->user() === null) 
        {
            return response('Insufficient Permissions', 401);
        }

        $roles = $this->getRequiredRoleForRoute($request->route());

        if ($request->user()->hasRole($roles) || !$roles) {
                return $next($request);
        }
        auth()->logout();

        return response()->view('errors.401', [], 401);
    }

    private function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();
        return isset($actions['roles']) ? $actions['roles'] : null;
    }
}



