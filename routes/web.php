<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\LoginController;

// Página inicial redireciona para login
Route::get('/', function () {
    return redirect()->route('login.form');
});

// Rotas públicas (sem login)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Rotas protegidas por autenticação
Route::middleware(['autenticar'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');

    // Rotas para criação de login (conta)
    Route::get('/logins/create', [LoginController::class, 'create'])->name('logins.create');
    Route::post('/logins', [LoginController::class, 'store'])->name('logins.store');

    // CRUD de empresas
    Route::resource('empresas', EmpresaController::class);
});
