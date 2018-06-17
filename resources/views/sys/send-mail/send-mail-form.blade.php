

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

