@extends('layouts.app')

@section('content')
<div class="container">

    <!-- <nav class="navbar navbar-inverse"> -->
        <!-- <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('sys/global-value') }}">Global Values</a>
        </div> -->

        
        <!-- <ul class="nav navbar-nav">
            <li><button class="btn btn-primary" href="{{ URL::to('sys/global-value') }}"> <i class="material-icons">list </i>View All Global Values</button></li>
            <li><button class="btn btn-primary" href="{{ URL::to('sys/global-value/create') }}"> <i class="material-icons">list </i> Create a Global Value</button></li>
        </ul> -->
    <!-- </nav> -->
    <div class="row justify-content-between">
        <div class="col-4">
            <a class="navbar-brand" href="{{ URL::to('sys/global-value') }}">Global Values</a>
        </div>
        <div class="col-4 ">
            <a class="btn btn-info" href="{{ URL::to('sys/global-value') }}">View All Global Values</a>
            <a class="btn btn-info" href="{{ URL::to('sys/global-value/create') }}">Create a Global Value</a>
        </div>
    </div>
    
    @yield('resource-body')
</div>
@endsection