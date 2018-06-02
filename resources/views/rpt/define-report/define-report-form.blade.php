
<div class="form-group">
    {{ Form::hidden('id',null, array('class' => 'form-control')) }}
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            {{ Form::label('group', 'Group') }}
            {{ Form::text('group', null,array('class' => 'form-control')) }}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null,array('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            {{ Form::label('code', 'Code') }}
            {{ Form::text('code', null, array('class' => 'form-control')) }}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {{ Form::label('row_start_index', 'Start Row Index') }}
            {{ Form::text('row_start_index',null, array('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="row">
    
    <div class="col">
        <div class="form-group">
            {{ Form::label('output_type', 'Report Type') }}
            {{ Form::select('output_type',['XLSX' => 'XLSX', 'PDF' => 'Pdf'],null, array('class' => 'form-control')) }}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {{ Form::label('template', 'Template') }}
            {{ Form::file('template', array('class' => 'form-control')) }}
            @if(isset($report))
                <!-- {{ app_path().$report->controller }} -->
                
                <a href={{ app_path().substr($report->template, 4) }} download> <i class="material-icons"> attach_file </i> {{ basename($report->template) }} </a>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-check">
            {{ Form::checkbox('custom','Y', null,array('class' => 'form-check-input', 'onChange' => 'CRO.toggleCustom($(this))')) }}
            {{ Form::label('custom', 'Custom', array('class'=>'"form-check-label"')) }}
        </div>
        <div class="form-check">
            {{ Form::checkbox('debug','Y', null, array('class' => 'form-check-input')) }}
            {{ Form::label('debug', 'Debug', array('class'=>'"form-check-label"')) }}
        </div>
    </div>
    <div class="col">
        <div class="form-check">
            {{ Form::checkbox('active','Y', null, array('class' => 'form-check-input')) }}
            {{ Form::label('active', 'Active') }}
        </div>
    </div>
</div>

<div class="row custom-class-file">
    <div class="col">
        <div class="form-group">
            {{ Form::label('controller', 'Controller') }}
            {{ Form::file('controller', array('class' => 'form-control')) }}
            @if(isset($report))
                <!-- {{ app_path().$report->controller }} -->
                <a href={{ $report->controller }}> <i class="material-icons"> attach_file </i> {{ basename($report->controller) }} </a>
            @endif
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {{ Form::label('model', 'Model') }}
            {{ Form::file('model', array('class' => 'form-control')) }}
            @if(isset($report))
                <!-- {{ app_path().$report->controller }} -->
                <a href={{ app_path().substr($report->model, 4)  }} download> <i class="material-icons"> attach_file </i> {{ basename($report->model) }} </a>
            @endif
        </div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('sql', 'Sql') }}
    {{ Form::textarea('sql',null, array('class' => 'form-control')) }}
</div>