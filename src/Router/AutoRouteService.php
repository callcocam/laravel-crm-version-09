<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Router;

use Illuminate\Routing\Router;


class AutoRouteService
{
    protected $middleware;
    protected $pattern;
    /**
     * @var \Illuminate\Routing\Route
     */
    private $route;

    /**
     * AutoRouteDbService constructor.
     * @param \Illuminate\Routing\Router $route
     */
    public function __construct(Router $route)
    {
        $this->route = $route;
    }


    /**
     * @param $middleware
     * @return AutoRouteService
     */
    public function setMiddleware($middleware)
    {
        $this->middleware = $middleware;

        return $this;
    }

    /**
     * @param $pattern
     * @return AutoRouteService
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;

        return $this;
    }

    protected function register($router, $route)
    {
        if (!empty($route)) {
            $router->name($route);
        }
        if ($this->middleware) {
            $router->middleware($this->middleware);
        }
        return $router;
    }

    public function resources($path, $resource, $route)
    {
        $this->route->resource($this->pattern($path), $resource)->names([
            'index' => sprintf('admin.%s.index', $route),
            'create' => sprintf('admin.%s.create', $route),
            'store' => sprintf('admin.%s.store', $route),
            'show' => sprintf('admin.%s.show', $route),
            'edit' => sprintf('admin.%s.edit', $route),
            'update' => sprintf('admin.%s.update', $route),
            'destroy' => sprintf('admin.%s.destroy', $route),
        ])->parameters([
            $route => 'id'
        ]);

        if ($this->middleware) {
            $this->route->middleware($this->middleware);
        }
    }


    /**
     * @param string $api
     * @param string $namespace
     * @param string $path /posts
     * @param string $name
     * @return mixed
     */
    public function auth($api="v1", $namespace="Auth", $path = 'admin', $name = 'api')
    {
        $this->route->prefix($api)
            ->namespace($namespace)
            ->group(function ($router) use($path,$name) {
                $router->prefix($path)->group(function ($router) use($name, $path) {
                    $router->post('login', 'LoginController@login')->name(sprintf('%s.%s.login', $name, $path));
                    $router->post('register', 'RegisterController@register')->name(sprintf('%s.%s.register', $name, $path));
                    $router->post('refresh', 'RefreshTokenController@refresh')->name(sprintf('%s.%s.refresh', $name, $path));
                    $router->post('reset-password', 'ResetLinkController@sendLinkEmail')->name(sprintf('%s.%s.reset.password.email', $name, $path));
                    $router->post('reset/password', 'ResetPasswordController@updatePassword')->name(sprintf('%s.%s.reset.password.email', $name, $path));
                });
            });
        return $this->route;
    }

    /**
     * @param string $api
     * @param string $namespace
     * @param string $middleware
     * @param string $path /posts
     * @param string $name
     * @return mixed
     */
    public function guest($api="v1", $namespace="Auth", $middleware = 'auth:api',$path = 'admin', $name = 'api')
    {
        $this->route->prefix($api)
            ->namespace($namespace)
            ->middleware($middleware)
            ->group(function ($router) use($path,$name) {
                $router->prefix($path)->group(function ($router) use($name, $path) {
                    $router->post('logout', 'LogoutController@logout')->name(sprintf('%s.%s.logout', $name, $path));
                    $router->get('me', 'MeController@me')->name(sprintf('%s.%s.me', $name, $path));
                    $router->post('profile', 'ProfileController@profile')->name(sprintf('%s.%s.profile', $name, $path));
                });
            });
        return $this->route;
    }

    private function pattern($resource)
    {

        if (!empty($this->pattern)) {
            return sprintf("%s/%s", $resource, $this->pattern);
        }

        return $resource;
    }
}
