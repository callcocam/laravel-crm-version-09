<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\LvTable\Traits;


use Illuminate\Support\Facades\Route;

trait RouterTrait
{

protected $keyIgnore = ["index", "store", "create"];

protected $queryParams = [];

protected $endpoint;

    public function getAction($action="index", $params=[]){

        $name = $this->getActions($action, $params);

        if (\Gate::allows($name)) {

            return route($name, $this->queryParams);

        }
        return "";
    }

    public function getActionKey($action="index", $params=[]){

        $keyName = $this->model->getKeyName();

        $keyValue = $this->model->getKey();

        if($keyValue){
            $params= array_merge([$keyName=>$keyValue],$params);
        }

        $name = $this->getActions($action, $params);

        if (\Gate::allows($name)) {

            return route($name, $this->queryParams);

        }
        return "";
    }

    public function getActionNameKey($action="index", $params=[]){

        $keyName = $this->model->getKeyName();

        $keyValue = $this->model->getKey();

        if(!in_array($action, $this->keyIgnore) && $keyValue){
            $params= array_merge([$keyName=>$keyValue],$params);
        }

        $name = $this->getActions($action, $params);

        if (\Gate::allows($name)) {

            return [
                'name'=>$name,
                'parameters'=> $this->queryParams,
                'attributes'=>[
                    'class'=>$this->getClass($action),
                    'icon'=>$this->getIcon($action)
                ]
            ];

        }
        return "";
    }

    public function getActionName($action="index", $params=[]){

        $name = $this->getActions($action, $params);

        if (\Gate::allows($name)) {

            return [
                'name'=>$name,
                'parameters'=> $this->queryParams,
                'attributes'=>[
                    'class'=>$this->getClass($action),
                    'icon'=>$this->getIcon($action)
                ]
            ];

        }
        return "";
    }

    public function getClass($action="index"){

        $default = sprintf( 'lv-table.default_actions.%s.class',$action);

        return config($default);
    }

    public function getIcon($action="index"){

        $default = sprintf( 'lv-table.default_actions.%s.icon',$action);

        return config($default);
    }

    public function getEndpoint(){

        if(empty($this->endpoint)){
            $this->endpoint = $this->model->getTable();
        }

        return $this->endpoint;
    }

    /* public function getCreatedAtAttribute($value)
     {
         return date_carbom_format($value)->toFormattedDateString();
     }
 */
    public function getStatusAttribute($value)
    {
        return view("lv-table::cell.status", compact('value'));
    }

    public function getPriceAttribute($value)
    {
        return number_format($value, 2, ',','.');
    }

    private function getActions($action, $params){

        $endpoint = $this->getEndpoint();

        $this->setParams($params);

        $routeName = sprintf( 'lv-table.default_actions.%s.route',$action);

        $default = sprintf( 'admin.%s.%s', $endpoint,$action);

        $name = config(sprintf( $routeName,$endpoint), $default);

        return sprintf( $name,$endpoint);
    }

    public function setParams($queryParams){

        $this->queryParams = $queryParams;

        return $this;
    }

    public function getParams(){

        return  $this->queryParams;
    }
}
