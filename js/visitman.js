var gID = ""; // Lưu ID đang gõ từ bàn phím

// Kiểm tra sinh viên có đăng kí sử dụng dịch vụ của thư viện hay chưa, nếu có, trả về tên của sinh viên này.
function btnCheckStudentID_Click() {
	var studentID = $("#txtStudentID").val();

	if(studentID.length == 1 && "CBN".indexOf(studentID) >= 0){ // Mã đặc biệt
		var info = "Mã sinh viên đặc biệt, có thể thêm lượt truy cập không cần đăng kí.<br/><br/>";
		$("#txtInfo").html(info).attr("class", "Info");
		return;
	}

	// Kiểm tra có nhập dữ liệu hay chưa
	var info = CheckValidStudentInfo();

	if (info.length != 0) { // invalid input data
		$("#txtInfo").html(info).attr("class", "Error");
		$("#txtFullName").val(""); // Reset phòng trường hợp luồng khác gây ra có dữ liệu sẵn
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
function CheckValidStudentInfo(){
	var info = "";
	var id = $("#txtStudentID").val();

	if (id.length == 0)
		info += "Chưa nhập MSSV. <br/><br/>";
	else if (id.length == 1){
		if(id != "C"
			&& id != "B"
			&& id != "N"){
			info += "Độ dài MSSV không hợp lệ. <br/><br/>";
		}
	}
	else if (id.length < 7) {
		info += "Độ dài MSSV không hợp lệ. <br/><br/>";
	}
	else if (id.length > 8){
		info += "Độ dài MSSV không hợp lệ. <br/><br/>";
	}

	return info;
}

// Các trường hợp đặc biệt là C-Cao học, B-Cán bộ, N-Ngoài trường
function GetFullNameFromSpecialCaseCBN(){
	var val = $("#txtStudentID").val();
	var info = GetSpecialFullNameList();

	return info[val];
}

function GetSpecialFullNameList(){
	var info = [];
	info["C"] = "Cao học";
	info["B"] = "Cán bộ";
	info["N"] = "Ngoài trường";

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

	if (len == 7 || len == 8 || "CBN".indexOf(id) >= 0){ // Độ dài MSSV hợp lệ hay có kí tự đặc biệt
		$.ajax({
			"url": "doInsertVisit.php",
			"type": "GET",
			"data":  "StudentID=" + id,
			"success": function(data){
				var visitInfo = JSON.parse(data);
				var info = "";

				if (visitInfo.VisitID == -1) {
					info = "Có lỗi khi thêm lượt truy cập của sinh viên " + gID + " . Có thể sinh viên chưa đăng kí.<br/><br/>";
					$("#txtInfo").attr("class", "Error");
				}
				else {
					// Chèn sinh viên mới vào đầu bảng
					var tblVisitList = document.getElementById("tblVisitList");
					var row = tblVisitList.insertRow(1); // Bỏ qua hàng đầu của bảng là header
					row.insertCell(0).innerHTML = visitInfo.StudentID;
					row.insertCell(1).innerHTML = visitInfo.FullName;
					row.insertCell(2).innerHTML = visitInfo.Major;
					row.insertCell(3).innerHTML = visitInfo.Date;

					info = "Đã thêm thành công lượt truy cập của sinh viên: {0} - {1} <br/><br/>"
								.format(visitInfo.StudentID, visitInfo.FullName);
					$("#txtInfo").attr("class", "Info");

					// Reset form cho lần nhập thông tin kế
					gInsertedSuccess = true;
					$("#txtStudentID").val("").focus();
					$("#txtFullName").val("");

				}

				// Khu vực reset
				gID = "";
				$("#txtStudentID").val("");
				$("#txtInfo").html(info);
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

// Xảy ra trước khi hiện kí tự
function txtStudentID_KeyPress(){
	// Hot fix vụ insert thành công reset txtStudentID về rỗng nhưng lại gây ra sự kiện keypress???
	$("#txtInfo").html("");
	$("#txtFullName").val("");

	// Chuyển từ chữ thường sang chữ hoa
	var code = String.fromCharCode(event.keyCode);
	if("cbn".indexOf(code) >= 0){
		code = String.fromCharCode(event.keyCode - 32);
	}

	// Gặp kí tự đặc biệt CBN thì chỉ giữ lại một kí tự thôi
	if("CBN".indexOf(code) >= 0){
		$("#txtStudentID").val(code); // Thay toàn bộ mssv bằng kí tự đặc biệt
		$("#txtFullName").val(GetFullNameFromSpecialCaseCBN(code));
		insertVisit(code);
		return false;
	}

	// Trường hợp chỉ nhập số
	if ("0123456789".indexOf(code) >= 0){
		gID += code;
		var len = gID.length;
		console.log(gID);
		if (len == 1) {// Có thể là C, B, N đã có trước ??
			if ("CBN".indexOf(gID) >= 0){ // Đúng là vậy
				$("#txtStudentID").val(""); // Xóa trống nhường chỗ cho số
			}
		}

		if (len == 7 || len == 8){
			insertVisit(gID);
		}

		return true;
	}

	// Chi cho phép nhập số hoặc các chữ cái C, B, N (đã bắt ở trên) mà thôi
	return false;
}

// Xảy ra sau khi hiện kí tự
function txtStudentID_KeyUp(){
	// No backspace needed so no need for keyup!
	/* console.log("Reason?");
	var BACKSPACE = 8;
	var DELETE = 46;
	var val = $("#txtStudentID").val();

	if (val.length == 0){
		$("#txtInfo").html("");
		$("#txtFullName").val("");
	}		 */
}
