<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\NcmController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\NotaFiscalController;
use App\Http\Controllers\NotaFiscalItemController;
use App\Http\Controllers\SimulacaoPrecoController;
use App\Http\Controllers\EducativosController;

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

// CRUD de empresas — público
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

    // Cadastros
    Route::resource('fornecedores', FornecedorController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('ncms', NcmController::class);
    Route::resource('produtos', ProdutoController::class);

    // Importação de XML de NF-e
    Route::get ('notas/importar-xml',        [NotaFiscalController::class, 'importForm'])->name('notas.import.form');
    Route::post('notas/importar-xml',        [NotaFiscalController::class, 'importPreview'])->name('notas.import.preview'); // <= muda para preview
    Route::post('notas/importar-xml/commit', [NotaFiscalController::class, 'importCommit'])->name('notas.import.commit');

    // Notas fiscais (resource)
    Route::resource('notas', NotaFiscalController::class);

    // Itens da nota
    Route::get('notas/{nota}/itens', [NotaFiscalItemController::class, 'index'])->name('notas.itens');
    Route::post('notas/{nota}/itens', [NotaFiscalItemController::class, 'store'])->name('notas.itens.store');
    Route::put('notas/{nota}/itens/{item}', [NotaFiscalItemController::class, 'update'])->name('notas.itens.update');
    Route::delete('notas/{nota}/itens/{item}', [NotaFiscalItemController::class, 'destroy'])->name('notas.itens.destroy');

    // Simulações de preços
    Route::get   ('/simulacoes-precos',        [SimulacaoPrecoController::class, 'index'])->name('simulacoes-precos.index');
    Route::get   ('/simulacoes-precos/criar',  [SimulacaoPrecoController::class, 'create'])->name('simulacoes-precos.create');
    Route::post  ('/simulacoes-precos',        [SimulacaoPrecoController::class, 'store'])->name('simulacoes-precos.store');
    Route::delete('/simulacoes-precos/{simulacao}', [SimulacaoPrecoController::class, 'destroy'])->name('simulacoes-precos.destroy');

    // Conteúdos educativos
    Route::get('/educativos',                [EducativosController::class, 'index'])->name('educativos.index');          // categorias
    Route::get('/educativos/c/{catSlug}',    [EducativosController::class, 'categoryList'])->name('educativos.category'); // itens por categoria
    Route::get('/educativos/{slug}',         [EducativosController::class, 'show'])->name('educativos.show');            // conteúdo
    Route::post('/educativos/{id}/toggle',   [EducativosController::class, 'toggleVisited'])->name('educativos.toggleVisited');
    // (demais rotas internas que exigem usuário logado...)
});
