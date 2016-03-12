<?php

require_once ("Classes/PHPExcel.php");

class Excel{
	private $_filename;
	private $_type;
	private $_spreadsheet;
	
	public $ActiveSheet;
	public $Cols;
	public $Rows;
	
	public function __construct($filename){		
		$this->_filename = $filename;
	}	
	
	public function Load(){
		$this->_type = PHPExcel_IOFactory::identify($this->_filename);
		$reader = PHPExcel_IOFactory::createReader($this->_type);
		$this->_spreadsheet = $reader->load($this->_filename);
		
		$this->ActiveSheet = $this->_spreadsheet->getSheet(0);
		$this->Rows = $this->ActiveSheet->getHighestRow();
		$this->Cols = PHPExcel_Cell::columnIndexFromString($this->ActiveSheet->getHighestColumn());
	}	
}
?>