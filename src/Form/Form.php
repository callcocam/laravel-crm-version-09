<?php


namespace SIGA\Form;


class Form
{

    protected $class = [];

    protected $elements = [];

    public function __construct($data=[])
    {

    }

    public function setAttribute($key, $value){

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

        $type = app($data['type'], compact('data'));

      $this->elements[$data['name']] = $type;

      return $this;

    }

    public function get($key){
        if(!isset($this->elements[$key])){
            throw new \InvalidArgumentException(
                "Attribute type e obrigatório"
            );
        }

        $element = $this->elements[$key];

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
}
