<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
  <title>SAW | Messages List</title>
  <link href="assets/css/style.css" rel="stylesheet" title="Style" />
  <?php
    require("common/header.html");

    if(!isset($_SESSION))
        session_start();

    if(!isset($_SESSION['name'])){
      header('Location: error.html');
      return;
    }
  ?>
</head>

<body>
    <?php
      require("common/costants.php");
      require("common/navbar.php");

      preloader();

      //structures to manage conversations and messages
      require("conversationStructures.php");

      $conn = new mysqli("localhost", "S4166252", "]-vqPx]QhpU4tn", "S4166252");

      /* check connection */
      if ($conn->connect_error) {
        error("Connection failed: " . $conn->connect_error, null);
      }

      //QUERY 1) select the user id by email
      $querySelectId = "SELECT id FROM users WHERE email=?";

      try{
        if (!($stmtSelectId = $conn->prepare($querySelectId)))
          throw new Exception($stmtSelectId->error);

        /* bind parameters for markers */
        if(!($stmtSelectId->bind_param("s", $_SESSION['email'])))
          throw new Exception($stmtSelectId->error);

        /* execute query */
        if(!$stmtSelectId->execute())
          throw new Exception($stmtSelectId->error);

        /* get the statement result */
        $result = $stmtSelectId->get_result();
        $id = ($result->fetch_assoc())['id'];

        /* close statement */
        if(!$stmtSelectId->close())
          throw new Exception($stmtSelectId->error);
    }
    catch(Exception $error_message){
      error($error_message, $conn);
    }

    $querySelectMessagesInfo = "SELECT sender, receiver, nameSender, surnameSender, nameReceiver, surnameReceiver, imageSender, imageReceiver, message, date
                FROM messages
                LEFT OUTER JOIN (SELECT image_name as imageSender, name as nameSender, surname as surnameSender, id FROM users WHERE id!=".$id.") as senderTable ON sender=senderTable.id
                LEFT OUTER JOIN (SELECT image_name as imageReceiver, name as nameReceiver, surname as surnameReceiver, id FROM users WHERE id!=".$id.") as receiverTable ON receiver=receiverTable.id
                WHERE sender=".$id." OR receiver=".$id."
                ORDER BY date";

    if(!($result=$conn->query($querySelectMessagesInfo))){
      error($conn->error, $conn);
    }

    //fill conversation structures with results
    while($row = $result->fetch_assoc()){
      $found = false;

      if(empty($conversations)){
        $message = new Message($row['nameSender'], $row['nameReceiver'], $row['message'], $row['date']);
        $conversation = new Conversation($row, $message, $id);

        $conversations = new ConversationList($conversation);
        continue;
      }

      if($conversations->isPresent($conversation, $row['sender'], $row['receiver'])){
        $conversations->addMessage($conversation, new Message($row['nameSender'], $row['nameReceiver'], $row['message'], $row['date']));
      }
      else{
        $message = new Message($row['nameSender'], $row['nameReceiver'], $row['message'], $row['date']);
        $conversation = new Conversation($row, $message, $id);

        $conversations->add($conversation);
      }
    }

    //order conversations by date
    $conversations->sortByDate();

    //fill conversations HTML
    $conversations_container = '';
    foreach(array_reverse($conversations->conversations) as $conversation){
      $conversations_container .= '<div class="media conversation" id="'.$conversation->personId.'" onclick="displayMessages('.$conversation->personId.')">
            <button style="width:100%; text-align:left">
              <div class="row comment">
                  <div class="col-sm-3 col-md-3 text-center-xs">
                      <p>
                          <img style ="width:90%" src="assets/img/users/'. htmlspecialchars($conversation->image) .'" class="img-responsive img-circle" alt="">
                      </p>
                  </div>
                  <div class="col-sm-9 col-md-8">
                      <h5 class="text-uppercase" style="font-weight:bold">'. htmlspecialchars($conversation->name) .' '. htmlspecialchars($conversation->surname).'</h5>
                      <h5>LAST MESSAGE:</5>
                      <p>'. htmlspecialchars($conversation->messages[count($conversation->messages)-1]->message) .'</p>
                      <p class="posted"><i class="fa fa-clock-o"></i> '. htmlspecialchars(date('F d, Y \a\t h:i a', strtotime($conversation->lastMessageDate))) .'</p>
                  </div>
              </div>
            </button>
          </div>';
    }

    //fill messages HTML
    $messages_container = '';
    foreach($conversations->conversations as $conversation){
      foreach($conversation->messages as $message){
        if(empty($message->nameSender)){
          $nameSender = 'You';
          $style = 'style="border-radius:0px 25px 25px 25px; background: rgba(66, 244, 146, 0.2)"';
        }
        else{
          $nameSender = $message->nameSender;
          $style = 'style="border-radius:0px 25px 25px 25px; background: rgba(255, 0, 0, 0.15);"';
        }

        $messages_container .= '<div class="media msg" id="'.$conversation->personId.'">
            <div class="media-body" '. $style .'>
                <small class="pull-right time" style="color:black; padding-right:15px"><i class="fa fa-clock-o"></i>'. htmlspecialchars($message->timestamp) .'</small>
                <h5 style="font-weight:bold; color:#0070FD; margin-top:0px;">'. htmlspecialchars($nameSender) .'</h5>
                <small class="col-lg-10" style="color:black;">'. htmlspecialchars($message->message) .'</small>
            </div>
        </div>';
      }
    }

    $container = '<div class="container" style="width:90%">
                    <div class="row">
                      <div class="conversation-wrap col-lg-4">
                        '.$conversations_container.'
                      </div>
                      <div class="message-wrap col-lg-8">
                        <div class="msg-wrap" id="MyDivElement">
                          '.$messages_container.'
                        </div>
                        <form id="myForm" action="sendMessage.php" method="post">
                          <div class="send-wrap ">
                              <textarea name="message" class="form-control send-message" rows="3" placeholder="Write a reply..."></textarea>
                              <input id="receiverId" name="receiverId" type="hidden" value="">
                          </div>
                          <div class="btn-panel">
                              <a class=" col-lg-4 text-right btn   send-message-btn" role="button" onclick="myForm.submit()"><i class="fa fa-plus"></i> Send Message</a>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>';

    echo $container;

    require("common/footer.html");
    require("common/scripts.html");
  ?>

  <script type="text/javascript" src="assets/js/myJs/manageMessages.js"></script>
</body>

</html>
