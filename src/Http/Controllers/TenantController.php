<?php


namespace SIGA\Http\Controllers;

use SIGA\Http\AbstractController;
use SIGA\Repositories\TenantRepository;
use SIGA\Tenant;

class TenantController extends AbstractController
{
    protected $prefix = '';
    protected $template ='tenants';
    protected $model = Tenant::class;
    protected $repository = TenantRepository::class;
}
