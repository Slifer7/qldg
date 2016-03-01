<?php
class MajorInfo
{
	public $MajorID;
	public $Code;
	public $MajorName;
	
	public function __construct($id, $code, $name)
	{
		$this->MajorID = $id;
		$this->Code = $code;
		$this->MajorName = $name;
	}
}
?>