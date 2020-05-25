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
        if(config('app.env') === 'production') {
                \URL::forceScheme('https');
        }
    }
}
