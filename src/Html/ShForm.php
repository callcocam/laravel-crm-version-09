<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Html;

use Collective\Html\HtmlBuilder;

class ShForm extends HtmlBuilder
{


    public function button_to_icon($value = null, $options = [], $append = [])
    {
        if (! array_key_exists('type', $options)) {
            $options['type'] = 'button';
        }
        if($append){
            return $this->toHtmlString("<button {$this->attributes($options)}><i {$this->attributes($append)} ></i>  {$value}</button>");
        }

    }

    public function submit_to_icon($value = null, $options = [], $append = [])
    {
        $options['type'] = 'submit';

        return $this->button_to_icon($value, $options, $append);
    }

}
