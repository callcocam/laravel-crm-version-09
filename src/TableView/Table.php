<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\TableView;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use SIGA\TableView\Traits\TraitFilters;
use SIGA\TableView\Traits\TraitParams;

class Table
{

    use TraitParams,TraitFilters;
    /**
     * @var Builder
     */
    protected $builder;
    /**
     * @var \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected $data;

    protected $model;
    /**
     * @var \Illuminate\Config\Repository
     */
    protected $config;


    /**
     * Table constructor.
     * @param Builder $builder
     */
    public function __construct(Builder $builder)
    {

        $this->builder = $builder;

        $this->setModel($builder->getModel());

        $this->config = config('laravel-table-builder', []);
    }


    public function paginate(){

        $this->applySearchFilter();

        $page =  (Paginator::resolveCurrentPage() ?: 1);

        $this->data = $this->builder->paginate($this->param('countPerPage', 12), ['*'],'page', $this->param('page', $page));

        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     * @return Table
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @param \Illuminate\Contracts\Pagination\LengthAwarePaginator $data
     * @return Table
     */
    public function setData(\Illuminate\Contracts\Pagination\LengthAwarePaginator $data): Table
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getData(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->data;
    }


    public function html($template){

        return view($template, $this->getData());
    }
}
