<?php

if (!function_exists('siga_path')){

    function siga_path($path=""){

        return sprintf("%s/%s",__DIR__, $path);
    }
}

if (!function_exists('get_layout')){

    function get_layout($path, $layout=null){

        if($layout)
           return sprintf("%s::%s",$layout, $path);

           return sprintf("%s::%s",config('siga.prefix'), $path);
    }
}

if (!function_exists('get_theme_table')){

    function get_theme_table($path){

        return sprintf("lv-table::%s", $path);
    }
}

if (!function_exists('link_to_route_icon')) {
    /**
     * Get the configuration path.
     *
     * @param $name
     * @param null $title
     * @param array $parameters
     * @param array $attributes
     * @param null $append
     * @return string
     */
    function link_to_route_icon($name, $title = null, $parameters = [], $attributes = [], $append=null)
    {

        return app(\SIGA\Html\ShHtml::class)->link_to_route_icon($name, $title, $parameters, $attributes, $append);
    }
}

if (!function_exists('submit_to_icon')) {
    /**
     * Get the configuration path.
     *
     * @param $value
     * @param array $attributes
     * @param null $append
     * @return string
     */
    function submit_to_icon($value, $attributes = [], $append=null)
    {

        return app(\SIGA\Html\ShForm::class)->submit_to_icon($value, $attributes, $append);
    }
}

if (!function_exists('xy_menu')) {
    /**
     * Get the configuration path.
     *
     * @param $value
     * @return string
     */
    function xy_menu($value)
    {

        return app(\SIGA\Html\ShMenu::class)->xy_menu($value);
    }
}

if (!function_exists('xy_submenu')) {
    /**
     * Get the configuration path.
     *
     * @param $value
     * @return string
     */
    function xy_submenu($value)
    {

        return app(\SIGA\Html\ShMenu::class)->xy_submenu($value);
    }
}

if (!function_exists('button_to_icon')) {
    /**
     * Get the configuration path.
     *
     * @param $value
     * @param array $attributes
     * @param null $append
     * @return string
     */
    function button_to_icon($value, $attributes = [], $append=null)
    {

        return app(\SIGA\Html\ShForm::class)->button_to_icon($value, $attributes, $append);
    }
}

if (!function_exists('get_tenant_id')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function get_tenant_id($tenant = 'tenant_id')
    {
        $tenantId = \SIGA\Tenant\Facades\Tenant::getTenantId($tenant);
        return $tenantId;
    }
}

if (!function_exists('get_tenant')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function get_tenant()
    {
        return \Illuminate\Support\Facades\DB::table('tenants')->where('id',get_tenant_id())->first();
    }
}



if (!function_exists('date_carbom_format')) {

    function date_carbom_format($date, $format = "d/m/Y H:i:s")
    {

        $date = explode(" ", str_replace(["-", "/", ":"], " ", $date));

        if (!isset($date[0])) {
            $date[0] = null;
        }
        if (!isset($date[1])) {
            $date[1] = null;
        }
        if (!isset($date[2])) {
            $date[2] = null;
        }
        if (!isset($date[3])) {
            $date[3] = null;
        }
        if (!isset($date[4])) {
            $date[4] = null;
        }
        if (!isset($date[5])) {
            $date[5] = null;
        }
        list($y, $m, $d, $h, $i, $s) = $date;

        //$carbon = \Carbon\Carbon::now();
        $carbon = \Illuminate\Support\Facades\Date::now();
        $carbon->locale('pt-BR');
        if (strlen($date[0]) == 4) {
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toDateTimeLocalString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toDayDateTimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toLongDateString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toFullDateString().PHP_EOL;
            //
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toShortTimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toMediumTimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toLongTimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toFullTimeString().PHP_EOL;
            //
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toShortDatetimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toMediumDatetimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toLongDatetimeString().PHP_EOL;
            //            echo  $carbon->create($y,$m,$d,$h,$i,$s)->toFullDatetimeString().PHP_EOL;
            return $carbon->create($y, $m, $d, $h, $i, $s);
        }
        if ($y && $m && $d) {
            return $carbon->create($d, $m, $y, $h, $i, $s);
        }
        return $carbon->create(null, null, null, null, null, null);
    }
}

if (!function_exists('check_status')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function check_status($status, $options = [
        'published' => "success", 'draft' => "warning", 'deleted' => "danger"
    ])
    {
        if (isset($options[$status]))
            return $options[$status];


        return "info";
    }
}


if (!function_exists('get_tag_color')) {
    /**
     * Get the configuration path.
     *
     * @param array $options
     * @return string
     */
    function get_tag_color($options = [
        '1' => "success", '2' => "warning", '3' => "danger", '4' => "primary", '5' => "info"
    ])
    {
        $status = rand(1, 5);

        if (isset($options[$status]))
            return $options[$status];


        return "info";
    }
}
