<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware'=>['tenant']],function (\Illuminate\Routing\Router $router){


    $default_tenant_main = config('tenant.default_tenant_main');

    $current_tenant = request()->getHost();

  \Illuminate\Support\Facades\Auth::routes([
      'register'=>$default_tenant_main !== $current_tenant
  ]);

});
