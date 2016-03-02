<?php

require_once ("Classes/PHPExcel.php");

class Excel{
	private $_type;
	private $_spreadsheet;
	
	public $ActiveSheet;
	public $Cols;
	public $Rows;
	
	public function __construct($filename){		
		if (strlen($filename) != 0){
			self::Load($filename);
		}
	}	
	
	public function Load($filename){
		$this->_type = PHPExcel_IOFactory::identify($filename);
		$reader = PHPExcel_IOFactory::createReader($this->_type);
		$this->_spreadsheet = $reader->load($filename);
		
		$this->ActiveSheet = $this->_spreadsheet->getSheet(0);
		$this->Rows = $this->ActiveSheet->getHighestRow();
		$this->Cols = PHPExcel_Cell::columnIndexFromString($this->ActiveSheet->getHighestColumn());
	}
}

?>