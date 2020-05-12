@extends(get_layout('layouts.app'))
@section('title', 'Dashboard')
@section('page-style')
    <!-- Page css files -->

@endsection
@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $tenant->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ _('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ $name }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@stop
@section('content')
    <section id="floating-label-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $name }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                           <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <section id="flush-and-horizontal-list-group">
                                            <div class="row match-height">
                                                <div class="md-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Flush</h4>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <ul class="list-group list-group-flush">
                                                                    @if($rows)

                                                                        @foreach($rows as $key => $value)
                                                                            <li class="list-group-item">{{$key}}: {{ $value }}</li>
                                                                        @endforeach

                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="col-12">

                                        <a href="" class="btn btn-outline-warning mr-1 mb-1">{{ __('Back To List') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-script')
    <!-- Page js files -->

@endsection
