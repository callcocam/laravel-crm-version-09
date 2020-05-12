<?php


namespace SIGA\Http\Controllers;


use SIGA\Acl\Permission;
use SIGA\Acl\Repositories\PermissionRepository;
use SIGA\Http\AbstractController;

class PermissionController extends AbstractController
{
    protected $prefix = '';
    protected $template ='roles';
    protected $model = Permission::class;
    protected $repository = PermissionRepository::class;
}
