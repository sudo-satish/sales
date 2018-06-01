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
        // $this->spreadSheetObj = new Spreadsheet();
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
     * Set PHP Excel Object 
     * Actually we use it to load the template file.
     */
    public function setSpreadsheet($spreadsheet) {
        $this->spreadSheetObj = $spreadsheet;
        return $spreadsheet; 
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
        $dataRow = $this->getModel()->fetchDataFromQuery($sql);
        $dataRow = (array) $dataRow;

        $initialRowIndex =  $this->getReportModel()->row_start_index;
        $spreadsheet = $this->getSpreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $dataRow = json_decode(json_encode($dataRow), true);

        // $sheet->setCellValue('A1', 'Hello World !');
        $row = $initialRowIndex;
        $initialColIndex = 1;
        foreach($dataRow as $index => $data) {
            $col = $initialColIndex;
            foreach($data as $key => $value) {
                // echo '<br> '.$value;
                $sheet->setCellValueByColumnAndRow($col, $row, $value);
                $col++;
            }
            $row++;
        }
    }

    public function generateReport($options = array()) {
        // $spreadsheet = $this->getSpreadsheet();
        $templatePath = $this->getReportModel()->template;
        $inputFileType = 'Xlsx';
        // $inputFileType = 'Xls';
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        // $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        $spreadsheet = $reader->load($templatePath);

        $this->setSpreadsheet($spreadsheet);

        $this->downloadReport($options);
        // $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'Hello World !');
        // $isCustom = $this->getReportModel()->custom;
        // exit;
        $writer = new Xlsx($spreadsheet);
        
        // $templatePath2 = 'D:\laravel p\sales\app\Extras\Rpt\Templates\Pay_Register_satish_201805151721.xlsx';
        // $url = Storage::path($templatePath1);
        // $path = copy($templatePath2, storage_path().'\Rpt\Downloads\\'.basename($templatePath2, '.xlsx').time().'.xlsx');
        
        // echo $path; exit;
        // $url = Storage::copyFrom($templatePath2, basename($templatePath2, '.xlx'));

        // $url = $templatePath;
        // echo '<br>'.$url.'<br>';
        // echo $url; exit;
        // return Storage::download('Rpt\Downloads\Hello World.xlsx');
        // echo $url;
        // var_dump(file_exists($url));
        // $realPath = absolutepath($url);
        // echo $url;
        // exit;
        $generateReport = storage_path()
                            .DIRECTORY_SEPARATOR.'app'
                            .DIRECTORY_SEPARATOR.'extras'
                            .DIRECTORY_SEPARATOR.'rpt'
                            .DIRECTORY_SEPARATOR.'downloaded'
                            .DIRECTORY_SEPARATOR.$this->getReportModel()->code.'_'.now().'.xlsx';
        $returnPath = Storage::copy($templatePath, $generateReport);

        echo $returnPath; exit;
                            // echo '<br>'.$generateReport; exit;
        $writer->save($generateReport);
        return Storage::download($generateReport);
    }
}