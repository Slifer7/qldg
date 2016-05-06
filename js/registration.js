var gClipboard;
var gIsEditing = false;
var gID;
var gFullName;
var gOldID;

function beginEdit(id){
	if (gIsEditing == false){
		gIsEditing = true;

		var tr = $("#" + id);
		gClipboard = tr.html();	// Lưu dữ liệu ban đầu để phục hồi
		var childs = tr.children("td");
		gID = childs[0];
		gFullName = childs[1];
		gOldID = childs[0].innerText;

		// Chỉ cho phép thay đổi MSSV và Họ tên thôi vì mấy cái còn lại loại suy ra được.
		gID.innerHTML = "<input id='newID' style='width: 70px;' type='text' value='{0}'/>".format(childs[0].innerText);
		gFullName.innerHTML = "<input id='newFullName' style='width: 180px;' type='text' value='{0}'/>".format(childs[1].innerText);

		// Đổi nút Edit thành hai nút khác, OK và Cancel
		childs[4].innerHTML = "<a href='endEdit' onclick='return endEdit({0});'>OK</a> &nbsp;<a href='cancelEdit1' onclick='return cancelEdit({1});'>Hủy</a>".format(id, id);
	}
	else{
		alert('Bạn đang hiệu chỉnh dữ liệu ở dòng khác.');
	}

	return false; // Đi từ thẻ a nên cần return false để sự kiện click link không xảy ra
}

function endEdit(id){
	var tr = $("#" + id);
	var newID = $("#newID").val();
	var newFullName = $("#newFullName").val();

	// Lấy dữ liệu mới
	$.ajax({"url": "doUpdateStudentInfo.php",
		"type" : "POST",
		"data" : {
			"oldID": gOldID,
			"newID" : newID,
			"newFullName" : newFullName
		},
		"success" : function(data){
				console.log(data);
				gID.innerText = newID;
				gFullName.innerText = newFullName;
				alert("Đã cập nhật thành công cho sinh viên có mã số: " + newID);
		}
	});

	return false; // Đi từ thẻ a nên cần return false để sự kiện click link không xảy ra
}

function cancelEdit(id){
	//Phục hồi dữ liệu hiện tại từ clipboard
	$("#" + id).html(gClipboard);
	gIsEditing = false;

	return false; // Đi từ thẻ a nên cần return false để sự kiện click link không xảy ra
}
