@extends('layouts.app')

@section('content')
    
    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('rpt/define-report') }}">Reports</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('rpt/define-report') }}">View All Reports</a></li>
            <li><a href="{{ URL::to('rpt/define-report/create') }}">Create a Report</a>
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
                <td>Active</td>
                <td>Description</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
        @foreach($values as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->code }}</td>
                <td>{{ $value->active }}</td>
                <td>{{ $value->description }}</td>

                <!-- we will also add show, edit, and delete buttons -->
                <td>
                    <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                    <!-- we will add this later since its a little more complicated than the other two buttons -->

                    <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                    <a class="btn btn-small btn-success" href="{{ URL::to('rpt/define-report/' . $value->id) }}">Show this Report</a>

                    <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                    <a class="btn btn-small btn-info" href="{{ URL::to('rpt/define-report/' . $value->id . '/edit') }}">Edit this Report</a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>



@endSection

