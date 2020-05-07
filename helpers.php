<?php

if (!function_exists('siga_path')){

    function siga_path($path=""){

        return sprintf("%s/%s",__DIR__, $path);
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
        $carbon->locale('pt');
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
