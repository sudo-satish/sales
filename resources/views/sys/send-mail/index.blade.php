
@extends('sys.send-mail.layout')

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
            </tr>
        </thead>
        <tbody>
            @foreach($values as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                
                    <td>
                        <a class="btn btn-small btn-success" href="{{ URL::to('sys/send-mail/' . $value->id) }}">Show</a>
                        <a class="btn btn-small btn-info" href="{{ URL::to('sys/send-mail/' . $value->id . '/edit') }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endSection

