<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Acl\Repositories;


use SIGA\LvTable\AbstractTable;

class PermissionRepository extends AbstractTable
{

    protected $defaultOptions = [
        'name' => 'Lista de permissions',
        'valuesOfItemPerPage' => [6=>6, 12=>12, 24=>24, 50=>50 , 100=>100],
        'rowAction' => ''
    ];

    /**
     * @var array Definition of headers
     */
    protected $headers = [
        'id' => ['title' => 'Id', 'width' => '50', 'visible' => false],
        'name' => ['title' => 'Name',"sortable" =>true],
        'groups' => ['title' => 'Groups', 'width' => 100,"sortable" =>true],
        'description' => ['title' => 'Description'],
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

    public function initForm()
    {
        // TODO: Implement initForm() method.
    }
}
