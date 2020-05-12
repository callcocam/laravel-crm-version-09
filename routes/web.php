<?php

\Route::view("tenant/404", "siga::errors.tenant-404")->middleware(['not-tenant'])->name('tenant.404');
\Route::view("tenant/401", "siga::errors.denies-401")->name('access.denies.401');
Route::get('lang/{locale}',  'AdminController@swap')->name('locale');
Route::prefix("admin")
    ->middleware(['tenant','auth'])
   ->group(function ($router){

        $router->get('', 'AdminController@index')->name('admin');
        \SIGA\Router\AutoRoute::resources('tenants','TenantController','tenants');
        \SIGA\Router\AutoRoute::resources('users','UserController','users');
        \SIGA\Router\AutoRoute::resources('roles','RoleController','roles');
        \SIGA\Router\AutoRoute::resources('permissions','PermissionController','permissions');
        // locale Route


    });
