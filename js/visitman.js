function txtStudentID_TextChanged() {
	console.log("studentid text changed");
}

function btnCheckStudentID() {
	console.log("log check student");
}

function btnInsertStudentID() {	
	var info = "";
	
	var studentID = document.getElementById("txtStudentID").value;
	
	if (studentID.length == 0)
		info += "Chưa nhập MSSV. <br/>";
	
	var MAJOR_DEFAULT_VALUE = "Ngành";
	var major = document.getElementById("cmbMajor").value;
	
	if (major == MAJOR_DEFAULT_VALUE)
		info += "Chưa có thông tin ngành. <br/>";
	
	if (info.length != 0) { // invalid input data 
		// Status feedback
		document.getElementById("txtInfo").innerHTML = info;
	}
	else {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				var insertedID = xhttp.responseText;
				var info = "";
				
				if (insertedID == -1)
				{
					info = "Có lỗi khi thêm lượt truy cập của sinh viên.";	
				}
				else
				{
					var txtStudentID = document.getElementById("txtStudentID");
					var cmbMajor = document.getElementById("cmbMajor");
					
					info = "Đã thêm thành công lượt truy cập của sinh viên có mã số: " + txtStudentID.value;
					
					// Chèn sinh viên mới vào đầu bảng
					var tblVisitList = document.getElementById("tblVisitList");
					var row = tblVisitList.insertRow(1); // Bỏ qua hàng đầu là tiêu đề
					row.insertCell(0).innerHTML = "";
					row.insertCell(1).innerHTML = txtStudentID.value;
					row.insertCell(2).innerHTML = cmbMajor.value;
					row.insertCell(3).innerHTML = "";
					
					// Reset cho lần nhập thông tin kế
					txtStudentID.value = "";
					txtStudentID.focus();
					
					cmbMajor.selectedIndex = 0;
				}
				
				document.getElementById("txtInfo").innerHTML = info;
			}
		};

		xhttp.open("POST", "controller/doInsertVisit.php", true); // Asynchronous
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("StudentID=" + studentID + "&Major=" + major);		
	}	
}