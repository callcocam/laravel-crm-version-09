@isset($options)
    @isset($options['label'])
        {{ submit_to_icon($options['label'], $attributes, $append) }}
    @else
        {{ submit_to_icon(null, $attributes, $append) }}
    @endisset
@else
    {{ submit_to_icon(null, $attributes, $append) }}
@endisset
