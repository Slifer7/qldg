function changePass(username){
  console.log("Change pass");

  return false; // Thẻ a
}

function beginEditUser(username){
  console.log("Edit user");

  return false; // Thẻ a
}

function add(){
  var username = $("#txtNewUsername").val();
  var password = $("#txtNewPassword").val();
  var room = $("#txtNewRoom").val();

  
  console.log(username + " " + password + " " + room);
  return false; // Thẻ a
}
