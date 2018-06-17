@extends('sys.mail.layout')

@section('resource-body')
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ Html::ul($errors->all()) }}
        </div>
    @endif

    <div class="container">
        <div class="card">
            <div class="card-header">
                Subject : {{ $mail->subject }}
            </div>
            <div class="card-body">
                <p class="card-text">
                    <?php echo $mail->verbose ; ?> 
                </p>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 1em;">
        <div class="list-group">
            <a  class="list-group-item list-group-item-action list-group-item-light">To : {{ $mail->to }} </a>
            <a  class="list-group-item list-group-item-action list-group-item-light">CC : {{ $mail->cc }}  </a>
            <a  class="list-group-item list-group-item-action list-group-item-light">BCC : {{ $mail->bcc }}  </a>
        </div>
        <a  style="cursor:pointer;" class="list-group-item list-group-item-action list-group-item-primary" onClick="CRO.simulate({{ $mail->id }})"> Send test mail </a>
    </div>
    
    
    
    

@endSection