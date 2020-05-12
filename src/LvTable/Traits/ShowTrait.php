<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\LvTable\Traits;

use Illuminate\Database\Eloquent\Model;
use SIGA\Form\EditForm;

trait ShowTrait
{

    public function show(){

        if (!$this->isTableInit()) {
            $this->initializable();
        }
        /**
         * @var $model Model
         */
        $this->setModel($this->getSource()->getSource()->first());

        if(!$this->model):
            return $this->setMessages(false,'index');

        endif;

        return $this->getRender()->renderCustom("show");
    }


}
