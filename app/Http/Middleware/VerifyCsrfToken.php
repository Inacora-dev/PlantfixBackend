<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    // URIs que serán excluidas de la verificación CSRF
    protected $except = [
        // Puedes excluir rutas aquí si decides no verificar CSRF en ciertas APIs
    ];
}
