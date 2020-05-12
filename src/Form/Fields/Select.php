<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Form\Fields;


use Carbon\Carbon;
use SIGA\Form\Field;

class Select extends Field
{

    /**
     * @var $selected
     */
    protected $selected;

    /**
     * @var string
     */
    protected $view = 'form.select';


    public function __construct($data = [])
    {
       foreach ($data as $key => $value){

           $this->__set($key, $value);
       }
    }
    /**
     * {@inheritdoc}
     */
    public function render()
    {

        $this->hasOptions();

        $this->hasOption('label',\Str::title($this->name));

        $this->hasOption('label_attributes', []);

        $this->hasOption('value_options', []);

        $this->has('selected');

        return parent::render();
    }

    public function setValue($value)
    {

        $this->with('selected', $value);

        return $this;
    }

    public function getType()
    {
        return 'select';
    }
}
