function ValidateImportFile(){
	var file = document.getElementById("upfile");
	var txtInfo = document.getElementById("txtInfo");
	
	if (file.value.length == 0){		
		txtInfo.innerHTML = "Lỗi: Chưa lựa chọn tập tin để import. <br/><br/>";		
		return false;
	}
		
	return true;		
}