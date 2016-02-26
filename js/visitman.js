function txtStudentID_KeyUp() {
	var studentID = document.getElementById("txtStudentID").value;
	var cmbMajor = document.getElementById("cmbMajor");
	var txtFullName = document.getElementById("txtFullName");
	var txtInfo = document.getElementById("txtInfo");
	var code = "";
	
	if (studentID.length == 0) { // Chưa nhập hoặc xóa trống
		txtInfo.innerHTML = "";
		txtFullName.innerHTML = "";
		cmbMajor.selectedIndex = 0;
	}
	// Nếu có mã số sinh viên thì kiểm tra xem có tồn tại trong CSDL hay không
	if (studentID.length == 7) {// Sinh viên bình thường	
		code = studentID.substring(2, 4); // Kí tự thứ 3 và 4 là mã ngành
		selectCmbMajor(code);
		checkExists(studentID);
	} 	
	else if (studentID.length == 8)	{ // Sinh viên đào tạo từ xa
		code = studentID.substring(2, 3); // Kí tự thứ 3 là mã ngành
		selectCmbMajor(code);
		checkExists(studentID);
	}
	else if (studentID.indexOf("C") > -1) { // Cán bộ - Không kiểm tra tồn tại
		code = "C";	
		selectCmbMajor(code);		
	} 
	else if (studentID.indexOf("B") > -1) { // Cán bộ - Không kiểm tra tồn tại
		code = "B";
		selectCmbMajor(code);
	} 
	else if (studentID.indexOf("N") > -1)	{ // Ngoài trường - Không kiểm tra tồn tại
		code = "C";
		selectCmbMajor(code);
	} 
	else { // Not clear, reset to 0
		
	}
}

// Xác định lựa chọn trong combobox Ngành
function selectCmbMajor(code)
{
	for(var i = 0; i < cmbMajor.options.length; i++) {
		if (code == cmbMajor.options[i].value) {
			cmbMajor.selectedIndex = i;			
			break;
		}
	}
}

function checkExists(studentID) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			var fullname = xhttp.responseText;
			var txtFullName = document.getElementById("txtFullName");
			var txtInfo = document.getElementById("txtInfo");
			
			if (fullname == "NOT_FOUND"){
				txtFullName.value = "";
				txtInfo.innerHTML = "Sinh viên chưa đăng kí sử dụng thư viện.";
			}
				
			else {
				txtFullName.value = fullname;
				txtInfo.innerHTML = "";
			}				
		}
	}		
	xhttp.open("POST", "controller/checkStudentExist.php", true); // Asynchronous
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("StudentID=" + studentID);		
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
				
				if (insertedID == -1) {
					info = "Có lỗi khi thêm lượt truy cập của sinh viên.";	
				}
				else {
					var txtStudentID = document.getElementById("txtStudentID");
					var txtFullName = document.getElementById("txtFullName");
					var cmbMajor = document.getElementById("cmbMajor");
					
					info = "Đã thêm thành công lượt truy cập của sinh viên có mã số: " + txtStudentID.value;
					
					// Chèn sinh viên mới vào đầu bảng
					var tblVisitList = document.getElementById("tblVisitList");
					var row = tblVisitList.insertRow(1); // Bỏ qua hàng đầu là tiêu đề
					row.insertCell(0).innerHTML = txtStudentID.value;
					row.insertCell(1).innerHTML = txtFullName.value;
					row.insertCell(2).innerHTML = cmbMajor.value;
										
					var today = new Date();
					var year = today.getFullYear();
					var month = padding(today.getMonth() + 1, 10, "0"); // Tháng bắt đầu từ 0
					var day = padding(today.getDate(), 10, "0");
					var hour =  padding(today.getHours(), 10, "0");
					var minute = padding(today.getMinutes(), 10, "0");
					var second = padding(today.getSeconds(), 10, "0");
					row.insertCell(3).innerHTML =  year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
					
					// Reset form cho lần nhập thông tin kế
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

function padding(i, max, paddingchar)
{
	if (i < max)
		return paddingchar + i;
	else
		return i;
}
