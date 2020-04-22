<?php
session_start();
require('../db.php');
if(isset($_SESSION['ID']) and isset($_GET['ID'])) {
  if (isset($_POST['text'])) {
    if($_POST['text'] !='') {
      // now from here we can insert
      //data into the db
      $user_from = $_SESSION['ID'];
      $user_to = $_GET['ID'];
      $message = $_POST['text'];
      $date_time = date("Y-m-d h:i:sa");


      $sql = "INSERT INTO `Messages`(user_to, user_from, message, date_time)
      VALUES ('.$user_to.', '.$user_from.', '$message', '$date_time')";

      $r = mysqli_query($conn,$sql);
      if($r){
        //message sent
        ?>
          <div class='grey-message'>
            <a href='#'><?php echo $user_from; ?></a>
            <p><?php echo $message; ?></p>
          </div>
        <?php
      }
      else {
        echo $sql;
      }
    }
    else {
      echo '<h1>Please write something first</h1>';
    }
  }
  else {
    echo '<h1>problem with text</h1>';
  }
}
else {
  echo '<h1>Please login or select user to send a message</h1>';
}


?>
