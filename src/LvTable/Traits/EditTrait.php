<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\LvTable\Traits;

use Illuminate\Database\Eloquent\Model;
use SIGA\Form\EditForm;

trait EditTrait
{

    abstract public function initForm();

    public function edit(){

        if (!$this->isTableInit()) {
            $this->initializable();
        }



        $this->setForm(new EditForm($this));

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


    public function update($request, $id){

        if (!$this->isTableInit()) {
            $this->initializable();
        }

        return $this->finallyUpdateBy($request,$id);
    }


    protected function finallyUpdateBy($request,$id){

        $data = $request->input();

        /**
         * @var $model Model
         */
        $this->setModel($this->getSource()->getSource()->first());

        if(!$this->model):
            return $this->setMessages(false,'edit');
        endif;

        unset($request['created_at']);

        $this->model->fill($data);

        if(!$this->model->save()):
            return $this->setMessages(false,$this->getRoute($request));
        endif;

        $input = array_merge($data, $this->model->toArray());
        $this->lastId =  $id;
        $this->results['data'] =  $input;
        $this->results['id'] =  $id;
        return $this->setMessages(true,$this->getRoute($request));
    }
}
