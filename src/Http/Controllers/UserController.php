<?php


namespace SIGA\Http\Controllers;


use SIGA\Repositories\UserRepository;
use SIGA\Http\AbstractController;
use SIGA\User;

class UserController extends AbstractController
{
    protected $prefix = '';
    protected $template ='roles';
    protected $model = User::class;
    protected $repository = UserRepository::class;
}
