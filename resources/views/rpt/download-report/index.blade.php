@extends('rpt.download-report.layout')

@section('resource-body')
    <h1></h1>
    {{ Form::open(['url' => '/rpt/download-report/download', 'method' => 'post']) }}
        <div class="container report-mainbody" >
            <div class="row" style="background-color:grey;">
                <div class="col">
                    <div class="form-group">
                        {{ Form::label('group', 'Group') }}
                        {{ Form::select('group', $dropDownGroup, null, array('class' => 'form-control', 'onChange'=>'CRO.onGroupChange($(this))')) }}
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        {{ Form::label('report', 'Report') }}
                        {{ Form::select('report', $dropDownReport, null, array('class' => 'form-control')) }}
                    </div>
                </div>
            </div>
        </div>
       
       <div class="container" >
            <h1>Filters</h1>
            <div class="filter">
            </div>
       </div>


        <div class="row">
            <div class="col">
                <div class="form-group">
                    {{ Form::submit('Download', array('class' => 'btn btn-primary')) }}
                </div>
            </div>
            <div class="col"></div>
        </div>
       {{Form::close()}}
    
@endSection