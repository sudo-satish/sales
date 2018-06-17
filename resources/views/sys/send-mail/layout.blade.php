
@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-between">
        <div class="col-4">
            <a class="navbar-brand" href="{{ URL::to('sys/send-mail') }}">sys/send-mail</a>
        </div>
        <div class="col-4 ">
            <a class="btn btn-info" href="{{ URL::to('sys/send-mail') }}">View All sys/send-mail</a>
            <a class="btn btn-info" href="{{ URL::to('sys/send-mail/create') }}">Create a sys/send-mail</a>
        </div>
    </div>
    
    @yield('resource-body')
</div>

<script>
    resourceName = 'sendMail';
    moduleName = 'sys';
</script>

@if(config('app.debug'))
<script src="{{ asset('js/resources/send-mail.js') }}" defer></script>
@endif

@endsection
