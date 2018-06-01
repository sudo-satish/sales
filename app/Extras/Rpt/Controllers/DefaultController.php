<?php
// Should extend the spreadsheet class
namespace App\Extras\Rpt\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;

class DefaultController {
    private $modelObj;
    private $reportModelObj;
    private $request;
    private $spreadSheetObj;
    private $templatePath;

    public function __construct(){
        // parent::__construct();
        $this->spreadSheetObj = new Spreadsheet();
    }

    public function setRequest($request) {
        $this->request = $request;
        return $this;
    }

    public function getRequest() {
        return $this->request;
    }

    public function setReportModel($reportModel) {
        $this->reportModelObj = $reportModel;
        return $this;
    }

    public function getReportModel() {
        return $this->reportModelObj;
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
    public function setMaxExectionTime() {
        ini_set('max_execution_time', 500);
    }

    /**
     * Child Class must use getObjPHPExcel to get php excel class object and write logic. 
     * 
     * @param Array $options = array() used to customize the report:  future scope. 
     */
    public function downloadReport($options = array()) {

        $sql = $this->getReportModel()->sql;
        $data = $this->getModel()->fetchDataFromQuery($sql);
        
        dd($data);
    }

    public function generateReport($options = array()) {
        $spreadsheet = $this->getSpreadsheet();
       
        $this->downloadReport($options);
        // $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'Hello World !');
        // $isCustom = $this->getReportModel()->custom;
        exit;
        $writer = new Xlsx($spreadsheet);
        
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