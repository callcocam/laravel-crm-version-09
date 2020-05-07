<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Http;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SIGA\LvTable\Params\AdapterArrayObject;

class AbstractController extends Controller
{

    protected $model;
    protected $repository;
    protected $countPerPage = 12;
    protected $results = [];
    protected $prefix;
    protected $route;
    protected $template ='dashboard';
    protected $templateIndex ='index';
    protected $templateCreate ='create';
    protected $templateEdit ='edit';
    protected $templateShow ='show';

    protected $paramAdapter;

    public function index(){

        $this->results['users'] = Auth::user();
        $this->results['rows'] = [];

        if($this->repository){

           return app($this->repository)
                ->setConfig(config('lv-table', []))
                ->setSource(app($this->model)->query())
                ->setParamAdapter($this->getParamAdapter())->render();

        }
    }

    public function create(){

        if(empty( $this->prefix))
            return view(sprintf("admin.%s.%s", $this->template, $this->templateCreate) , $this->results);

        return view(sprintf("%s::admin.%s.%s", $this->template, $this->templateCreate) , $this->results);
    }


    public function edit($id){

        $this->results['rows'] = app($this->model)->find($id);

        if(!$this->results['rows'])
            redirect()->back();

        if(empty( $this->prefix))
            return view(sprintf("admin.%s.%s", $this->template, $this->templateEdit) , $this->results);

        return view(sprintf("%s::admin.%s.%s", $this->template, $this->templateEdit) , $this->results);
    }

    public function show ($id){

        $this->results['rows'] = app($this->model)->find($id);

        if(!$this->results['rows'])
            redirect()->back();

        if(empty( $this->prefix))
            return view(sprintf("admin.%s.%s", $this->template, $this->templateShow) , $this->results);

        return view(sprintf("%s::admin.%s.%s", $this->template, $this->templateShow) , $this->results);
    }

    public function destroy ($id){

        $rows  = app($this->model)->find($id);

        if(!$rows)
            redirect()->back()->withErrors('Registro não encontrado');

        $rows->delete();

        return redirect()->route($this->getRoute());
    }

    public function update(Request $request, $id){

        $rows  = app($this->model)->find($id);

        if(!$rows)
            redirect()->back()->withErrors('Registro não encontrado');

        $rows->fill($request->input());

        $rows->update();

        return redirect()->route($this->getRoute(), $request->query());
    }


    public function store(Request $request){

        app($this->model)->create($request->input());

       return redirect()->route($this->getRoute());
    }

    protected function getRoute(){
        if(empty($this->route))
           return sprintf("admin.%s.index", $this->template);

           return $this->route;
    }

    protected function setParamAdapter(){

        $data = new \ArrayObject(request()->query());

        $this->paramAdapter = new AdapterArrayObject($data);

        return $this;

    }
    protected function getParamAdapter(){

        if(!$this->paramAdapter)
            $this->setParamAdapter();

        return $this->paramAdapter;
    }
}
