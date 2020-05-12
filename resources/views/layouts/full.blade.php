<!DOCTYPE html>
<html lang="@if(session()->has('locale')){{session()->get('locale')}}@else{{"en"}}@endif"
      data-textdirection="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ $tenant->name }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/favicon.ico') }}">
    {{-- Include core + vendor Styles --}}
    @include(get_layout('panels/styles'))
</head>
<body  class="vertical-layout vertical-menu-modern 2-columns navbar-floating menu-expanded footer-static" data-menu="vertical-menu-modern" data-col="2-columns">
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">

            {{-- Include Startkit Content --}}
            @yield('content')

        </div>
    </div>
</div>
<!-- End: Content-->

{{-- include default scripts --}}
@include(get_layout('panels/scripts'))

</body>

</html>
