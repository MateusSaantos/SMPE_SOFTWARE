<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AutenticarUsuario
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('usuario')) {
            return redirect()->route('login.form')->withErrors([
                'erro' => 'Você precisa estar logado para acessar esta página.'
            ]);
        }

        return $next($request);
    }
}
