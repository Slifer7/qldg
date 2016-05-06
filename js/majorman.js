var gEditingMajor = false;
var gOldMajorCode;
var gNewMajorCode;
var gNewMajorName;
var gClipboard;

function ValidateImportFile(){
	var file = document.getElementById("upfile");
	var txtInfo = document.getElementById("txtInfo");
	txtInfo.className = "Error";

	if (file.value.length == 0){
		txtInfo.innerHTML = "Lỗi: Chưa lựa chọn tập tin để import. <br/><br/>";
		return false;
	}

	return true;
}

function beginEditMajor(id){
	if (gEditingMajor == false){
		gEditingMajor = true;

		var tr = $("#" + id);
		gClipboard = tr.html();	// Lưu dữ liệu ban đầu để phục hồi
		var childs = tr.children("td");
		gNewMajorCode = childs[0];
		gNewMajorName = childs[1];
		gOldMajorCode = childs[0].innerText;

		gNewMajorCode.innerHTML = "<input id='newCode' style='width: 70px;' type='text' value='{0}'/>".format(childs[0].innerText);
		gNewMajorName.innerHTML = "<input id='newName' style='width: 180px;' type='text' value='{0}'/>".format(childs[1].innerText);

		// Đổi nút Edit thành hai nút khác, OK và Cancel
		childs[2].innerHTML = "<a href='endEdit' onclick='return endEditMajor({0});'>OK</a> &nbsp;<a href='cancelEdit' onclick='return cancelEditMajor({1});'>Hủy</a>".format(id, id);
	}
	else{
		alert('Bạn đang hiệu chỉnh dữ liệu ở dòng khác.');
	}

	return false;
}

function endEditMajor(id){
	var tr = $("#" + id);
	var newCode = $("#newCode").val();
	var newName = $("#newName").val();

	$.ajax({"url": "doUpdateMajor.php",
		"type" : "POST",
		"data" : {
			"oldCode": gOldMajorCode,
			"newCode" : newCode,
			"newName" : newName
		},
		"success" : function(data){
				console.log(data);
				gNewMajorCode.innerText = newCode;
				gNewMajorName.innerText = newName;
				alert("Đã cập nhật thành công cho ngành học có mã: " + newCode);
		}
	});
	console.log("End edit");
	return false; // Đi từ thẻ a nên cần return false để sự kiện click link không xảy ra
}

function cancelEditMajor(id){
	//Phục hồi dữ liệu hiện tại từ clipboard
	$("#" + id).html(gClipboard);
	gIsEditing = false;

	return false; // Đi từ thẻ a nên cần return false để sự kiện click link không xảy ra
}
