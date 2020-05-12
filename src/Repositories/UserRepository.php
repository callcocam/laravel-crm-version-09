<?php


namespace SIGA\Repositories;


use SIGA\LvTable\AbstractTable;

class UserRepository extends AbstractTable
{

    protected $defaultOptions = [
        'name' => 'Lista de tenants',
        'valuesOfItemPerPage' => [6=>6, 12=>12, 24=>24, 50=>50 , 100=>100],
        'ignoreColumns' => ['actions', 'roles']
    ];

    /**
     * @var array Definition of headers
     */
    protected $headers = [
        'id' => ['title' => 'Id', 'width' => '50', 'visible' => false],
        'name' => ['title' => 'Name',"sortable" =>true],
        'email' => ['title' => 'E-Mail'],
        'roles' => ['title' => 'Papel'],
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

        $this->getHeader('roles')->getCell()->addDecorator('callable',  [
            'callable' => function ($context, $record) {
                return view(get_theme_table('cell.roles'),compact('context'));
            }]);
    }
}
