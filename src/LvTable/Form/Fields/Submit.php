<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\LvTable\Form\Fields;


use Carbon\Carbon;
use SIGA\Form\Field;
use SIGA\Form\Fields\Submit as SubmitAlias;

class Submit extends SubmitAlias
{

    /**
     * @var string
     */
    protected $view = 'filters.submit';
    /**
     * Layout for field to render.
     *
     * @var string
     */
    protected $layout = 'lv-table';
}
