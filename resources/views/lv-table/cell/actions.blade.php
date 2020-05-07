@if($actions)
    @foreach($actions as $action)
        @include(sprintf("lv-table::cell.actions.%s", $action['view']), $action)
    @endforeach
@endif
