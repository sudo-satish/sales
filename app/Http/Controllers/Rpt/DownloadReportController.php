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
        // return $this->downloadReport($request);->pluck('name');
        $reports = Report::all();
        $viewData = [
                        'reports' => $reports, 
                        'dropDownReport' => $reports->pluck('name','id'),
                        'dropDownGroup' => $reports->pluck('group','group'),
                    ];
        return view('rpt.download-report.index', $viewData);
    }

    public function getGroupForm(Request $request) {
        return view('rpt.group.'.$request->input('group_name'));
    }

    public function getReportList(Request $request) {
        $reportList = Report::all()->where('group', $request->input('group_name'))->pluck('name', 'id') ;
        return view('rpt.download-report.get-report-list', ['reportList' => $reportList]);
        // return response($reportList);
    }

    /**
     * All logic download the report is written here only.
     */
    public function downloadReport(Request $request) {
        //making assertion here as the testing is not working. remove these assertion after finishing the task.

        // dd($request->input('satish'));
        // $query = " Select * from global_values where 1 and if('{$request->input('from_date')}' = '', 0, '{$request->input('from_date')}' < from_date)";

        // echo $query;
        //  exit;  

        if(!$request->input('report')) {
            return redirect()->back()->with('error', ' Please give a report id');
        }

        $reportId = $request->input('report');
        $report = Report::find($reportId);
        $isCustom = $report->custom;
        if($isCustom == 'Y') {
            // =================== Controller ====================
            $file = pathinfo($report->controller);
            $dirName = $file['dirname'];
            $filename = $file['filename'];
            $className = $dirName.DIRECTORY_SEPARATOR.$filename;
            $controller = new $className();

            // =================== Model ==========================
            $modelFile = pathinfo($report->model);
            $modelDirName = $modelFile['dirname'];
            $modelFilename = $modelFile['filename'];
            $modelClassName = $modelDirName.DIRECTORY_SEPARATOR.$modelFilename;
            $model = new $modelClassName();

        } else {
            $controller = new \App\Extras\Rpt\Controllers\DefaultController();
            $model = new \App\Extras\Rpt\Models\DefaultModel();
        }

        $controller->setModel($model);

        $controller->setRequest($request);
        $controller->setReportModel($report);
        
        $model->setRequest($request);
        $model->setReportModel($report);
        
        // =========== Start generating report ===========
        return $controller->generateReport();
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
