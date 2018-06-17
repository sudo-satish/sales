
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

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>Id</td>
                <td>Template Name</td>
                <td>Code</td>
                <td>To</td>
                <td>CC</td>
                <td>BCC</td>
                <td>Active</td>
            </tr>
        </thead>
        <tbody>
            @foreach($values as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->template_name }}</td>
                    <td>{{ $value->code }}</td>
                    <td>{{ $value->to }}</td>
                    <td>{{ $value->cc }}</td>
                    <td>{{ $value->bcc }}</td>
                    <td>{{ $value->active }}</td>
                    <td>
                        <a class="btn btn-small btn-success" href="{{ URL::to('sys/mail/' . $value->id) }}">Show</a>
                        <a class="btn btn-small btn-info" href="{{ URL::to('sys/mail/' . $value->id . '/edit') }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endSection

