<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name','', array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('email', 'Email') }}
    {{ Form::email('email', '', array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('nerd_level', 'Nerd Level') }}
    {{ Form::select('nerd_level', array('0' => 'Select a Level', '1' => 'Sees Sunlight', '2' => 'Foosball Fanatic', '3' => 'Basement Dweller'),'', array('class' => 'form-control')) }}
</div>

{{ Form::submit('Create the Nerd!', array('class' => 'btn btn-primary')) }}