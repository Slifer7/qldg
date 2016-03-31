function btnShowStatistics_Click(){	
	$("#linkDownload").html(""); // Bỏ đi cái link download
	
	if (true == checkValidDates()){
		var fromDate = moment($("#txtFromDate").val(), "DD/MM/YYYY", true);
		var toDate = moment($("#txtToDate").val(), "DD/MM/YYYY", true);
		var room = $("#cmbReadingRoom").val();
		var major = $("#cmbMajor").val();	
		
		$.ajax({"url": "getStatistics.php",
			"type" : "GET",
			"data" : {
				"FromDate" : fromDate.format("YYYY-MM-DD"),
				"ToDate"   : toDate.format("YYYY-MM-DD"),
				"Room"     : room,
				"Major"    : major
			},
			"success" : function(data){												
				var a = JSON.parse(data);
				
				// Reset lại cái bảng
				var tblVisits = document.getElementById("tblVisits");
				tblVisits.innerHTML = "";				
				
				if (a.length == 0){
					$("#txtStatResult").html("Không có lượt truy cập nào từ ngày {0} đến {1}.".format(
														fromDate.format("DD/MM/YYYY"),
														toDate.format("DD/MM/YYYY")
											)).attr("class", "Error");
				}	
				else{
					$("#txtStatResult").html("Số lượng lượt truy cập từ ngày {0} đến ngày {1} là <b>{2}</b> <br/><br/>".format(
						fromDate.format("DD/MM/YYYY"),
						toDate.format("DD/MM/YYYY"),
						a.length))
						.attr("class", "Info");					
				
					// Header cho bảng
					tblVisits.innerHTML = "<tr><th>Thời gian</th><th>MSSV</th><th>Ngành học</th><th>Phòng đọc</th><tr>";				
					
					// Nội dung thống kê
					a.forEach(function(item){
						var row = tblVisits.insertRow(-1); // Chèn vào hàng cuối cùng
						row.insertCell(0).innerHTML = item.timestamp;
						row.insertCell(1).innerHTML = item.id;
						row.insertCell(2).innerHTML = item.major;
						row.insertCell(3).innerHTML = item.room;
					});
				}	
			}
		});
	}
}

function checkValidDates(){
	// Reset
	var txtInfo = $("#txtInfo");
	
	// Kiểm tra ngày bắt đầu
	var txtFromDate = $("#txtFromDate");
	var error = checkValidDateFormat(txtFromDate.val());	
	
	if (error.length != 0){
		txtInfo.html(error);
		txtFromDate.focus();
		return false;
	} //--------------------------
	
	// Kiểm tra ngày kết thúc
	var txtToDate = $("#txtToDate");
	error = checkValidDateFormat(txtToDate.val());
	
	if (error.length != 0){
		txtInfo.html(error);
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
	
	$("#txtInfo").html("");
	
	return true;
}

function checkValidDateFormat(day){	
	var INSTRUCTION = "Nhập ngày tháng theo định dạng: dd/mm/yyyy, ví dụ 15/02/2015.";
	var INVALID_DATEFORMAT = "Ngày tháng không đúng định dạng.";
	var STRICT = true;
	
	var error = "";
	
	if(false == moment(day, "DD/MM/YYYY", STRICT).isValid()){
		error += INVALID_DATEFORMAT + "<br/>" + INSTRUCTION; + "<br/><br/><br/>";
	}
		
	return error;
}

function btnExport2Excel_Click(){
	if (true == checkValidDates()){
		var fromDate = moment($("#txtFromDate").val(), "DD/MM/YYYY", true);
		var toDate = moment($("#txtToDate").val(), "DD/MM/YYYY", true);
		var room = $("#cmbReadingRoom").val();
		var major = $("#cmbMajor").val();	
		
		$.ajax({"url": "downloadStatistics.php",
			"type" : "GET",
			"data" : {
				"FromDate" : fromDate.format("YYYY-MM-DD"),
				"ToDate"   : toDate.format("YYYY-MM-DD"),
				"Room"     : room,
				"Major"    : major
			},
			"success" : function(data){	
				// Reset một số thứ
				$("#tblVisits").html("");
				
				// Hiển thị kết quả trước khi report
				$("#txtStatResult").html("Tải kết quả thống kê của các lượt truy cập <br/> Từ ngày: {0} đến ngày: {1}<br/> Phòng đọc: {2}, ngành học: {3} trong link bên dưới:<br/><br/>".format(
					fromDate.format("DD/MM/YYYY"), toDate.format("DD/MM/YYYY"),
					room == "all" ? "Tất cả" :room, major == "all" ? "Tất cả" : major));
				
				$("#linkDownload").html("Download link").attr("href", data);
			}
		});
	}
}


function generateSummaryReport_Click(){
	// TODO: Kiểm tra from date và todate
	
	var fromDate = moment($("#txtFromDate").val(), "DD/MM/YYYY", true);
	var toDate = moment($("#txtToDate").val(), "DD/MM/YYYY", true);
	$.ajax({"url": "getSummaryReport.php",
			"type" : "GET",
			"data" : {
				"FromDate" : fromDate.format("YYYY-MM-DD"),
				"ToDate"   : toDate.format("YYYY-MM-DD"),
			},
			"success" : function(link){	
				// Reset một số thứ
				$("#tblVisits").html("");
				$("#txtStatResult").html("");
				
				$("#linkDownload").html("Download link").attr("href", link);
			}
		});
	
	return false; // Sự kiện sinh ra từ thẻ a nên cần return false để cản
}

