@if($context)
    @foreach($context as $value)
        <span class="float-right badge bg-{{ get_tag_color() }}">{{ $value->name }}</span>
    @endforeach
@endif
