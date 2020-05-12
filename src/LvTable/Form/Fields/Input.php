<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\LvTable\Form\Fields;


use Carbon\Carbon;
use SIGA\Form\Field;
use SIGA\Form\Fields\Input as InputAlias;

class Input extends InputAlias
{

    /**
     * @var string
     */
    protected $view = 'filters.input';
    /**
     * Layout for field to render.
     *
     * @var string
     */
    protected $layout = 'lv-table';
}
