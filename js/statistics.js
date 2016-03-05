function showStatistics(){
	var fromDate = document.getElementById("txtFromDate").value;
	var toDate = document.getElementById("txtFromDate").value;
	
	var error = checkValidDateFormat(fromDate);
	var txtInfo = document.getElementById("");
	if (error.length != 0){
		
	}
}

function export2Excel(){
	
}

function checkValidDateFormat(day){	
	var INSTRUCTION = "Nhập ngày tháng theo định dạng: dd/mm/yyyy, ví dụ 15/02/2015.";
	var INVALID_DATEFORMAT = "Ngày tháng không đúng định dạng.";
	
	var error = "";
	var pattern = /(0[1-9])|([1-3][0-9])/;
	var result = pattern.exec(day);
	
	if(result == null){
		error += INVALID_DATEFORMAT + "<br/>" + INSTRUCTION; + "<br/><br/>";
	}
		
	return error;
}