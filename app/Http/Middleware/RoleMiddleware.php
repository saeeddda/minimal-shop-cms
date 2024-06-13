<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role, $permission = null)
    {
        if(
            (!$request->user()->hasRole($role) && $permission == null) ||
            ($permission != null && !$request->user()->can($permission))
        )
            abort(403);

        return $next($request);
    }
}
