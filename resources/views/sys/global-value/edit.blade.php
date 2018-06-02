@extends('sys.global-value.layout')

@section('resource-body')

    <h1>Edit a Global Values</h1>

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <!-- if there are creation errors, they will show here -->
    {{ Html::ul($errors->all()) }}

    {{ Form::model($globalValue, ['url' => ['sys/global-value', $globalValue->id]]) }}

        @method('put')

        @include('sys.global-value.global-value-form')    
        {{ Form::submit('Update the Global Value', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

@endsection
