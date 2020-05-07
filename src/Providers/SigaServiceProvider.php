<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Providers;


use Illuminate\Support\ServiceProvider;
use SIGA\Router\AutoRouteServiceProvider;
use SIGA\LvTable\LvServiceProvider;

class SigaServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        $this->app->register(LvServiceProvider::class);

        $this->app->register(AutoRouteServiceProvider::class);

        $this->app->register(ComposerServiceProvider::class);

        $this->app->register(MacroServiceProvider::class);

        $this->app->register(SigaRouteServiceProvider::class);

        $this->loadViewsFrom(siga_path('resources/views'),'siga');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
