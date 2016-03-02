<?php
try {
	// Undefined | Multiple Files | $_FILES Corruption Attack
	// If this request falls under any of them, treat it invalid.
	$txtFile = "upfile";
	if (
		!isset($_FILES[$txtFile]['error']) ||
		is_array($_FILES[$txtFile]['error'])
	) {
		throw new RuntimeException('Invalid parameters.');
	}

	// Check $_FILES['upfile']['error'] value.
	switch ($_FILES[$txtFile]['error']) {
		case UPLOAD_ERR_OK:
			break;
		case UPLOAD_ERR_NO_FILE:
			throw new RuntimeException('No file sent.');
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			throw new RuntimeException('Exceeded filesize limit.');
		default:
			throw new RuntimeException('Unknown errors.');
	}

	//// Check filesize here. 
	//if ($_FILES['upfile']['size'] > 1000000) {
	//	throw new RuntimeException('Exceeded filesize limit.');
	//}

	// Obtain safe unique name from its binary data.
	$uniqueName = sha1_file($_FILES[$txtFile]['tmp_name']);
	
	if (!move_uploaded_file(
		$_FILES["upfile"]['tmp_name'],
		sprintf('uploads/%s',$uniqueName)
	)) {
		throw new RuntimeException('Failed to move uploaded file.');
	}
	
	// Free to process uploaded file
	
	
	
} catch (RuntimeException $e) {
	echo $e->getMessage();
}
?>