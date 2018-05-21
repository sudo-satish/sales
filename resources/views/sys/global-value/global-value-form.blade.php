<!-- {{Session::get('name')}} -->
<!-- {{Session::get('name')}} -->
<!-- {{Request::input('name')}} -->

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

<div class="form-group">
    {{ Form::label('value', 'Value') }}
    {{ Form::text('value',null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('description', 'Description') }}
    {{ Form::textarea('description',null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('from_date', 'From Date') }}
    {{ Form::date('from_date',null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('to_date', 'To Date') }}
    {{ Form::date('to_date',null, array('class' => 'form-control')) }}
</div>

