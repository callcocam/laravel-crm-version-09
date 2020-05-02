<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Http\Middleware;

use Closure;

class NotTenantMiddleware
{
    private $tenant;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($this->getTenant()) :
            return redirect()->route('home');
        endif;

        return $next($request);
    }

    protected function getTenant(){

        $this->tenant = get_tenant_id();

        return $this->tenant;
    }
}
