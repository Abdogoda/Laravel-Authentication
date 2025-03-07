<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware{

    public function handle(Request $request, Closure $next, string $permission): Response{
        if(!Auth::user() || !Auth::user()->hasPermission($permission)) abort(403, 'Unauthorized action');
        return $next($request);
    }
}
