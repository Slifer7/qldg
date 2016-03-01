<?php
	class LoginResult
	{
		public $Username;
		public $Success;
		public $RoleName;
		
		public function __construct()
		{
			$this->Username = "";
			$this->Success = false;
			$this->RoleName = "";
		}
	}
?>