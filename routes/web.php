<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\LoginController;

// Página inicial redireciona para login ou dashboard
Route::get('/', function () {
    if (session()->has('usuario')) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login.form');
});

// Rotas públicas (somente para usuários NÃO logados)
Route::group([
    'middleware' => function ($request, $next) {
        if (session()->has('usuario')) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

// Logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// CRUD de empresas — acesso público
Route::resource('empresas', EmpresaController::class);

// Rotas protegidas por sessão "usuario"
Route::group([
    'middleware' => function ($request, $next) {
        if (!session()->has('usuario')) {
            return redirect()->route('login.form')->withErrors([
                'erro' => 'Você precisa estar logado para acessar esta página.'
            ]);
        }
        return $next($request);
    }
], function () {
    // Dashboard
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');

    // Rotas para criação de login (conta)
    Route::get('/logins/create', [LoginController::class, 'create'])->name('logins.create');
    Route::post('/logins', [LoginController::class, 'store'])->name('logins.store');
});
