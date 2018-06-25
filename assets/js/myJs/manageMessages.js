"use strict";
//when document is ready, display the first covenrsation messages
$(document).ready(function() {
     displayMessages(document.getElementsByClassName("media conversation")[0].getAttribute("id"));

     var objDiv = document.getElementById("MyDivElement");
     objDiv.scrollTop = objDiv.scrollHeight;
});


//if message belongs to the current conversation, display it, otherwise don't
function displayMessages(conversationId){
  var messages = document.getElementsByClassName("media msg");

  for(var i=0; i<messages.length; i++){
    if(messages[i].getAttribute("id") == conversationId)
      messages[i].style.display="block";
    else
      messages[i].style.display="none";
  }

  document.getElementById("receiverId").value=conversationId;
}
