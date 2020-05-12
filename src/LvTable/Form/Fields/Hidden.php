<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\LvTable\Form\Fields;

use SIGA\Form\Fields\Hidden as HiddenAlias;

class Hidden extends HiddenAlias
{

    /**
     * @var string
     */
    protected $view = 'filters.hidden';

    /**
     * Layout for field to render.
     *
     * @var string
     */
    protected $layout = 'lv-table';
}
