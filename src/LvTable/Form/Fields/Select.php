<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\LvTable\Form\Fields;


use Carbon\Carbon;
use SIGA\Form\Field;

class Select extends Field
{

    /**
     * @var array $value_options
     */
    protected $value_options = [];

    /**
     * @var $selected
     */
    protected $selected;

    /**
     * @var string
     */
    protected $view = 'lv-table::filters.select';


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

      $this->with('value_options' , $this->value_options)
            ->with('selected', $this->selected);

        return parent::render();
    }

    public function getType()
    {
        return 'select';
    }
}
