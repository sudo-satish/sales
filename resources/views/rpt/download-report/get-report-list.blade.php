<div class="form-group">
    {{ Form::label('report', 'Report') }}
    {{ Form::select('report', $reportList, null, array('class' => 'form-control')) }}
</div>