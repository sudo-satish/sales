

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
            {{ Form::label('template_name', 'Template Name') }}
            {{ Form::text('template_name', null, array('class' => 'form-control')) }}
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
            {{ Form::label('subject', 'Subject') }}
            {{ Form::text('subject', null, array('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            {{ Form::label('to', 'To') }}
            {{ Form::text('to', null, array('class' => 'form-control')) }}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {{ Form::label('cc', 'CC') }}
            {{ Form::text('cc', null, array('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            {{ Form::label('bcc', 'BCC') }}
            {{ Form::text('bcc', null, array('class' => 'form-control')) }}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {{ Form::label('active', 'Active') }}
            {{ Form::checkbox('active', 'Y', null, array('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            {{ Form::label('verbose', 'Verbose') }}
            {{ Form::textarea('verbose', null, array('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            {{ Form::label('attachement', 'Attachement') }}
            {{ Form::file('attachement', null, array('class' => 'form-control')) }}
        </div>
    </div>
</div>
