<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Form\Fields;


use Carbon\Carbon;
use SIGA\Form\Field;

class Link extends Field
{


    protected $parameters  = [];

    protected $append  = [];

    /**
     * @var string
     */
    protected $view = 'form.link';


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

         $this->with('append', $this->append)
            ->with('parameters', $this->parameters);

         return parent::render();
    }

    public function getType()
    {
        return 'link';
    }
}
