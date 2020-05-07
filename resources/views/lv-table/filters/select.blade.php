@if ($show)
    <div class="input-group">
        {!! Form::select($name, $value_options, $selected, $attributes) !!}
    </div>
@endif
