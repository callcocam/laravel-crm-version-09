<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\LvTable\Traits;


use SIGA\Form\CreateForm;

trait CreateTrait
{

    abstract public function initForm();

    public function create(){

        if (!$this->isTableInit()) {
            $this->initializable();
        }

        $this->defaultOptions->setName("Create");

        $this->setForm(new CreateForm($this));

        $this->form->setButton('save');

        $this->form->setButton('save_new',[
            'attributes'=>[
                'class'=>'btn btn-warning mr-1 mb-1'
            ]
        ]);

        $this->form->setButton('save_close',[
            'attributes'=>[
                'class'=>'btn btn-secondary mr-1 mb-1'
            ]
        ]);

        $this->initForm();

        return $this->getForm()->render();
    }



    public function store(){

        if (!$this->isTableInit()) {
            $this->initializable();
        }


        return ;
    }
}
