<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Form\Fields;


use Carbon\Carbon;
use SIGA\Form\Field;

class Input extends Field
{

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

    public function render()
    {
        $this->hasOptions();

        $this->hasOption('label',\Str::title($this->name));

        $this->hasOption('label_attributes', []);

        $this->hasOption('value_options', []);

        return parent::render();

    }

    public function getType()
    {
        return 'text';
    }

}
