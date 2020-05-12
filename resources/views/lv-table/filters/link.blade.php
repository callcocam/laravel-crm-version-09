
@isset($options)
    @isset($options['label'])
        {{ link_to_route_icon($name, $options['label'], $parameters , $attributes, $append) }}
    @else
        {{ link_to_route_icon($name,null, $parameters , $attributes, $append) }}
    @endisset
@else
    {{ link_to_route_icon($name,null, $parameters , $attributes, $append) }}
@endisset
