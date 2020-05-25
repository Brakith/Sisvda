<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Accedo a la configuracion ir a la clave env y verificar si esta en ambiente de produccion 
        // Si esta en produccion forzo a que los recursos sean cargados por https
        if(config('app.env') === 'production') {
                \URL::forceScheme('https');
        }
    }
}
