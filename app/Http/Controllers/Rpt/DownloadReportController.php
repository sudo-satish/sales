<?php

namespace App\Http\Controllers\Rpt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Rpt\Report;

class DownloadReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->downloadReport($request);
        
        return view('rpt/download-report/.index', ['reports' => Report::all()]);
    }

    /**
     * All logic download the report is written here only.
     */
    public function downloadReport($request) {
        //making assertion here as the testing is not working. remove these assertion after finishing the task.

        $reportId = 1;
        $report = Report::find($reportId);
        $isCustom = $report->custom;
        if($isCustom == 'Y') {
            echo ' Custom Report !! will work on it later, ';
        } else {
            echo ' Simple Report';
            $defaultController = new \App\Extras\Rpt\Controllers\DefaultController();
            $defaultModel = new \App\Extras\Rpt\Models\DefaultModel();

            $defaultController->setModel($defaultModel);

            $defaultController->setRequest($request);
            $defaultController->setReportModel($report);
            
            $defaultModel->setRequest($request);
            $defaultModel->setReportModel($report);
            
            // =========== Start generating report ===========
            $defaultController->generateReport();
        }

        dd($report->name);

        $fileLocation = 'D:\laravel p\sales\app/Extras/Rpt/Controllers\PFReport.php';
        $controllerClass = '\App\Extras\Rpt\Controllers'.'\\'.basename($fileLocation,'.php');

        $controller =  new $controllerClass();
        // $controller->downloadReport();
        return $controller->generateReport();
        exit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
