<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Providers;


use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
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
        \Schema::defaultStringLength('255');
        $platform = \Schema::getConnection()->getDoctrineSchemaManager()->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');

        collect(glob(__DIR__ . '/../../macros/database/*.php'))
            ->each(function($path) {
                require $path;
            });

        /* A little hack to have Builder::hasMacro */
        \Illuminate\Database\Eloquent\Builder::macro('hasMacro', function($name) {
            return isset(static::$macros[$name]);
        });

        collect(glob(__DIR__ . '/../../macros/model/*.php'))
            ->each(function($path) {
                require $path;
            });
    }
}
