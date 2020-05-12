<div class="input-group mr-2">
    @if ($show)
        <div class="input-group">
            <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
            </div>
            {!! Form::text(null, $template, $attributes) !!}
            @if($elements)
                @foreach($elements as $element)
                    {!! $element->render() !!}
                @endforeach
            @endif
        </div>
    @endif
</div>
@section('adminlte_js')
    <script>
        //'#reportrange span'
        {!! $script !!}

    </script>
@stop
@section('page-script-range')
    <script>
        //'#reportrange span'
        {!! $script !!}

    </script>
@stop
