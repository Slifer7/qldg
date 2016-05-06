function updateHistory(){
  date = $("#txtDate").val();
  list = $("#txtStudents").val();

  if (checkValidData(date, list)){
    var info = $("#txtInfo");

     $.ajax({"url": "doUpdateHistory.php",
  		"type" : "POST",
  		"data" : {
  			"date": date,
  			"list" : list
  		},
  		"success" : function(data){
  				console.log(data);
  		}
  	});
  }
}

function checkValidData(date, list){
  var info = $("#txtInfo");
  info.attr("class", "Error")

  if (date.length == 0) {
      info.html("Chưa nhập ngày!");
      return false;
  }

  var error = checkValidDateFormat(date);
  if (error.length != 0) {
      info.html(error);
      return false;
  }

  if (list.length == 0) {
      info.html("Chưa nhập danh sách mã số sinh viên!");
      return false;
  }

  info.attr("class", "Info")
  info.html("");
  return true;
}

function checkValidDateFormat(day){
	var INSTRUCTION = "Nhập ngày tháng theo định dạng: dd/mm/yyyy, ví dụ 15/02/2015.";
	var INVALID_DATEFORMAT = "Ngày tháng không đúng định dạng.";
	var STRICT = true;

	var error = "";

	if(false == moment(day, "DD/MM/YYYY", STRICT).isValid()){
		error += INVALID_DATEFORMAT + "<br/>" + INSTRUCTION; + "<br/><br/><br/>";
	}

	return error;
}
