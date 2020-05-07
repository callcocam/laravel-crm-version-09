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
     * View for field to render.
     *
     * @var string
     */
    protected $view = 'lv-table::lv-table.filters.default';

    /**
     * @var bool
     */
    protected $multiple = false;

    /**
     * @var bool
     */
    protected $show = false;

    public function with($key, $value){

        $this->options[$key] = $value;

        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $this->with('id' , $this->id)
            ->with('attributes', $this->attributes)
            ->with('label', $this->label)
            ->with('show' , $this->show)
            ->with('value' , $this->value)
            ->with('type' , $this->getType())
            ->with('name', $this->name);

        return view($this->view, $this->options);
    }

    abstract public function getType();

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
