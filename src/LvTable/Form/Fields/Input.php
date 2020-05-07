<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\LvTable\Form\Fields;


use Carbon\Carbon;
use SIGA\Form\Field;

class Input extends Field
{

    protected $options = [];

    /**
     * @var string
     */
    protected $view = 'lv-table::filters.input';


    public function __construct($data = [])
    {
       foreach ($data as $key => $value){

           $this->__set($key, $value);
       }
    }

    public function getType()
    {
        return 'text';
    }

}
