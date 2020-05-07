<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Gate;
use SIGA\Tenant\BelongsToTenants;

trait TableTrait
{

    use SoftDeletes, BelongsToTenants;

    protected $queryParams = [];
    protected $tableView;
    protected $source;
    protected $endpoint;

    /**
     * @return mixed
     */
    public function getSource()
    {
        if($this->source)
         return $this->source;

        $this->source = $this->query();

        return $this->source;
    }

    public function setParams($queryParams){

        $this->queryParams = $queryParams;

        return $this;
    }

    public function getAction($action="index", $params=[]){

        $endpoint = $this->getEndpoint();

        $keyName = $this->getKeyName();

        $keyValue = $this->getKey();

        if($keyValue){
            $params = array_merge([$keyName=>$keyValue],$params);
        }

        $routeName = sprintf( 'lv-table.default_actions.%s.route',$action);

        $default = sprintf( 'admin.%s.%s', $endpoint,$action);

        $name = config(sprintf( $routeName,$endpoint), $default);

        //if (Gate::allows(sprintf( $name,$endpoint))) {

            return route(sprintf( $name,$endpoint), $params);

       // }
       return "";
    }

    public function getActionName($action="index", $params=[]){

        $endpoint = $this->getEndpoint();

        $keyName = $this->getKeyName();

        $keyValue = $this->getKey();

        if($keyValue){
            $params = array_merge([$keyName=>$keyValue],$params);
        }

        $routeName = sprintf( 'lv-table.default_actions.%s.route',$action);

        $default = sprintf( 'admin.%s.%s', $endpoint,$action);

        $name = config(sprintf( $routeName,$endpoint), $default);

        //if (Gate::allows(sprintf( $name,$endpoint))) {

            return [
                'name'=>sprintf( $name,$endpoint),
                'parameters'=> $params,
            ];

       // }
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
          $this->endpoint = $this->getTable();
      }

      return $this->endpoint;
    }

}
