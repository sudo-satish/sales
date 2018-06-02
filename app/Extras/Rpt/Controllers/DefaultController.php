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
    public function setMaxExectionTime($maxExecTime=500) {
        ini_set('max_execution_time', $maxExecTime);
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
                $sheet->setCellValueByColumnAndRow($col, $row, $value);
                $col++;
            }
            $row++;
        }
    }

    public function generateReport($options = array()) {
        // $spreadsheet = $this->getSpreadsheet();
        $templatePath = $this->getReportModel()->template;
        try {
            $downloadedFile = $this->copyTemplateFile();
            if(!$downloadedFile) {
                return redirect()->back()->withError('Could not replicate the template to generate the report.');
            } // Returns false or newPath <= To copy the template file to report generate path.
        } catch(Exception $e) {
           return redirect()->back()->withError('Could not replicate the template to generate the report.'); 
        }
        
        $inputFileType = 'Xlsx';
        // $inputFileType = 'Xls';
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($downloadedFile);

        $this->setSpreadsheet($spreadsheet);

        $this->downloadReport($options);
        $writer = new Xlsx($spreadsheet);
        $writer->save($downloadedFile);
        return response()->download($downloadedFile);
    }

    private function copyTemplateFile() {
        
        $templatePath = $this->getReportModel()->template;
        $generateReport = storage_path()
                            .DIRECTORY_SEPARATOR.'app'
                            .DIRECTORY_SEPARATOR.'extras'
                            .DIRECTORY_SEPARATOR.'rpt'
                            .DIRECTORY_SEPARATOR.'downloaded'
                            .DIRECTORY_SEPARATOR.$this->getReportModel()->code.'_'.time().'.xlsx';
       
        $path = pathinfo($generateReport);
        if (!file_exists($path['dirname'])) {
            mkdir($path['dirname'], 0777, true);
        }

        $copiedPath = copy($templatePath, $generateReport);
        if (!$copiedPath) {
            return false;
        } else {
            return $generateReport; 
        }

    }
}