<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Form;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use SIGA\Form\Traits\Values;
use SIGA\Form\Fields\Submit;

class Form
{

    use Values;

    protected $table;

    protected $template = "create-03";

    protected $model;

    protected $class = [];

    protected $options = [];

    protected $elements = [];

    protected $attributes = [];

    protected $buttons = [];

    public function __construct($table)
    {

        $this->table = $table;
    }

    public function add($data =[]){
        if(!isset($data['type'])){
            throw new \InvalidArgumentException(
                "Attribute type e obrigatório"
            );
        }
        if(!class_exists($data['type'])){
            throw new \InvalidArgumentException(
                "Class type {$data['type']} não existe"
            );
        }

        if(!isset($data['name'])){
            $data['name'] = class_basename($data['type']);
        }

        if(!isset($data['options'])){

            $data['options'] = $this->getOptions();

        }

        $type = app($data['type'], compact('data'));

        $this->elements[$data['name']] = $type;

        return $this;

    }

    public function get($key, $unset = false){
        if(!isset($this->elements[$key])){
            throw new \InvalidArgumentException(
                "Attribute type e obrigatório"
            );
        }

        $element = $this->elements[$key];

        if($unset)
         unset($this->elements[$key]);

        return $element;

    }

    /**
     * @param array $class
     * @return Form
     */
    public function setClass(array $class): Form
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return array
     */
    public function getClass(): array
    {
        return $this->class;
    }

    /**
     * @param array $elements
     * @return Form
     */
    public function setElements(array $elements): Form
    {
        $this->elements = $elements;
        return $this;
    }

    /**
     * @return array
     */
    public function getElements(): array
    {
        return $this->elements;
    }


    public function render()
    {

        $this->setValues($this->getModel());

        $tableConfig = $this->table->getOptions();

        return $this->table->getRender()->getRenderer()->make(get_theme_table($this->template))
            ->with('form', $this)
            ->with('actions', $this->getButtons())
            ->with('name', $tableConfig->getName())
            ->with('options', $tableConfig->getOptions())->render();
    }

    public function setButton($key, $action =[]){

        $attributes = [];
        if(isset($action['attributes']))
            $attributes = $action['attributes'];

        $attributes = array_merge([
            'name' => $key,
            'title'  => Str::camel($key),
            'class'  => 'btn btn-primary mr-1 mb-1'
        ],$attributes);

        $options = [];
        if(isset($action['options']))
            $options = $action['options'];

        $options = array_merge([
            'label' => Str::camel($key),
        ],$options);

        $appends = [];
        if(isset($action['append']))
            $appends = $action['append'];

        $appends = array_merge([
            'class'  => 'fa fa-save'
        ],$appends);

        $this->buttons[$key] = [
            'name' => $key,
            'type'=> isset($action['type'])? $action['type'] : Submit::class,
            'options' => $options,
            'append' => $appends,
            'attributes' =>$attributes
        ];

        return $this;
    }

    public function setButtons($actions){

        foreach ($actions as $key => $action){

            $this->setButton($key, $action);

        }
        return $this;
    }

    public function getButtons(){
        return $this->buttons;
    }

    public function getButton($data){

        if(!isset($data['type'])){
            throw new \InvalidArgumentException(
                "Attribute type e obrigatório"
            );
        }
        if(!class_exists($data['type'])){
            throw new \InvalidArgumentException(
                "Class type {$data['type']} não existe"
            );
        }

        if(!isset($data['name'])){
            $data['name'] = class_basename($data['type']);
        }
        $type = app($data['type'], compact('data'));

        return $type;
    }

    public function setOption($key, $option){
        $this->options[$key] = $option;
        return $this;
    }

    public function setOptions($options){

        foreach ($options as $key => $option){

            $this->setOption($key, $option);

        }
        return $this;
    }

    public function getOptions(){
        return $this->options;
    }

    /**
     * @param Model $model
     * @return Form
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return Model
     */
    public function getBack()
    {
        return $this->table->getAction('index');
    }

    public function setAttribute($key, $value){

        $this->attributes[$key] = $value;

        return $this;
    }

    public function setAttributes($attributes){

        foreach ($attributes as $key => $attribute){

            $this->setAttribute($key, $attribute);

        }

        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param string $template
     * @return Form
     */
    public function setTemplate(string $template): Form
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    public function ha($key){

        return isset($this->elements[$key]);
    }

    public function remove($key){

        if($this->ha($key))
            unset($this->elements[$key]);

        return $this;
    }

}
