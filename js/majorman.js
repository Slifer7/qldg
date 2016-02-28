function ValidateImportFile(){
	var file = document.getElementById("fileMajorToImport");
	var txtInfo = document.getElementById("txtInfo");
	
	if (file.value.length == 0){		
		txtInfo.innerHTML = "Lỗi: Chưa lựa chọn tập tin để đăng nhập.";		
		return false;
	}
		
	return true;		
}