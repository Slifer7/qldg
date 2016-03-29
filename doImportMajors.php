<?php
require_once("MajorInfo.php");
require_once("Helper.php");
session_start();

try {
	$txtFile = "upfile";
	if (
		!isset($_FILES[$txtFile]['error']) ||
		is_array($_FILES[$txtFile]['error'])
	) {
		throw new RuntimeException('Invalid parameters.');
	}
	
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

	// Tạo ra tên duy nhất
	$uniqueName = sprintf('upload/%s',
						  sha1_file($_FILES[$txtFile]['tmp_name'])
						 );
	
	if ( ! move_uploaded_file($_FILES[$txtFile]['tmp_name'],
							  $uniqueName)
	    ){
		throw new RuntimeException('Failed to move uploaded file.');
	}
	
	// Xử lí file được upload lên ở đây
	$result = MajorInfo::Import($uniqueName);
	$_SESSION["MAJOR_IMPORT_RESULT"] = $result;
	
	//Xóa các file đã upload trong thư mục upload
	Helper::DeleteAllFiles("upload/*");
	
	// Chuyển đến trang hiển thị kết quả
	header("Location: controlpanel.php?action=showMajorImportResult");	
} catch (RuntimeException $e) {
	echo $e->getMessage();
}
?>