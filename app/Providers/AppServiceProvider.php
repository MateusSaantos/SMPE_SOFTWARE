<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Models\Login;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Injeta $usuario em TODAS as views, sem bater no banco desnecessariamente
        View::composer('*', function ($view) {
            $usuario = null;

            if (Session::has('usuario')) {
                // O seu login salva um ARRAY na sessão: ['id' => ..., 'email' => ..., 'cnpj' => ...]
                $sessUser = Session::get('usuario');

                // Usa os dados da sessão diretamente (mais rápido e suficiente pro header)
                // Converto para objeto para funcionar com {{ $usuario->email }} no Blade
                $usuario = (object) [
                    'id'    => $sessUser['id']   ?? null,
                    'email' => $sessUser['email']?? null,
                    'cnpj'  => $sessUser['cnpj'] ?? null,
                ];

                // --- OPCIONAL (fallback) ---
                // Se você quiser garantir dados SEMPRE atualizados do banco (por ex. email mudou),
                // descomente as 3 linhas abaixo. Isso faz 1 consulta por request.
                /*
                if (!empty($usuario->id)) {
                    if ($db = Login::find($usuario->id)) {
                        $usuario = $db; // agora é o model completo
                    }
                }
                */
            }

            $view->with('usuario', $usuario);
        });
    }
}
