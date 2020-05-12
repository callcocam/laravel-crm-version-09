<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Form\Fields;


use Carbon\Carbon;
use SIGA\Form\Field;

class Children extends Field
{

    protected $options = [];

    /**
     * @var string
     */
    protected $view = 'form.input';


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
