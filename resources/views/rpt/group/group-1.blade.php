<div class="row">
    <div class="col">
        <div class="form-group">
            {{ Form::label('from_date', 'From Date') }}
            {{ Form::date('from_date', null,array('class' => 'form-control')) }}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {{ Form::label('to_date', 'To Date') }}
            {{ Form::date('to_date', null,array('class' => 'form-control')) }}
        </div>
    </div>
</div>