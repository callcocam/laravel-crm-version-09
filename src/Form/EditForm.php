<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Form;

use SIGA\LvTable\AbstractTable;


class EditForm extends Form
{

    protected $template = 'edit-b3';

    public function __construct(AbstractTable $table = null)
    {
        //Create the generic fields for the table
        parent::__construct($table);

        $this->setModel($table->getSource()->getSource()->first());

        $table->setModel($this->model);

        $tableConfig = $table->getOptions();

        $name = $tableConfig->getDefaultColumnName();

        $tableConfig->setName(sprintf("%s - %s", __("Edit"),$this->getModel()->{$name}));

        $this->setAttribute('method', 'PUT');

        $this->setAttribute('url', $table->getActionKey('update'));

        $this->setAttribute('class', 'form');


    }
}
