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
		
	}
	else {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("txtInfo").innerHTML = xhttp.responseText;
			}
		};

		xhttp.open("POST", "controller/doInsertVisit.php", true); // Asynchronous
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("StudentID=" + studentID + "&Major=" + major);		
	}	
	
	// Status feedback
	document.getElementById("txtInfo").innerHTML = info;
}