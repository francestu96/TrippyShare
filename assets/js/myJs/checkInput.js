function checkPassword(){
  var password = document.getElementById("password");
  var password_confirm = document.getElementById("password_confirm");

  if(password.value.length < 6){
    password.style="border:1px solid red";
    password_confirm.style="border:1px solid red";
    return;
  }

  if(password.value !== password_confirm.value){
    password.style="border:1px solid red";
    password_confirm.style="border:1px solid red";
    password_confirm.setCustomValidity("Password not matching!");
    return;
  }
  password.style="border:1px solid green";
  password_confirm.style="border:1px solid green";
  password_confirm.setCustomValidity("");
}

function checkEmail(){
  var email = document.getElementById("email");

  $.ajax({
        type: "GET",
        url: "json.php", //json.php chiede al database tutte le mail e le stampa in jason
        dataType: "json",
        success: function(response){
            for(var i=0; i<response.length; i++){
              if(email.value == response[i]){
                email.style="border:1px solid red";
                email.setCustomValidity("Email already used!");
                return;
              }
            }
            email.style="border:1px solid green";
            email.setCustomValidity("");
        }
    });
}
