<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\TableView\Traits;


trait TraitParams
{
    protected $queryParams;


    public function setParams($queryParams){

        $this->queryParams = $queryParams;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    protected function param($key, $default=null){

        if(isset($this->queryParams[$key])){

            return $this->queryParams[$key];

        }
        return $default;
    }
}
