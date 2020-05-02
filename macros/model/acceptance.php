<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
use Illuminate\Database\Eloquent\Builder;

Builder::macro('status', function($status, $key = 'status') {
    return $this->where($key, $status);
});
