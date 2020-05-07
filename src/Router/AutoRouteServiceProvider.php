<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Router;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AutoRouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('autoRoute',
            function($app) {
                return new AutoRouteService(app(Router::class));
            });
    }
}
