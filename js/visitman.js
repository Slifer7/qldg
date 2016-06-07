function invalidateForm(){
	var id = $("#txtStudentID").val();
	var errorMsg = "";

	if (id.length == 0)
		errorMsg = "Chưa nhập MSSV. <br/><br/>";
	else if (id.length == 1){
		id = id.toUpperCase();
		if(id != "C" && id != "B"	&& id != "N"){
			errorMsg = "MSSV không hợp lệ. <br/><br/>";
		}
	}
	else if ((id.length < 7) || (id.length > 8)){
		errorMsg = "Độ dài MSSV không hợp lệ. <br/><br/>";
		$("#txtStudentID").val("");
	}

	return errorMsg;
}

function insert(id){
	$.ajax({
			"url": "doInsertVisit.php",
			"type": "GET",
			"data":  "StudentID=" + id,
			"success": function(data){
				var visitInfo = JSON.parse(data);
				var info = "";

				if (visitInfo.VisitID == -1) {
					info = "Có lỗi khi thêm lượt truy cập của sinh viên. Có thể sinh viên chưa đăng kí.<br/><br/>";
					$("#txtInfo").attr("class", "Error");
				}
				else {
					// Chèn sinh viên mới vào đầu bảng
					var tblVisitList = document.getElementById("tblVisitList");
					var row = tblVisitList.insertRow(1); // Bỏ qua hàng đầu của bảng là header
					gVisitCount++;
					row.insertCell(0).innerHTML = "<div style='text-align: center'>" + gVisitCount + "</div>";
					row.insertCell(1).innerHTML = visitInfo.StudentID;
					row.insertCell(2).innerHTML = visitInfo.FullName;
					row.insertCell(3).innerHTML = visitInfo.Major;
					row.insertCell(4).innerHTML = visitInfo.Date;

					info = "Đã thêm thành công lượt truy cập của sinh viên: {0} - {1} <br/><br/>"
								.format(visitInfo.StudentID, visitInfo.FullName);
					$("#txtInfo").attr("class", "Info");

					// Reset form cho lần nhập thông tin kế
					$("#txtStudentID").val("").focus();
				}

				$("#txtInfo").html(info);
			}
		});
}

function txtStudentID_Pasted(event){
	var id = undefined;
	if (window.clipboardData && window.clipboardData.getData) { // IE
		id = window.clipboardData.getData('Text');
	} else if (event.clipboardData && event.clipboardData.getData) {
		id = event.clipboardData.getData('text/plain');
	}
	var len = id.length;

	if (len == 7 || len == 8){
		insert(id);
	}
	else
	{
		$("#txtStudentID").val("");
		$('#txtInfo').html("Lỗi khi thêm MSSV " + id + ". Độ dài MSSV không hợp lệ.<br/><br/>").attr("class", "Error");

		return false;
	}
}

function txtStudentID_KeyUp(event){
	if (event.keyCode == 13) { //13 la phim enter
  	$("#btnInsertStudent").click();
  }
}

function btnInsertStudentID_Click(){
	var errorMsg = invalidateForm();
	if (errorMsg.length == 0)
	{
		var id = $("#txtStudentID").val();
		insert(id);
	}
	else {
			$("#txtStudentID").val("");
			$('#txtInfo').html(errorMsg).attr("class", "Error");
	}
}
