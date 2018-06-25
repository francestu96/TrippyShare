"use strict";

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
        url: "checkEmail.php?email=" + email.value, //chiede al database se la mail è già presente
        dataType: "text",
        success: function(response){
            if(response === "ok"){
              email.style="border:1px solid green";
              email.setCustomValidity("");
              return;
            }
            else if(response === "ko"){
              email.style="border:1px solid red";
              email.setCustomValidity("Email non valida o già registrata");
              return
            }
            else{
              window.location.replace("error.hml");
            }
        }
    });
}
