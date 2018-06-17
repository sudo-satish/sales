@extends('sys.global-value.layout')

@section('resource-body')

<h1>All the Global Values</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Code</td>
            <td>Value</td>
            <td>Description</td>
            <td>From Date</td>
            <td>To Date</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($globalValues as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->code }}</td>
            <td>{{ $value->value }}</td>
            <td>{{ $value->description }}</td>
            <td>{{ $value->from_date }}</td>
            <td>{{ $value->to_date }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>
                <a class="btn btn-small btn-success" href="{{ URL::to('sys/global-value/' . $value->id) }}">Show this Value</a>
                <a class="btn btn-small btn-info" href="{{ URL::to('sys/global-value/' . $value->id . '/edit') }}">Edit this Value</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection
