<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Form;

use SIGA\LvTable\AbstractTable;


class CreateForm extends Form
{
    protected $table;

    protected $template = 'create-b3';


    public function __construct(AbstractTable $table = null)
    {
        //Create the generic fields for the table
        parent::__construct($table);

        $tableConfig = $table->getOptions();

        $tableConfig->setName("Create");

        $this->setAttribute('method', 'post');

        $this->setAttribute('url', $table->getAction('store'));

    }
}
