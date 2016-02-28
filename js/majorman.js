function ValidateImportFile(){
	var file = document.getElementById("fileMajorToImport");
	var txtInfo = document.getElementById("txtInfo");
	
	if (file.value.length == 0){		
		txtInfo.innerHTML = "Lỗi: Chưa lựa chọn tập tin để đăng nhập.";		
		return false;
	}
	else if (file.indexOf(".xlsx") < 0){
		txtInfo.innerHTML = "Lỗi: Chỉ chấp nhận import file excel xlsx (office 2007 trở lên.";
		return false;		
	}		
		
	return true;		
}