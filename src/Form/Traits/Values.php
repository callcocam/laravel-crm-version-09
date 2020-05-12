<?php


namespace SIGA\Form\Traits;


trait Values
{

    public function setValues($values){

        if($values){

            foreach ($values->getAttributes() as $name => $value){

                if($this->ha($name)){

                    $this->get($name)->setValue($value);
                }
            }

        }

    }
}
