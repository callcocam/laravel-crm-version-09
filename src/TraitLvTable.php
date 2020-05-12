<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA;

trait TraitLvTable
{

    public function initConfig()
    {

        $this->setModel($this->getSource()->getModel()) ;

        $params = $this->getParamAdapter()->getObject()->getArrayCopy();

        $this->defaultOptions->setOption('endpointList', $this->getAction('index', $params));

        $this->defaultOptions->setOption('endpointCreate', $this->getAction('create', $params));

        $this->defaultOptions->setOption('endpointReload', $this->getAction('index'));
    }
}
