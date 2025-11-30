<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\Suscripcion;

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
        /**
         * Compartir variable $suscrito en TODAS las vistas
         */
        View::composer('*', function ($view) {

            $suscrito = false;

            // ✅ Caso 1: Usuario logueado
            if (Auth::check()) {
                $suscrito = Suscripcion::where('id_usuario', Auth::user()->id_usuario)
                    ->where('estado', 'activo')
                    ->exists();
            }
            // ✅ Caso 2: Visitante (por cookie)
            else if (Cookie::has('suscrito_email')) {
                $suscrito = Suscripcion::where('correo', Cookie::get('suscrito_email'))
                    ->where('estado', 'activo')
                    ->exists();
            }

            $view->with('suscrito', $suscrito);
        });
    }
}
