<?php


namespace SIGA\Http\ViewComposers;


use Illuminate\View\View;

class TenantComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('tenant', get_tenant());
    }
}
