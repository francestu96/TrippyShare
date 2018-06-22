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

      //select the id of the user from the emal
      $query = 'SELECT id FROM users WHERE email="'.$_SESSION['email'].'"';
      if(!($result=$conn->query($query))){
        error($conn->error, $conn);
      }
      $id = ($result->fetch_array())[0];
      $query = "SELECT sender, receiver, nameSender, surnameSender, nameReceiver, surnameReceiver, imageSender, imageReceiver, message, date
                  FROM messages
                  LEFT OUTER JOIN (SELECT image_name as imageSender, name as nameSender, surname as surnameSender, id FROM users WHERE id!=6) as senderTable ON sender=senderTable.id
                  LEFT OUTER JOIN (SELECT image_name as imageReceiver, name as nameReceiver, surname as surnameReceiver, id FROM users WHERE id!=6) as receiverTable ON receiver=receiverTable.id
                  WHERE sender=6 OR receiver=6
                  ORDER BY date";

      if(!($result=$conn->query($query))){
        error($conn->error, $conn);
      }

      //$conversations = array();
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

      $conversations_container = '';
      foreach($conversations->conversations as $conversation){
        $conversations_container .= '<div class="media conversation">
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
                      <p class="posted"><i class="fa fa-clock-o"></i> '. htmlspecialchars(date('F d, Y \a\t h:i a', strtotime($conversation->messages[0]->timestamp))) .'</p>
                  </div>
              </div>
            </div>';
      }

      $messages_container = '';
      foreach($conversations->conversations as $conversation){
        foreach($conversation->messages as $message){
          if(empty($message->nameSender)){
            $nameSender = 'You';
            $style = 'style="ackground-color:green; background: rgba(66, 244, 146, 0.2)"';
          }
          else{
            $nameSender = $message->nameSender;
            $style = 'style="ackground-color:light blue; background: rgba(255, 0, 0, 0.1);"';
          }

          $messages_container .= '<div class="media msg" '. $style .'>
              <div class="media-body">
                  <small class="pull-right time" style="color:black;"><i class="fa fa-clock-o"></i>'. htmlspecialchars($message->timestamp) .'</small>
                  <h5 class="media-heading"">'. htmlspecialchars($nameSender) .'</h5>
                  <small class="col-lg-10" style="color:black;">'. htmlspecialchars($message->message) .'</small>
              </div>
          </div>';
        }
      }

      $container = '<div class="container" style="width:90%">
                      <div class="row">
                          <div class="col-lg-3">
                              <div class="btn-panel btn-panel-conversation">
                                  <a href="" class="btn  col-lg-6 send-message-btn " role="button"><i class="fa fa-search"></i> Search</a>
                                  <a href="" class="btn  col-lg-6  send-message-btn pull-right" role="button"><i class="fa fa-plus"></i> New Message</a>
                              </div>
                          </div>

                          <div class="col-lg-offset-1 col-lg-7">
                              <div class="btn-panel btn-panel-msg">

                                  <a href="" class="btn  col-lg-3  send-message-btn pull-right" role="button"><i class="fa fa-gears"></i> Settings</a>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="conversation-wrap col-lg-4">
                          '.$conversations_container.'
                        </div>
                        <div class="message-wrap col-lg-8">
                          <div class="msg-wrap">
                            '.$messages_container.'
                          </div>
                          <div class="send-wrap ">
                              <textarea class="form-control send-message" rows="3" placeholder="Write a reply..."></textarea>
                          </div>
                          <div class="btn-panel">
                              <a href="" class=" col-lg-3 btn   send-message-btn " role="button"><i class="fa fa-cloud-upload"></i> Add Files</a>
                              <a href="" class=" col-lg-4 text-right btn   send-message-btn pull-right" role="button"><i class="fa fa-plus"></i> Send Message</a>
                          </div>
                        </div>
                      </div>
                    </div>';

      echo $container;

      require("common/footer.html");
      require("common/scripts.html");
    ?>
</body>

</html>
