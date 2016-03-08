<?php
	class LoginResult
	{
		public $Username;
		public $Success;
		public $Room;
		
		public function __construct()
		{
			$this->Username = "";
			$this->Success = false;
			$this->Room = "";
		}
	}
?>