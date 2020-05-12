<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Form;


use Illuminate\Support\Traits\Macroable;

abstract class Field
{
    use Macroable;

    protected $options = [];

    protected $data = [];
    /**
     * Element id.
     *
     * @var string
     */
    protected $id;

    /**
     * Element name .
     *
     * @var string
     */
    protected $name ;

    /**
     * Element value.
     *
     * @var mixed
     */
    protected $value;

    /**
     * Field default value.
     *
     * @var mixed
     */
    protected $default;

    /**
     * Element label.
     *
     * @var string
     */
    protected $label = '';

    /**
     * Css required by this field.
     *
     * @var array
     */
    protected static $css = [];

    /**
     * Js required by this field.
     *
     * @var array
     */
    protected static $js = [];

    /**
     * Script for field.
     *
     * @var string
     */
    protected $script = '';

    /**
     * Element attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Layout for field to render.
     *
     * @var string
     */
    protected $layout;

    /**
     * View for field to render.
     *
     * @var string
     */
    protected $view = 'form.default';
    /**
     * @var bool
     */
    protected $multiple = false;

    /**
     * @var bool
     */
    protected $show = false;

    public function with($key, $value){

        $this->data[$key] = $value;

        return $this;
    }

    public function getAttributes(){

        $this->hasAttribute('placeholder', \Str::title($this->name));

        $this->hasAttribute('id', $this->name);

        return $this->attributes;

    }
    public function getOptions(){



        return $this->options;

    }
    /**
     * {@inheritdoc}
     */
    public function render()
    {


        $this->with('id' , $this->id)
            ->with('attributes', $this->getAttributes())
            ->with('options', $this->getOptions())
            ->with('show' , $this->show)
            ->with('type' , $this->getType())
            ->with('name', $this->name);

            $this->has('value');

            return view(get_layout($this->view, $this->layout), $this->data);
    }

    abstract public function getType();


    public function setValue($value){

        $this->with('value' , $value);

        return $this;
    }

    public function hasAttribute($key, $setAttribute = null){

        if(!isset($this->attributes[$key])){
            if($setAttribute){

                $this->attributes[$key]  = $setAttribute;

                return true;
            }
        }

        return false;
    }

    public function hasOption($key, $setOption = null){

        if(!isset($this->options[$key])){
            if($setOption){

                $this->options[$key]  = $setOption;

                return true;
            }
        }

        return false;
    }


    public function hasOptions($setOption =null){

        if(!$this->options){
            if($setOption){

                $this->options  = $setOption;

                return true;
            }
        }
        return false;
    }

    public function has($name){

        if(!isset($this->data[$name])){
            $this->data[$name] = $this->__get($name);
        }
        return false;
    }

    public function __set($name, $value)
    {
       $this->{$name} = $value;
    }

    public function __get($name)
    {
        return $this->{$name};
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

}
