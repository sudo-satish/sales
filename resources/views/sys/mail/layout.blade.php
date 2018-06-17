
@extends('layouts.app')

<!-- <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/inline/ckeditor.js"></script> -->
<script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/balloon/ckeditor.js"></script> -->

@section('content')
<div class="container">

    <div class="row justify-content-between">
        <div class="col-4">
            <a class="navbar-brand" href="{{ URL::to('sys/mail') }}">sys/mail</a>
        </div>
        <div class="col-4 ">
            <a class="btn btn-info" href="{{ URL::to('sys/mail') }}">View All sys/mail</a>
            <a class="btn btn-info" href="{{ URL::to('sys/mail/create') }}">Create a sys/mail</a>
        </div>
    </div>
    
    @yield('resource-body')
</div>

<script>
    resourceName = 'mail';
    moduleName = 'sys';
    
</script>

@if(config('app.debug'))
<script src="{{ asset('js/resources/mail.js') }}" defer></script>
@endif
@endsection
