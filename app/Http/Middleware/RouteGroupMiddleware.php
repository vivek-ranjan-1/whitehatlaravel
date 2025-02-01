<?php

namespace App\Http\Middleware;

use Closure;

class RouteGroupMiddleware
{
    public function handle($request, Closure $next)
    {
        $action = $request->route()->getAction();
        $prefix = explode('/', @$action['prefix']);
        $routeGroup = @$prefix[1];
        \View::share('currentRouteGroup', $routeGroup);

        return $next($request);
    }
}
