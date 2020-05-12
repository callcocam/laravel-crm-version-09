<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\LvTable\Form\Fields;


use Carbon\Carbon;
use SIGA\Form\Field;
use SIGA\Form\Fields\DateRangePicker as DateRangePickerAlias;

class DateRangePicker extends DateRangePickerAlias
{
  /**
     * @var string
     */
    protected $view = 'filters.range';
    /**
     * Layout for field to render.
     *
     * @var string
     */
    protected $layout = 'lv-table';
}
