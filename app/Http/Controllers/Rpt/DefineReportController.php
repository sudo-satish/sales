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
            $rule['template'] = 'required|mimes:xlsx';

        }
                
        $request->validate($rule);

        $report = new Report();
        $report->fill($request->all());

        if($request->input('custom') == 'Y') {
            $errors = [];
            if(!$request->hasFile('controller')) {
                // $errors = ['Please Upload controller'];
                array_push($errors, 'Please Upload controller');
                // return redirect()->back()->withErrors('Please upload contoller');
            } else {
                if($request->file('controller')->getClientOriginalExtension() !== 'php') {
                    array_push($errors, 'Controller file should of php');
                }
            }
            if(!$request->hasFile('model')) {
                array_push($errors, 'Please upload model');
                // return redirect()->back()->withErrors('Please upload model');
            } else {
                if($request->file('model')->getClientOriginalExtension() !== 'php') {
                    array_push($errors, 'Model file should of php');
                }
            }

            if(!empty($errors)) {
                return redirect()->back()->withErrors($errors)->withInput();
            }

            $controller = $request->file('controller');
            $controllerName = $controller->getClientOriginalName();
            $controllerPath = $controller->move(app_path().'\Extras\Rpt'.'\Controllers', $controllerName);
            $report->controller = $controllerPath;

            $model = $request->file('model');
            $modelName = $model->getClientOriginalName();
            $modelPath = $model->move(app_path().'\Extras\Rpt'.'\Models', $modelName);

            $report->model = $modelPath;

        } else {
            $template = $request->file('template');
            $templateName = $template->getClientOriginalName();
            $templatePath = $template->move(app_path().'\Extras\Rpt'.'\Templates', $templateName);

            
            $report->template = $templatePath;
        }

        // $report = new Report();
        // $report->fill($request->all());
        // $report->controller
        $report->save();
        dd($report->getAttributes());
       
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Models\Rpt\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rpt\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rpt\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rpt\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
