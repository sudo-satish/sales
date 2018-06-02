@extends('sys.global-value.layout')

@section('resource-body')

    <h1>Create a Global Values</h1>

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ Html::ul($errors->all()) }}
        </div>
    @endif

    <!-- if there are creation errors, they will show here -->


    {{ Form::open(array('url' => 'sys/global-value','method' => 'post')) }}
        @include('sys.global-value.global-value-form')    
    {{ Form::submit('Create the Global Value', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

@endsection