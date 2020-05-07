<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\LvTable\Form\Fields;

use SIGA\Form\Field;

class Hidden extends Field
{

    /**
     * @var string
     */
    protected $view = 'lv-table::filters.hidden';


    public function __construct($data = [])
    {
       foreach ($data as $key => $value){

           $this->__set($key, $value);
       }
    }

    public function getType()
    {
        return 'hidden';
    }
}
