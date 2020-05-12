<div class="card-tools">
    <form class="form-inline" id="lv-table-form">
        <span class="btn btn-default">
            <i class="fa fa-filter fa-2x"></i>
        </span>
        @if($form->getElements())
            @foreach($form->getElements() as $filter)
                {!! $filter->render() !!}
            @endforeach
        @endif
    </form>
</div>
