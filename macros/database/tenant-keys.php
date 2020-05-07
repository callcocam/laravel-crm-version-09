<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
use Illuminate\Database\Schema\Blueprint;

Blueprint::macro('uuidId', function($name="id"){
    $this->uuid($name)->primary();
});

Blueprint::macro('tenant', function($name="tenant_id"){
    $this->uuid($name)->nullable();
    $this
        ->foreign($name)
        ->references('id')
        ->on('tenants')
        ->onUpdate('cascade')
        ->onDelete('cascade');
});

Blueprint::macro('user', function($name="user_id"){
    $this->uuid($name)->nullable();
    $this
        ->foreign($name)
        ->references('id')
        ->on('users')
        ->onUpdate('cascade')
        ->onDelete('cascade');
});

Blueprint::macro('status', function($status =[]){
    $this->enum('status', array_merge([  'deleted','draft','published'], $status))->default('published');
});

Blueprint::macro('tenantUnique', function($column,$tenant="tenant_id"){
    $this->unique([$column,$tenant]);
});
