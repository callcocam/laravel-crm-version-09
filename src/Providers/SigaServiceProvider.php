<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Providers;


use Illuminate\Support\ServiceProvider;
use SIGA\Acl\AclServiceProvider;
use SIGA\Console\Commands\AddPermissionsComand;
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


        $this->mergeConfigFrom(
            __DIR__.'/../../config/siga.php', 'siga'
        );

        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        $this->app->register(MenuServiceProvider::class);

        $this->app->register(AclServiceProvider::class);

        $this->app->register(LvServiceProvider::class);

        $this->app->register(AutoRouteServiceProvider::class);

        $this->app->register(ComposerServiceProvider::class);

        $this->app->register(MacroServiceProvider::class);

        $this->app->register(SigaRouteServiceProvider::class);

        $this->loadViewsFrom(siga_path('resources/views'),'siga');

        $this->commands(AddPermissionsComand::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishMigrations();
        $this->loadMigrations();
    }

    /**
     * Publish the migration files.
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('migrations'),
        ], 'siga-migrations');

        $this->publishes([
            __DIR__.'/../../database/seeds/' => database_path('seeds'),
        ], 'siga-seeds');

        $this->publishes([
            __DIR__.'/../../database/factories/' => database_path('factories'),
        ], 'siga-factories');
    }

    /**
     * Load our migration files.
     *
     * @return void
     */
    protected function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadFactoriesFrom(__DIR__.'/../../database/factories');
    }
}
