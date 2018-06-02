@extends('rpt.define-report.layout')

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

        <!-- if there are creation errors, they will show here -->

        {{ Form::model($report, ['url' => ['rpt/define-report', $report->id], 'files' => true]) }}
            
            @method('put');
            @include('rpt.define-report.define-report-form')
        {{ Form::submit('Update a report', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

@endsection
