<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\NcmController;

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

// Rotas de criação de login (conta) DEVEM ser públicas
Route::get('/logins/create', [LoginController::class, 'create'])->name('logins.create');
Route::post('/logins', [LoginController::class, 'store'])->name('logins.store');

// Logout (pode deixar GET por enquanto; em produção prefira POST)
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// CRUD de empresas — público (como você já queria)
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

    // Empresas
    Route::get('/empresas/create-user/{cnpj?}', function ($cnpj = null) {
        return view('empresas.create_user', compact('cnpj'));
    })->name('empresas.create_user');

    Route::resource('fornecedores', FornecedorController::class);

    Route::resource('categorias', CategoriaController::class);

    Route::resource('ncms', NcmController::class);

    // (demais rotas internas que exigem usuário logado...)


});
