<?php
 
namespace App\Extras\Rpt\Controllers;


class PFReport extends DefaultController{

	public function downloadReport($options = array()) {
		$spreadsheet = $this->getSpreadsheet();
       
        $sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Hello World PFReport !');
		
		echo ' Download Report function';
	}
}  