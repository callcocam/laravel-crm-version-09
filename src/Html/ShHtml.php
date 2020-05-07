<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Html;


use Collective\Html\HtmlBuilder;

class ShHtml extends HtmlBuilder
{


    public function link_to_route_icon($name, $title = '', $parameters = [], $attributes = [], $append = []){

        $url = $this->url->route($name, $parameters);

        if($append){
            return $this->toHtmlString("<a href='{$this->entities($url)}' {$this->attributes($attributes)}><i {$this->attributes($append)} ></i> {$title}</a>");
        }

          return $this->toHtmlString("<a href='{$this->entities($url)}' {$this->attributes($attributes)}> {$title} </a>");

    }
}
