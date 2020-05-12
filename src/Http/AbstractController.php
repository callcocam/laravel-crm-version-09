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
use Illuminate\Support\Facades\Route;
use SIGA\LvTable\Params\AdapterArrayObject;

class AbstractController extends Controller
{

    protected $model;
    protected $repository;
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

        if (\Gate::denies(Route::currentRouteName())){
            abort(401, "You are not authorized!");
            return ;
        }
        $this->results['users'] = Auth::user();
        $this->results['rows'] = [];

        if($this->repository){

            return app($this->repository)
                ->setConfig(config('lv-table', []))
                ->setSource(app($this->model)->query())
                ->setParamAdapter($this->getParamAdapter())->render();

        }

        if(empty( $this->prefix))
            return view(sprintf("admin.%s.%s", $this->template, $this->templateIndex) , $this->results);

        return view(sprintf("%s::admin.%s.%s", $this->template, $this->templateIndex) , $this->results);
    }

    public function create(){

        if (\Gate::denies(Route::currentRouteName())){
            abort(401, "You are not authorized!");
            return ;
        }

        if($this->repository){

            return app($this->repository)
                ->setConfig(config('lv-table', []))
                ->setSource(app($this->model)->query())
                ->setParamAdapter($this->getParamAdapter())->create();

        }

        if(empty( $this->prefix))
            return view(sprintf("admin.%s.%s", $this->template, $this->templateCreate) , $this->results);

        return view(sprintf("%s::admin.%s.%s", $this->template, $this->templateCreate) , $this->results);
    }


    public function edit($id){

        if (\Gate::denies(Route::currentRouteName())){
            abort(401, "You are not authorized!");
            return ;
        }
        if($this->repository){

            return app($this->repository)
                ->setConfig(config('lv-table', []))
                ->setSource(app($this->model)->query()->where('id', $id))
                ->setParamAdapter($this->getParamAdapter())->edit();

        }

        if(empty( $this->prefix))
            return view(sprintf("admin.%s.%s", $this->template, $this->templateEdit) , $this->results);

        return view(sprintf("%s::admin.%s.%s", $this->template, $this->templateEdit) , $this->results);
    }

    public function show ($id){

        if (\Gate::denies(Route::currentRouteName())){
            abort(401, "You are not authorized!");
            return ;
        }
        if($this->repository){

            return app($this->repository)
                ->setConfig(config('lv-table', []))
                ->setSource(app($this->model)->query()->where('id', $id))
                ->setParamAdapter($this->getParamAdapter())->show();

        }

        if(empty( $this->prefix))
            return view(sprintf("admin.%s.%s", $this->template, $this->templateEdit) , $this->results);

        return view(sprintf("%s::admin.%s.%s", $this->template, $this->templateEdit) , $this->results);
    }

    public function destroy ($id){

        if (\Gate::denies(Route::currentRouteName())){
            abort(401, "You are not authorized!");
            return ;
        }
        $rows  = app($this->model)->find($id);

        if(!$rows)
            redirect()->back()->withErrors('Registro não encontrado');

        $rows->delete();

        return redirect()->route($this->getRoute());
    }

    public function updateBy($request, $id){

        if (\Gate::denies(Route::currentRouteName())){
            abort(401, "You are not authorized!");
            return ;
        }

        if(!$this->repository){
            redirect()->back()->withErrors('Registro não encontrado');
        }

        $model = app($this->repository);

        $model->setConfig(config('lv-table', []))
            ->setSource(app($this->model)->query()->where('id', $id))
            ->setParamAdapter($this->getParamAdapter())->update($request, $id);

        if ($request->isJson()){
            return response()->json($model->getResults());
        }

        $route = $model->getRedirectKey('name');

        if(\Route::has($route)){
            return redirect()->route($route, $model->getParams())
                ->with($model->getResult('type'),$model->getResult('message'));
        }

        return back() ->with($model->getResult('type'),$model->getResult('message'));
    }


    public function storeBy($request){

        if (\Gate::denies(Route::currentRouteName())){
            abort(401, "You are not authorized!");
            return ;
        }
        app($this->model)->create($request->input());

        return redirect()->route($this->getRoute());
    }
//
    public function swap($locale){
        // available language in template array
        $availLocale=['en'=>'en', 'fr'=>'fr','de'=>'de','pt'=>'pt'];
        // check for existing language
        if(array_key_exists($locale,$availLocale)){
            session()->put('locale',$locale);
        }
        return redirect()->back();
    }

    protected function getRoute($request){
        if(!empty($this->route))
            return $this->route;

        if($request->has('redirect'))
            return $request->get('redirect');

        if($request->has('save'))
            return 'edit';

        if($request->has('save_close'))
            return 'index';

        if($request->has('save_new'))
            return 'create';

        return sprintf("admin.%s.index", $this->template);
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

