<?php


namespace SIGA\Repositories;


use SIGA\LvTable\AbstractTable;

class TenantRepository extends AbstractTable
{

    protected $defaultOptions = [
        'name' => 'Lista de tenants',
        'valuesOfItemPerPage' => [6=>6, 12=>12, 24=>24, 50=>50 , 100=>100],
        'rowAction' => ''
    ];

    /**
     * @var array Definition of headers
     */
    protected $headers = [
        'id' => ['title' => 'Id', 'width' => '50', 'visible' => false],
        'name' => ['title' => 'Name',"sortable" =>true],
        'domain' => ['title' => 'domain'],
        'status' => ['title' => 'Active' , 'width' => 100],
        'created_at' => ['title' => 'Created At' , 'width' => 100],
        'actions' => ['title' => '#' , 'width' => 100],
    ];

    public function init()
    {
        $params = $this->getParamAdapter()->getObject()->getArrayCopy();
        $this->getHeader('actions')->getCell()->addDecorator('actions', [
            'params' => $params
        ]);
    }
}
