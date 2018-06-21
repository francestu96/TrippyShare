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

    // if(!isset($_SESSION))
    //     session_start();
    //
    // if(!isset($_SESSION['name'])){
    //   header('Location: error.html');
    //   return;
    // }
    $_SESSION['userid'] = 7;
  ?>
</head>

<body>
    <?php
      require("common/costants.php");
      require("common/navbar.php");

      preloader();

      $conn = new mysqli("localhost", "S4166252", "]-vqPx]QhpU4tn", "S4166252");

      /* check connection */
      if ($conn->connect_error) {
        error("Connection failed: " . $conn->connect_error, null);
      }

      //QUERY 1) get all unread messages
      $query = "SELECT * FROM messages JOIN users ON receiver=users.id WHERE message_read = 'no' AND users.id=".$_SESSION['userid'];
      if(!($unread_messages=$conn->query($query))){
        error($conn->error, $conn);
      }

      //QUERY 2) get all read messages
      $query = "SELECT * FROM messages JOIN users ON receiver=users.id WHERE message_read = 'yes' AND users.id=".$_SESSION['userid'];
      if(!($read_messages=$conn->query($query))){
        error($conn->error, $conn);
      }

      if($unread_messages->num_rows > 0){
        //QUERY 3) select the sender user and the messages necessary info for UNREAD messages
        $query = "SELECT name, surname, image_name, object, date, message FROM messages JOIN users ON sender=users.id WHERE message_read = 'no'";
        if(!($result=$conn->query($query))){
          error($conn->error, $conn);
        }

        $unread_messages_container = '';
        while($row = $result->fetch_assoc())
          $unread_messages_container .= '<div class="row comment">
              <div class="col-sm-3 col-md-2 text-center-xs">
                  <p>
                      <img style ="width:55%" src="assets/img/users/'. htmlspecialchars($row['image_name']) .'" class="img-responsive img-circle" alt="">
                  </p>
              </div>
              <div class="col-sm-9 col-md-10">
                  <h5 class="text-uppercase">'. htmlspecialchars($row['name']) .' '. htmlspecialchars($row['surname']) .' - '. htmlspecialchars($row['object']) .'</h5>
                  <p class="posted"><i class="fa fa-clock-o"></i> '. htmlspecialchars(date('F d, Y \a\t h:i a', strtotime($row['date']))) .'</p>
                  <p>'. htmlspecialchars($row['message']) .'</p>
                  <p class="reply"><a href="#"><i class="fa fa-reply"></i> Reply</a>
                  </p>
              </div>
          </div>';
      }

      //QUERY 4) select the sender user and the messages necessary info for READ messages
      $query = "SELECT name, surname, image_name, object, date, message FROM messages JOIN users ON sender=users.id WHERE message_read = 'yes'";
      if(!($result=$conn->query($query))){
        error($conn->error, $conn);
      }

      $read_messages_container = '';
      while($row = $result->fetch_assoc())
        $read_messages_container .= '<div class="row comment">
            <div class="col-sm-3 col-md-2 text-center-xs">
                <p>
                    <img style ="width:55%" src="assets/img/users/'. htmlspecialchars($row['image_name']) .'" class="img-responsive img-circle" alt="">
                </p>
            </div>
            <div class="col-sm-9 col-md-10">
                <h5 class="text-uppercase">'. htmlspecialchars($row['name']) .' '. htmlspecialchars($row['surname']) .' - '. htmlspecialchars($row['object']) .'</h5>
                <p class="posted"><i class="fa fa-clock-o"></i> '. htmlspecialchars(date('F d, Y \a\t h:i a', strtotime($row['date']))) .'</p>
                <p>'. htmlspecialchars($row['message']) .'</p>
                <p class="reply"><a href="#"><i class="fa fa-reply"></i> Reply</a>
                </p>
            </div>
        </div>';

      //if unread messages are 0, don't diplay their container
      $container = '<div class="container">
                      <div class="row">'.
                        ($unread_messages->num_rows > 0 ?
                          '<section id="comments" class="comments wow fadeInRight animated">
                              <h4 class="text-uppercase wow fadeInLeft animated">Unread messages</h4>
                              '.$unread_messages_container.'
                          </section>' : '').

                        '<section id="comments" class="comments wow fadeInRight animated">
                            <h4 class="text-uppercase wow fadeInLeft animated">Read messages</h4>
                            '.$read_messages_container.'
                        </section>
                      </div>
                    </div>';

      echo $container;
      require("common/footer.html");
      require("common/scripts.html");
    ?>
</body>

</html>
