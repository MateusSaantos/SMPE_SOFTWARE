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
        View::composer('*', function ($view) {
            $usuario = null;

            if (Session::has('usuario')) {
                $usuario = Login::where('id', Session::get('usuario'))->first(); // Usa ->first() para pegar 1 resultado
            }

            $view->with('usuario', $usuario);
        });
    }
}
