function btnShowStatistics_Click(){	
	if (true == checkValidDates()){
		var fromDate = moment($("#txtFromDate").val(), "DD/MM/YYYY", true);
		var toDate = moment($("#txtToDate").val(), "DD/MM/YYYY", true);
		var room = $("#cmbReadingRoom").val();
		var major = $("#cmbMajor").val();	
		
		$.ajax({"url": "getStatistics.php",
			"type" : "GET",
			"data" : {
				"FromDate" : fromDate.format(),
				"ToDate"   : toDate.format(),
				"Room"     : room,
				"Major"    : major
			},
			"success" : function(data){
				// var a = JSON.parse(data);
				
				// console.log(a);
			}
		});
	}
}

function checkValidDates(){
	var txtInfo = $("#txtInfo");
	
	// Kiểm tra ngày bắt đầu
	var txtFromDate = $("#txtFromDate");
	var error = checkValidDateFormat(txtFromDate.val());	
	
	if (error.length != 0){
		txtInfo.text(error);
		txtFromDate.focus();
		return false;
	} //--------------------------
	
	// Kiểm tra ngày kết thúc
	var txtToDate = $("#txtToDate");
	error = checkValidDateFormat(txtToDate.val());
	
	if (error.length != 0){
		txtInfo.text(error);
		txtToDate.focus();
		return false;
	} //--------------------------
	
	// Kiểm tra ngày bắt đầu <= ngày kết thúc
	var DAYORDER = "Ngày bắt đầu phải bằng hoặc trước ngày kết thúc.";
	var fromDate = moment(txtFromDate.val(), "DD/MM/YYYY", true);
	var toDate = moment(txtToDate.val(), "DD/MM/YYYY", true);
	
	if (true == fromDate.isAfter(toDate) ){
		txtInfo.text(DAYORDER);
		return false;
	} //--------------------------
	
	return true;
}

function checkValidDateFormat(day){	
	var INSTRUCTION = "Nhập ngày tháng theo định dạng: dd/mm/yyyy, ví dụ 15/02/2015.";
	var INVALID_DATEFORMAT = "Ngày tháng không đúng định dạng.";
	var STRICT = true;
	
	var error = "";
	
	if(false == moment(day, "DD/MM/YYYY", STRICT).isValid()){
		error += INVALID_DATEFORMAT + "<br/>" + INSTRUCTION; + "<br/><br/>";
	}
		
	return error;
}

function btnExport2Excel_Click(){
	
}

