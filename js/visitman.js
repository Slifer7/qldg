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
		// Status feedback
		var txtInfo = document.getElementById("txtInfo");
		txtInfo.innerHTML = info;
		txtInfo.className = "Error";
	}
	else {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				var visitInfo = JSON.parse(xhttp.responseText);				
				var txtInfo = document.getElementById("txtInfo");
				var info = "";
				
				if (visitInfo.VisitID == -1) {
					info = "Có lỗi khi thêm lượt truy cập của sinh viên. Có thể sinh viên chưa đăng kí.<br/><br/>";	
					txtInfo.className = "Error";
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
					txtInfo.className = "Info";
					
					// Reset form cho lần nhập thông tin kế
					txtStudentID = document.getElementById("txtStudentID")
					txtStudentID.focus();					
					txtStudentID.value = "";
					
					txtFullName = document.getElementById("txtFullName");
					txtFullName.value = "";
				}
				
				txtInfo.innerHTML = info;
			}
		};

		xhttp.open("POST", "doInsertVisit.php", true); // Asynchronous
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
		var studentID = document.getElementById("txtStudentID").value;
		xhttp.send("StudentID=" + studentID );		
	}	
}

function txtStudentID_TextChanged(){		
	var len = $("#txtStudentID").val().length;
	
	if (len == 7 || len == 8){ // 
		btnInsertStudentID_Click();
	}
}

function test(){
	console.log("change");
}

function txtStudentID_KeyDown(){
	var code = String.fromCharCode(event.keyCode);
	console.log(code);
	return "0123456789CBN".indexOf(code) > 0;
}