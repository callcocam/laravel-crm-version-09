<?php


namespace SIGA\Acl\Repositories;


use SIGA\Form\Fields\Input;
use SIGA\Form\Fields\Select;
use SIGA\LvTable\AbstractTable;
use SIGA\Form\Fields\Hidden;

class RoleRepository extends AbstractTable
{

    protected $defaultOptions = [
        'name' => 'Lista de roles',
        'valuesOfItemPerPage' => [6=>6, 12=>12, 24=>24, 50=>50 , 100=>100],
        'rowAction' => ''
    ];

    /**
     * @var array Definition of headers
     */
    protected $headers = [
        'id' => ['title' => 'Id', 'width' => '50', 'visible' => false],
        'name' => ['title' => 'Name',"sortable" =>true],
        'description' => ['title' => 'Description'],
        'special' => ['title' => 'special',"sortable" =>true],
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

        $this->form->add([
            'name' => 'id',
            'type' => Hidden::class,
            'show' => true,
            'value'  => 'fddg',
            'attributes' => [
                'class'  => 'hidden',
            ],
        ]);

        $this->form->add([
            'name' => 'name',
            'type' => Input::class,
            'show' => true,
            'attributes' => [
                'class'  => 'form-control',
            ],
        ]);

        $this->form->add([
            'name' => 'special',
            'type' => Select::class,
            'show' => true,
            'options'  =>[
                    'value_options'=>['all-access'=>"All Access", 'no-access'=>"Access"]
            ],
            'attributes' => [
                'class'  => 'form-control mr-2',
                'placeholder'  => '--Select--',
            ],
        ]);

        $this->form->add([
            'name' => 'description',
            'type' => Input::class,
            'show' => true,
            'attributes' => [
                'class'  => 'form-control'
            ],
        ]);
    }
}
