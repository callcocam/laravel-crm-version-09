<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\LvTable\Traits;


trait HelperTrait
{

    protected $lastId;

    protected $messages = [];

    protected $redirect = [];

    protected $reload = [];

    protected $results = [
        'result' => false,
        'type' => 'is-danger',
        'errors' => "Falhou, não foi possivel realizar a operação!!",
        'message' => "Falhou, não foi possivel realizar a operação!!",
        'title' => 'Operação:'
    ];

    /**
     * @param array $redirect
     * @return HelperTrait
     */
    public function setRedirect(array $redirect)
    {
        $this->redirect = $redirect;
        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getRedirectKey($key="name")
    {
        return $this->redirect[$key];
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getRedirectAction($key="index")
    {
        return $this->redirect[$key];
    }

    /**
     * @return array
     */
    public function getRedirect(): array
    {
        return $this->redirect;
    }
    /**
     * @param array $reload
     * @return HelperTrait
     */
    public function setReload(array $reload)
    {
        $this->reload = $reload;
        return $this;
    }

    /**
     * @return array
     */
    public function getReload(): array
    {
        return $this->reload;
    }


    protected function setMessages($result, $operation="index"){

        $messageAppend = [];

        if($this->messages){

            if(!isset($this->messages))
                $this->messages[] = $this->messages;

            foreach ($this->messages as $message){

                $messageAppend[] = $message;

            }

            $this->results['logs'] =  $messageAppend;
        }
        $this->results['title'] = config("siga.admin.table.{$operation}.messages.title",'Operação:');

        if($result){
            $this->results['result'] = $result;
            $this->results['type'] = config("siga.admin.table.{$operation}.messages.type.success",'success:');

            $this->setRedirect($this->getActionNameKey($operation));

            $this->setReload([
                'path'=>$this->getActionNameKey($operation),
                'query'=>array_filter($this->getParamAdapter()->getObject()->getArrayCopy())
            ]);

            $this->results['messages'] =  config("siga.admin.table.{$operation}.messages.message.success","Realizada com sucesso, registro foi excluido com sucesso!!");
            return $result;
        }

        $this->results['result'] = $result;
        $this->results['type'] = config("siga.admin.table.{$operation}.messages.type.error",'danger:');
        $this->results['messages'] =  sprintf(config("siga.admin.table.{$operation}.messages.message.error","Falhou, não foi possivel encontrar o registro - %s!!"), $this->getKey());
        return $result;
    }

    /**
     * @return array
     */
    public function getResults()
    {
        return array_merge($this->results, $this->redirect, $this->reload);
    }

    /**
     * @param $key
     * @return bool
     */
    public function getResult($key)
    {
        if (isset($this->results[$key])) {
            return $this->results[$key];
        }
        return false;
    }

    /**
     * @return string
     */
    public function getResultLastId()
    {
        if(is_string($this->lastId)){
            return $this->lastId;
        }
        if($this->lastId){
            return $this->lastId->toString();
        }
        return $this->lastId;
    }


    protected function getRoute($request){

        if($request->has('redirect')){
            return $request->get('redirect');
        }

        if($request->has('save')){
            return 'edit';
        }

        if($request->has('save_close')){
            return 'index';
        }

        if($request->has('save_new')){
            return 'create';
        }

        return 'index';
    }
}
