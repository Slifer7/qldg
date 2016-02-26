<?php

class RegistrationInfo {
	public $StudentID;
	public $FullName;
	public $MajorName;
	
	public function __construct($id, $name, $major) {
		$this->StudentID = $id;
		$this->FullName = $name;
		$this->MajorName = $major;
	}
}	

?>