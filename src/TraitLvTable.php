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

        $model = $this->getSource()->getModel();

        $params = $this->getParamAdapter()->getObject()->getArrayCopy();

        $this->defaultOptions->setOption('endpointList', $model->getAction('index', $params));

        $this->defaultOptions->setOption('endpointCreate', $model->getAction('create', $params));

        $this->defaultOptions->setOption('endpointReload', $model->getAction('index'));
    }
}
