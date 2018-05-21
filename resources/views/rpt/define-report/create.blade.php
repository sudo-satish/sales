@extends('layouts.app')

@section('content')
    <div class="container"> 
        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ URL::to('rpt/define-report') }}">Reports</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="{{ URL::to('rpt/define-report') }}">View All Reports</a></li>
                <li><a href="{{ URL::to('rpt/define-report/create') }}">Create a Report</a>
            </ul>
        </nav>

        <h1>Define a report</h1>

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

        {{ Form::open(array('url' => 'rpt/define-report', 'method' => 'post','files' => true)) }}
            @include('rpt.define-report.define-report-form')    
        {{ Form::submit('Create a report', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div>
@endsection
