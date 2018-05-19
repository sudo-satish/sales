@extends('layouts.app')

@section('content')
<div class="container">

    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('sys/global-value') }}">Global Values</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('sys/global-value') }}">View All Global Values</a></li>
            <li><a href="{{ URL::to('sys/global-value/create') }}">Create a Global Value</a>
        </ul>
    </nav>

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
            <td>{{ $value->email }}</td>
            <td>{{ $value->code }}</td>
            <td>{{ $value->value }}</td>
            <td>{{ $value->description }}</td>
            <td>{{ $value->from_date }}</td>
            <td>{{ $value->to_date }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('sys/global-value/' . $value->id) }}">Show this Value</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('sys/global-value/' . $value->id . '/edit') }}">Edit this Value</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
@endsection
