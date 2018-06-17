
@extends('sys.mail.layout')

@section('resource-body')
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ Html::ul($errors->all()) }}
        </div>
    @endif

    {{ Form::open(array('url' => 'sys/mail', 'method' => 'post', 'file'=> true)) }}
        @include('sys.mail.mail-form')
    {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

    
@endSection

