
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

    {{ Form::model($mail, ['url' => ['sys/mail', $mail->id]]) }}

        @method('put')
        @include('sys.mail.mail-form')
        {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

@endSection