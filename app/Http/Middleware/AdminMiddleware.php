<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->perfil !== 'admin') {
            abort(403, 'Acceso no autorizado');
        }

        return $next($request);
    }
}
