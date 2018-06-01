
<div class="form-group">
    {{ Form::hidden('id',null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null,array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('code', 'Code') }}
    {{ Form::text('code', null, array('class' => 'form-control')) }}
</div>

<div class="form-check">
    {{ Form::checkbox('custom','Y',null, array('class' => 'form-check-input')) }}
    {{ Form::label('custom', 'Custom') }}
</div>
<div class="form-group">
    {{ Form::label('sql', 'Sql') }}
    {{ Form::textarea('sql',null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('controller', 'Controller') }}
    {{ Form::file('controller',null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('model', 'Model') }}
    {{ Form::file('model',null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('template', 'Template') }}
    {{ Form::file('template',null, array('class' => 'form-control')) }}
</div>

<div class="form-check">
    {{ Form::checkbox('active','Y',null, array('class' => 'form-check-input')) }}
    {{ Form::label('active', 'Active') }}
</div>
<div class="form-group">
    {{ Form::label('row_start_index', 'Start Row Index') }}
    {{ Form::text('row_start_index',null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('output_type', 'Report Type') }}
    {{ Form::select('output_type',['XLSX' => 'XLSX', 'PDF' => 'Pdf'],null, array('class' => 'form-control')) }}
</div>


