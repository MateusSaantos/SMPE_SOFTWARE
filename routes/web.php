<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('empresas', EmpresaController::class);