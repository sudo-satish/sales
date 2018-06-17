<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class views extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate resource views eg. make:view rpt/define-report';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $pathInfo = [];
        

        $pathArg = $this->argument('path');
        $pathInfo['pathArg'] = $pathArg;

        $pathArr = explode('/', $pathArg);
        $pathInfo['pathArr'] = $pathArr;

        $path = implode(DIRECTORY_SEPARATOR, $pathArr);
        $viewName = implode('.', $pathArr);
        $pathInfo['viewName'] = $viewName;

        $viewPath = resource_path().DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$path;
        $pathInfo['viewPath'] = $viewPath;

        if (!file_exists($viewPath)) {
            mkdir($viewPath, 0777, true);
            $this->info('Folder created :=> '.$viewPath);
        } else {
            $this->info('Folder used :=> '.$viewPath);
        }

        $bladeArr = ['index', 'edit', 'create', 'show', end($pathArr).'-form', 'layout'];
        foreach($bladeArr as $index => $bladeName) {
            if (view()->exists($viewName.'.'.$bladeName)) {
                $this->info('Already there : '.$bladeName.'.blade.php, No changes made');
            } else {
                $this->createBlade($pathInfo, $bladeName);
            }
        }

        $this->generateResourceJs($pathInfo);
    }

    public function generateResourceJs($pathInfo) {
        $message = $this->getResourceTemplateContent($pathInfo);

        $fileName = public_path().DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.end($pathInfo['pathArr']).'.js';
        
        if(file_exists($fileName)) {
            $this->info('Already Exists :  '.$fileName.', Hence not updated.');
        } else {
            $fh = fopen($fileName, 'w');
            fwrite($fh, $message."\n");
            fclose($fh);
            $this->info('Created '.$fileName); 
        }
    }

    public function getResourceTemplateContent($pathInfo) {
        return 
"var ".lcfirst(studly_case(end($pathInfo['pathArr'])))." = function () {
    this.init = function () {
        console.log('".lcfirst(studly_case(end($pathInfo['pathArr'])))."');
    }
};";
    }

    public function createBlade($pathInfo, $bladeName) {
        $message = $this->getBladeTemplateContent($pathInfo, $bladeName);

        $fileName = $pathInfo['viewPath'].DIRECTORY_SEPARATOR.$bladeName.'.blade.php';
        
        $fh = fopen($fileName, 'w');
        fwrite($fh, $message."\n");
        fclose($fh);

        $this->info('Created '.$bladeName.'.blade.php');
    }

    public function getBladeTemplateContent($pathInfo, $bladeName) {
        if($bladeName == 'layout') {
            return "
@extends('layouts.app')

@section('content')
<div class=\"container\">

    <div class=\"row justify-content-between\">
        <div class=\"col-4\">
            <a class=\"navbar-brand\" href=\"{{ URL::to('".$pathInfo['pathArg']."') }}\">".$pathInfo['pathArg']."</a>
        </div>
        <div class=\"col-4 \">
            <a class=\"btn btn-info\" href=\"{{ URL::to('".$pathInfo['pathArg']."') }}\">View All ".$pathInfo['pathArg']."</a>
            <a class=\"btn btn-info\" href=\"{{ URL::to('".$pathInfo['pathArg']."/create') }}\">Create a ".$pathInfo['pathArg']."</a>
        </div>
    </div>
    
    @yield('resource-body')
</div>

<script>
    resourceName = '".lcfirst(studly_case(end($pathInfo['pathArr'])))."';
    moduleName = '".reset($pathInfo['pathArr'])."';
</script>

@if(config('app.debug'))
<script src=\"{{ asset('js/resources/".end($pathInfo['pathArr']).".js') }}\" defer></script>
@endif

@endsection";

        
        } 
        
        if($bladeName == 'index') {
return 
'
@extends(\''.$pathInfo['viewName'].'.layout\')

@section(\'resource-body\')
    <!-- will be used to show any messages -->
    @if (Session::has(\'message\'))
        <div class="alert alert-info">{{ Session::get(\'message\') }}</div>
    @endif
    
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ Html::ul($errors->all()) }}
        </div>
    @endif

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>Id</td>
            </tr>
        </thead>
        <tbody>
            @foreach($values as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                
                    <td>
                        <a class="btn btn-small btn-success" href="{{ URL::to(\''.$pathInfo['pathArg'].'/\' . $value->id) }}">Show</a>
                        <a class="btn btn-small btn-info" href="{{ URL::to(\''.$pathInfo['pathArg'].'/\' . $value->id . \'/edit\') }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
@endSection
';
        }

        if($bladeName == 'create') {
return 
'
@extends(\''.$pathInfo['viewName'].'.layout\')

@section(\'resource-body\')
    <!-- will be used to show any messages -->
    @if (Session::has(\'message\'))
        <div class="alert alert-info">{{ Session::get(\'message\') }}</div>
    @endif
    
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ Html::ul($errors->all()) }}
        </div>
    @endif

    {{ Form::open(array(\'url\' => \''.$pathInfo['pathArg'].'\', \'method\' => \'post\')) }}
        @include(\''.$pathInfo['viewName'].'.'.end($pathInfo['pathArr']).'-form\')
    {{ Form::submit(\'Create\', array(\'class\' => \'btn btn-primary\')) }}

    {{ Form::close() }}

    
@endSection
';
        }

        if($bladeName == end($pathInfo['pathArr']).'-form') {
return 
'

<div class="form-group">
    {{ Form::hidden(\'id\',null, array(\'class\' => \'form-control\')) }}
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            {{ Form::label(\'group\', \'Group\') }}
            {{ Form::text(\'group\', null, array(\'class\' => \'form-control\')) }}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {{ Form::label(\'name\', \'Name\') }}
            {{ Form::text(\'name\', null, array(\'class\' => \'form-control\')) }}
        </div>
    </div>
</div>
';
        } 
        
        else {
            return $bladeName;
        }
    }
}
