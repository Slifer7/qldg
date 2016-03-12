function beginEdit(id){
	if (g_Editing == false){
		g_Editing = true;
		
		var tr = $("#" + id);
	
		var childs = tr.children("td");

		// Chỉ cho phép thay đổi MSSV và Họ tên thôi vì mấy cái còn lại loại suy ra được.
		childs[0].innerHTML = "<input style='width: 70px;' type='text' value='{0}'/>".format(childs[0].innerText); 
		childs[1].innerHTML = "<input style='width: 180px;' type='text' value='{0}'/>".format(childs[1].innerText); 
		
		childs[4].innerHTML = "<a href='endEdit' onclick='endEdit'>OK</a> &nbsp;<a href='cancel' onclick>Hủy</a>";
	}
	
	return false;
}