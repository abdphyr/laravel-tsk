<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if ($role === 'manager') {
            return !$this->isManager($request) ? redirect('client') : $next($request);
        } elseif ($role === 'client') {
            return $this->isManager($request) ? redirect('manager') : $next($request);
        } elseif ($role === 'unknown') {
            return $this->isManager($request) ? redirect('manager') : redirect('client');
        }
        return $next($request);
    }

    private function isManager($request)
    {
        return $request->user()->role->name === 'manager';
    }
}
