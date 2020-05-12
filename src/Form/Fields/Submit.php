<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Form\Fields;


use Carbon\Carbon;
use SIGA\Form\Field;

class Submit extends Field
{

    protected $append;

    /**
     * @var string
     */
    protected $view = 'form.submit';


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

        $this->with('append', $this->append);

        return parent::render();
    }

    public function getType()
    {
        return 'submit';
    }
}
