var gClipboard;
var gIsEditing = false;

function beginEdit(id){
	if (gIsEditing == false){
		gIsEditing = true;
		
		var tr = $("#" + id);
		gClipboard = tr.html();	// Lưu dữ liệu ban đầu để phục hồi		
		var childs = tr.children("td");

		// Chỉ cho phép thay đổi MSSV và Họ tên thôi vì mấy cái còn lại loại suy ra được.
		childs[0].innerHTML = "<input id='' style='width: 70px;' type='text' value='{0}'/>".format(childs[0].innerText); 
		childs[1].innerHTML = "<input style='width: 180px;' type='text' value='{0}'/>".format(childs[1].innerText); 
		 
		// Đổi nút Edit thành hai nút khác, OK và Cancel
		childs[4].innerHTML = "<a href='endEdit' onclick='endEdit'>OK</a> &nbsp;<a href='cancelEdit' onclick='return cancelEdit({0});'>Hủy</a>".format(id);
	}
	else{
		alert('Bạn đang hiệu chỉnh dữ liệu ở dòng khác.');
	}
	
	return false; // Đi từ thẻ a nên cần return false để sự kiện click link không xảy ra
}

function endEdit(id){	
	var tr = $("#" + id);
	var childs = tr.children("td");
	
	
	return false; // Đi từ thẻ a nên cần return false để sự kiện click link không xảy ra
}

function cancelEdit(id){
	//Phục hồi dữ liệu hiện tại từ clipboard
	$("#" + id).html(gClipboard);
	gIsEditing = false;
	
	return false; // Đi từ thẻ a nên cần return false để sự kiện click link không xảy ra
}