@if ($show)
    <div class="input-group">
        {!! Form::select($name, $options['value_options'], $selected, $attributes) !!}
    </div>
@endif
