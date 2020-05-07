<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\LvTable;

use SIGA\Tenant\Facades\Tenant;
use Illuminate\Support\ServiceProvider;

class LvServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

        if (function_exists('config_path')) {
            $this->publishes([

                realpath(__DIR__.'/../../config/lv-table.php') => config_path('lv-table.php')

            ], 'lv-table');
        }



    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->loadViewsFrom(siga_path('resources/views/lv-table')  , 'lv-table');
    }
}
