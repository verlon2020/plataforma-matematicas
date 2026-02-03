<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Mapeo de roles
        $roles = [
            'Admin' => 1,
            'Profesor' => 2,
            'Estudiante' => 3,
        ];

        // Validación segura
        if (!isset($roles[$role]) || $user->role_id != $roles[$role]) {
            abort(403, 'Acceso denegado');
        }

        return $next($request);
    }
}
