<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
   public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_admin === 1 ) {
            return $next($request);
        }

        abort(403, 'Accès refusé. Vous n\'êtes pas autorisé à accéder à cette page.');
}

}