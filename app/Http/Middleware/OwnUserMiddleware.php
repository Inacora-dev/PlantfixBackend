<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OwnUserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $routeUser = $request->route('user');
        $routeUserId = is_object($routeUser) ? $routeUser->id : $routeUser;

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Permitir si es admin o dueño del recurso
        if ($user->role === 'admin' || $user->id == $routeUserId) {
            return $next($request);
        }

        abort(403, 'Forbidden: no tienes permiso para modificar este usuario');
    }
}

