@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-4">
            <a class="navbar-brand" href="{{ URL::to('rpt/download-report') }}">Reports</a>
        </div>
        <!-- <div class="col-4 ">
            <a class="btn btn-info" href="{{ URL::to('rpt/define-report') }}">View All reports</a>
            <a class="btn btn-info" href="{{ URL::to('rpt/define-report/create') }}">Create a report</a>
        </div> -->
    </div>
    
    @yield('resource-body')

</div>


<script>
    resourceName = 'downloadReport';
    moduleName = 'rpt';
</script>

@if(config('app.debug'))
<script src="{{ asset('js/resources/download-report.js') }}" defer></script>
@endif
@endsection