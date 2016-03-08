// Kiểm tra sinh viên có đăng kí sử dụng dịch vụ của thư viện hay chưa, nếu có, trả về tên của sinh viên này.
function btnCheckStudentID_Click() {
	// Kiểm tra có nhập dữ liệu hay chưa
	var info = CheckValidStudentInfo();
	var studentID = document.getElementById("txtStudentID").value;
	
	if (info.length != 0) { // invalid input data 
		var txtInfo = document.getElementById("txtInfo");
		txtInfo.innerHTML = info;
		txtInfo.className = "Error";
	}
	else {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				var reginfo = JSON.parse(xhttp.responseText);
				
				var txtFullName = document.getElementById("txtFullName");	
				var txtInfo = document.getElementById("txtInfo");
				var errorMsg = "";
				
				if (reginfo.StudentID.length == 0) { // Không có thông tin từ server
					errorMsg = "Sinh viên chưa đăng kí sử dụng thư viện.<br/><br/>";
					txtFullName.value = "";
					txtInfo.className = "Error";
				}
				else {
									
					errorMsg = "";
					txtFullName.value = reginfo.FullName;
				}	

				txtInfo.innerHTML = errorMsg;	
				 				
			}
		};

		xhttp.open("POST", "checkStudentExist.php", true); // Asynchronous
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("StudentID=" + studentID);
	}
}

// Kiểm tra dữ liệu ở giao diện có hợp lệ và đầy đủ hay chưa
function CheckValidStudentInfo()
{
	var info = "";	
	var studentID = document.getElementById("txtStudentID").value;
	
	if (studentID.length == 0)
		info += "Chưa nhập MSSV. <br/><br/>";
	
	return info;
}

function btnInsertStudentID_Click() {	
	var info = CheckValidStudentInfo();
	
	if (info.length != 0) { // invalid input data 
		$("#txtInfo").html(info).attr("class", "Error");
	}
	else {
		insertVisit($("#txtStudentID").val());	
	}	
}

function insertVisit(id){
	var len = id.length;
	
	if (len == 7 || len == 8){ // 
		$.ajax({
			"url": "doInsertVisit.php",
			"type": "GET",
			"data":  "StudentID=" + id,
			"success": function(data){
				var visitInfo = JSON.parse(data);				
				var txtInfo = $("#txtInfo");
				var info = "";
				
				if (visitInfo.VisitID == -1) {
					info = "Có lỗi khi thêm lượt truy cập của sinh viên. Có thể sinh viên chưa đăng kí.<br/><br/>";	
					txtInfo.attr("class", "Error");
				}
				else {										
					// Chèn sinh viên mới vào đầu bảng
					var tblVisitList = document.getElementById("tblVisitList");
					var row = tblVisitList.insertRow(1); // Bỏ qua hàng đầu của bảng là header
					row.insertCell(0).innerHTML = visitInfo.StudentID;
					row.insertCell(1).innerHTML = visitInfo.FullName;
					row.insertCell(2).innerHTML = visitInfo.Major;
					row.insertCell(3).innerHTML = visitInfo.Date;
					
					info = "Đã thêm thành công lượt truy cập của sinh viên có mã số: " + visitInfo.StudentID + " - " + visitInfo.FullName + "<br/><br/>";					
					txtInfo.attr("class", "Info");
					
					// Reset form cho lần nhập thông tin kế
					$("#txtStudentID").focus().text("");
					
					txtFullName = $("#txtFullName");
					txtFullName.text("");
				}
				
				txtInfo.html(info);
			}
		});
	}
}

function txtStudentID_Pasted(){		
	var id = undefined;
	if (window.clipboardData && window.clipboardData.getData) { // IE
		id = window.clipboardData.getData('Text');
	} else if (event.clipboardData && event.clipboardData.getData) {
		id = event.clipboardData.getData('text/plain');
	}	
	var len = id.length;
	
	if (len == 7 || len == 8){ 
		insertVisit(id);
	}
}

function txtStudentID_KeyDown(){
	var code = String.fromCharCode(event.keyCode);
	return "0123456789CBN".indexOf(code) >= 0;
}