<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\TableView\Traits;


trait TraitFilters
{
    private $searchFields = [];

    private function applySearchFilter()
    {
        if (count($this->searchableFields()) && ! empty($this->searchQuery())) {

            if ($this->builder) {
                $keyword = strtolower($this->searchQuery());

                $this->builder->where(function ($query) use ($keyword) {
                    foreach ($this->searchableFields() as $field) {
                        $query->orWhere($field, 'LIKE', "%$keyword%");
                    }
                });
            }
        }
    }

    public function setSearchableFields($fields = [])
    {
        $this->searchFields = $fields;

        return $this;
    }

    public function searchableFields()
    {
        return $this->searchFields;
    }

    public function searchQuery()
    {
        return $this->param('search','');
    }
}
