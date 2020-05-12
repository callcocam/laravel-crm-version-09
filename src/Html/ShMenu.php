<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace SIGA\Html;


use Collective\Html\HtmlBuilder;

class ShMenu extends HtmlBuilder
{

    public function xy_menu($menu){

        $active= "";

        $route= "";

        if(!empty($menu->url)){
            if(\Route::has($menu->url)){
                $active = request()->routeIs($menu->url) ? 'active' : '' ;
                $route = route($menu->url);
                if (\Gate::denies($menu->url)){
                    return "";
                }
            }

        }
        $custom_classes = "";
        if(isset($menu->classlist)) {
            $custom_classes = $menu->classlist;
        }

        $icon = $this->icon($menu);
        $text = $this->text($menu);
        $badge = $this->badge($menu);
        $submenus = $this->xy_submenu($menu);
        if(isset($menu->submenu)){
            if(!$submenus){
                return "";
            }
        }

        return $this->toHtmlString("<li class='nav-item {$active} {$custom_classes}'>
                <a href='{$route}'>
                    {$icon}
                    {$text}
                    {$badge}
                </a>
                    {$submenus}
        </li>");


    }


    public function xy_submenu($menu){

        if(!isset($menu->submenu))
            return "";
        $menus = [];
        foreach($menu->submenu as $submenu):
            $route= "";
            if(!empty($submenu->url)){
                if(\Route::has($submenu->url)){
                    $route = route($submenu->url);
                    $active = request()->routeIs($submenu->url) ? 'active' : '' ;
                }
            }
            if($route && \Gate::allows($route)):
                $icon = $this->icon($submenu);
                $text = $this->text($submenu);
                $badge = $this->badge($submenu);
                $link = $this->toHtmlString("<a href='{$route}'>
                    {$icon}
                    {$text}
                    {$badge}
                </a>");
                $submenus = $this->xy_submenu($submenu);
                $menus[] = $this->toHtmlString("<li class='{$active}'>{$link}{$submenus}</li>");
            endif;
        endforeach;
        if($menus){
            $submenus = implode(PHP_EOL, $menus);
            return $this->toHtmlString("<ul class='menu-content'>{$submenus}</ul>");
        }
        return "";

    }

    protected function icon($menu){

        if(!isset($menu->icon))
            return "";

        return $this->toHtmlString("<i class='{$menu->icon}'></i>");
    }

    protected function badge($menu){

        if (isset($menu->badge)){
            $badgeClasses = "badge badge-pill badge-primary float-right notTest";

            if (isset($menu->badgeClass)){
                $badgeClasses = sprintf("%s test", $menu->badgeClass);
            }
            return $this->toHtmlString("<span class='{$badgeClasses}'>{$menu->badge}</span>");
        }
        return "";
    }

    protected function text($menu){
        $translation = "";
        if(isset($menu->i18n)){
            $translation = $menu->i18n;
        }

        $label = __($menu->name);

        return $this->toHtmlString("<span class='menu-title' data-i18n='{$translation}'>{$label}</span>");
    }
}
