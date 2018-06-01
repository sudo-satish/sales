<?php
// Should extend the spreadsheet class
namespace App\Extras\Rpt\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;

class DefaultController {
    private $modelObj;
    private $reportModel;
    private $spreadSheetObj;
    private $templatePath;

    public function __construct(){
        // parent::__construct();
        $this->spreadSheetObj = new Spreadsheet();
    }

    /**
     * Set Report Model
     * 
     * @return App\Extras\Rpt\Controllers\DefaultController $this To chain the function
     */
    public function setReportModel($report) {
        $this->reportModel = $report;
        return $this;
    }

    /**
     * To get Report Model.
     * 
     * @return App\Http\Models\Rpt\Report $report  
     */
    public function getReportModel() {
        return $this->reportModel;
    }

    /**
     * Get PHP Excel Object
     */
    public function getSpreadsheet() {
        return $this->spreadSheetObj; 
    }

    /**
     * Get PHP Excel Object
     */
    public function getObjPHPExcel() {
        return $this->getSpreadsheet();
    }

    /**
     * Return Model Obj
     */
    public function getModel() {
        return $this->modelObj;
    }
    
    /**
     * Set Model Obj
     */
    public function setModel($modelObj) {
        $this->modelObj = $modelObj;
        return $this;
    }

    /**
     * Set Maximum exection Time
     */
    public function setMaxExectionTime($maxExecTime=500) {
        ini_set('max_execution_time', $maxExecTime);
    }

    /**
     * Child Class must use getObjPHPExcel to get php excel class object and write logic. 
     * 
     * @param Array $options = array() used to customize the report:  future scope. 
     */
    public function downloadReport($options = array()) {
        // Logic to generate the simple report.
        // Get Data array from Model Class.
        // Get Report Model 
        // Fetch Max Row
        // Start printing rows.
    }

    public function generateReport($options = array()) {
        $spreadsheet = $this->getSpreadsheet();
       // Set Max Exection Time using Model.
    //    if(isset($this->getReportModel()->max_execution_time) && !empty($this->getReportModel()->max_execution_time)) {
    //        $this->setMaxExectionTime($this->getReportModel()->max_execution_time);
    //    }

        $this->downloadReport($options);
        // $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'Hello World !');

        $writer = new Xlsx($spreadsheet);
        // $templatePath1 = 'Rpt\Downloads\Hello World.xlsx';
        // Fetch Template path.
        
        $templatePath2 = 'D:\laravel p\sales\app\Extras\Rpt\Templates\Pay_Register_satish_201805151721.xlsx';
        // $url = Storage::path($templatePath1);
        $path = copy($templatePath2, storage_path().'\Rpt\Downloads\\'.basename($templatePath2, '.xlsx').time().'.xlsx');
        
        echo $path; exit;
        $url = Storage::copyFrom($templatePath2, basename($templatePath2, '.xlx'));

        // $url = $templatePath;
        echo '<br>'.$url.'<br>';
        // echo $url; exit;
        // return Storage::download('Rpt\Downloads\Hello World.xlsx');
        // echo $url;
        // var_dump(file_exists($url));
        // $realPath = absolutepath($url);
        // echo $url;
        // exit;
        $writer->save($url);
        return Storage::download($url);
    }
}