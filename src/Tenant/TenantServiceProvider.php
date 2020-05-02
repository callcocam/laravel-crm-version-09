<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Tenant;

use SIGA\Tenant\Facades\Tenant;
use Illuminate\Support\ServiceProvider;

class TenantServiceProvider extends ServiceProvider
{

    private $company;
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if (function_exists('config_path')) {
            $this->publishes([

                realpath(__DIR__.'/../../config/tenant.php') => config_path('tenant.php')

            ]);
        }

        $tenant = \DB::table('tenants')->where('domain', request()->getHost())->first();

        if($tenant){

            Tenant::addTenant("tenant_id", $tenant->id);

            view()->share('tenant',  $tenant);

        }



    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TenantManager::class, function () {
            return new TenantManager();
        });
    }
}
