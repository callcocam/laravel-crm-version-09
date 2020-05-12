<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\LvTable\Form\Fields;


use Carbon\Carbon;
use SIGA\Form\Field;
use SIGA\Form\Fields\Link as LinkAlias;

class Link extends LinkAlias
{


    /**
     * @var string
     */
    protected $view = 'filters.link';
    /**
     * Layout for field to render.
     *
     * @var string
     */
    protected $layout = 'lv-table';
}
