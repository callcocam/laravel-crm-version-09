<div class="card-tools">
    <form class="form-inline" id="lv-table-form">
        <span class="btn btn-default mr-2">
            <i class="fas fa-filter"></i>
        </span>
        @if($form->getElements())
            @foreach($form->getElements() as $filter)
                {!! $filter->render() !!}
            @endforeach
        @endif
    </form>
</div>
