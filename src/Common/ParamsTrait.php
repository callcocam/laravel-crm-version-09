<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Common;


trait ParamsTrait
{
    protected $queryParams = [
        'search'=>'',
        'status'=>'all',
        'number'=>'',
        'countPerPage'=>'12',
        'date'=>'',
        'year'=>'',
        'month'=>'',
        'day'=>'',
        'start'=>'',
        'end'=>'',
        'order'=>'DESC',
        'column'=>'id',
        'page'=>'1',
    ];


    public function setParams($params){

        $this->queryParams = array_merge($this->queryParams, $params);

        return $this;
    }
    /**
     * @param $key
     * @param null $default
     * @return |null
     */
    protected function params($key, $default=null){

        if(isset($this->queryParams[$key]))
            return $this->queryParams[$key];

        return $default;
    }

    /**
     * @return array
     */
    protected function paramsAll(){

        return $this->queryParams;
    }
}
