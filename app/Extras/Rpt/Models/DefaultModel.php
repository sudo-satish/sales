<?php
// Should extend the spreadsheet class
namespace App\Extras\Rpt\Models;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DefaultModel {
    private $reportModelObj;
    private $request;

    public function fetchDataFromQuery($sql) {
        // $sql = eval($sql);
        eval("\$sql = \"$sql\";");
        $this->printQueryForDebug($sql);
        return DB::select($sql);
    }

    public function printQueryForDebug($sql) {
        $env = env('APP_ENV', 'production');
        if($this->getReportModel()->debug == 'Y' && $env !== 'production') {
            echo $sql; exit;
        }
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

}