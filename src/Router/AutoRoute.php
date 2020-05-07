<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Router;


use Illuminate\Support\Facades\Facade;

class AutoRoute extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'autoRoute';
    }
}
