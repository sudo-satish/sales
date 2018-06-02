<?php

namespace App\Http\Controllers\Rpt;

use App\Http\Models\Rpt\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DefineReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rpt.define-report.index')->with('values', Report::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('rpt.define-report.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // print_r($request->all());
        $rule = [
            'name' => 'required|max:255',
            'code' => 'required|unique:reports|max:50',
        ];
        
        if($request->input('custom') == 'Y') {
            // contoller and model is mandatory
            // $rule['controller'] = 'file|mimes:php';
            // $rule['model'] = 'file|mimes:php';
        } else {
            $rule['sql'] = 'required';
            // $rule['template'] = 'required|mimes:xlsx';
        }
                
        $request->validate($rule);

        $report = new Report();
        $report->fill($request->except('id'));
        $errors = [];

        if($request->input('custom') == 'Y') {
            
            if(!$request->hasFile('controller')) {
                // $errors = ['Please Upload controller'];
                array_push($errors, 'Please Upload controller');
            } else {
                if($request->file('controller')->getClientOriginalExtension() !== 'php') {
                    array_push($errors, 'Controller file should of php');
                }
            }
            if(!$request->hasFile('model')) {
                array_push($errors, 'Please upload model');
            } else {
                if($request->file('model')->getClientOriginalExtension() !== 'php') {
                    array_push($errors, 'Model file should of php');
                }
            }

            if(empty($errors)) {

                $controller = $request->file('controller');
                $controllerName = $controller->getClientOriginalName();
                $controller->move(
                                app_path()
                                // DIRECTORY_SEPARATOR.'App'
                                .DIRECTORY_SEPARATOR.'Extras'
                                .DIRECTORY_SEPARATOR.'Rpt'
                                .DIRECTORY_SEPARATOR.'Controllers',
                                $controllerName
                            );

                $controllerPath = DIRECTORY_SEPARATOR.'App'
                                .DIRECTORY_SEPARATOR.'Extras'
                                .DIRECTORY_SEPARATOR.'Rpt'
                                .DIRECTORY_SEPARATOR.'Controllers'
                                .DIRECTORY_SEPARATOR.$controllerName;

                $report->controller = $controllerPath;
    
                $model = $request->file('model');
                $modelName = $model->getClientOriginalName();

                $model->move(
                            app_path()
                            // DIRECTORY_SEPARATOR.'App'
                            .DIRECTORY_SEPARATOR.'Extras'
                            .DIRECTORY_SEPARATOR.'Rpt'
                            .DIRECTORY_SEPARATOR.'Models', 
                            $modelName
                        );
                $modelPath =    DIRECTORY_SEPARATOR.'App'
                                .DIRECTORY_SEPARATOR.'Extras'
                                .DIRECTORY_SEPARATOR.'Rpt'
                                .DIRECTORY_SEPARATOR.'Models'
                                .DIRECTORY_SEPARATOR.$modelName ;

                $report->model = $modelPath;
            }
        } 

        if(!$request->hasFile('template')) {
            array_push($errors, 'Please upload Template');
        } else {
            if($request->file('template')->getClientOriginalExtension() !== 'xlsx') {
                array_push($errors, 'Template file should of xlsx');
            } else {
                $template = $request->file('template');
                $templateName = $template->getClientOriginalName(); // Because laravel manage files in storage module only.
                $templatePath = $template->move(
                            storage_path()
                            .DIRECTORY_SEPARATOR.'app'
                            .DIRECTORY_SEPARATOR.'extras'
                            .DIRECTORY_SEPARATOR.'rpt'
                            .DIRECTORY_SEPARATOR.'templates', 
                            $templateName
                        );
                $report->template = $templatePath;
            }
        }
        
        if(!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
        }
        
        // $report = new Report();
        // $report->fill($request->all());
        // $report->controller
        $report->save();
        return redirect()->back()->with('message', 'Report created successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Rpt\Report  $defineReport
     * @return \Illuminate\Http\Response
     */
    public function show(Report $defineReport)
    {
        //
        // dd($defineReport); 
        return redirect('rpt/define-report/'.$defineReport->id.'/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rpt\Report  $defineReport
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $defineReport)
    {
        //
        // dd($defineReport);
        return view('rpt.define-report.edit', ['report' => $defineReport] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rpt\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $defineReport)
    {
        //
        $fillArr = $request->except(['controller','template','model']);
        // dd($fillArr);
        $defineReport->fill($fillArr);
        $defineReport->custom = $request->has('custom') ? $request->input('custom') : '';
        $defineReport->debug = $request->has('debug') ? $request->input('debug') : '';
        $defineReport->active = $request->has('active') ? $request->input('active') : '';
        $errors = [];

        if($request->input('custom') == 'Y') {
            if($request->hasFile('controller')) {
                if($request->file('controller')->getClientOriginalExtension() !== 'php') {
                    array_push($errors, 'Controller file should of php');
                } else {
                    $controller = $request->file('controller');
                    $controllerName = $controller->getClientOriginalName();
                    $controller->move(
                                    app_path()
                                    // DIRECTORY_SEPARATOR.'App'
                                    .DIRECTORY_SEPARATOR.'Extras'
                                    .DIRECTORY_SEPARATOR.'Rpt'
                                    .DIRECTORY_SEPARATOR.'Controllers',
                                    $controllerName
                                );

                    $controllerPath = DIRECTORY_SEPARATOR.'App'
                                    .DIRECTORY_SEPARATOR.'Extras'
                                    .DIRECTORY_SEPARATOR.'Rpt'
                                    .DIRECTORY_SEPARATOR.'Controllers'
                                    .DIRECTORY_SEPARATOR.$controllerName;

                    $defineReport->controller = $controllerPath;
                }
            } else {
                if(!$defineReport->controller) {
                     array_push($errors, 'Please upload controller for custom report.');
                }
            }

            if($request->hasFile('model')) {
                if($request->file('model')->getClientOriginalExtension() !== 'php') {
                    array_push($errors, 'Model file should of php');
                } else {
                    $model = $request->file('model');
                    $modelName = $model->getClientOriginalName();

                    $model->move(
                                app_path()
                                // DIRECTORY_SEPARATOR.'App'
                                .DIRECTORY_SEPARATOR.'Extras'
                                .DIRECTORY_SEPARATOR.'Rpt'
                                .DIRECTORY_SEPARATOR.'Models', 
                                $modelName
                            );
                    $modelPath =    DIRECTORY_SEPARATOR.'App'
                                    .DIRECTORY_SEPARATOR.'Extras'
                                    .DIRECTORY_SEPARATOR.'Rpt'
                                    .DIRECTORY_SEPARATOR.'Models'
                                    .DIRECTORY_SEPARATOR.$modelName ;

                    $defineReport->model = $modelPath;
                }
            } else {
                if(!$defineReport->model) {
                     array_push($errors, 'Please upload model for custom report.');
                }
            }
        } 
        if($request->hasFile('template')) {
            if($request->file('template')->getClientOriginalExtension() !== 'xlsx') {
                array_push($errors, 'Template file should of xlsx');
            } else {
                $template = $request->file('template');
                $templateName = $template->getClientOriginalName(); // Because laravel manage files in storage module only.
                $templatePath = $template->move(
                            storage_path()
                            .DIRECTORY_SEPARATOR.'app'
                            .DIRECTORY_SEPARATOR.'extras'
                            .DIRECTORY_SEPARATOR.'rpt'
                            .DIRECTORY_SEPARATOR.'templates', 
                            $templateName
                        );
                $defineReport->template = $templatePath;
            }
        }
        
        if(!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $defineReport->save();
        
        return redirect('rpt/define-report/'.$defineReport->id.'/edit')->with('message', 'Successfully updated report');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rpt\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $defineReport)
    {
        //
    }
}
