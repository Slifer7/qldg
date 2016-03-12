<?php 
class Helper{
	public static function DeleteAllFiles($folder){
		$files = glob($folder); 
		foreach($files as $file){ 
		  if(is_file($file))
			unlink($file); 
		}
	}
}
?>