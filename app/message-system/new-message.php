<?php

require '../db.php';
if (!$conn) {
  die("Connection failed: " . mysqli_error());
}
 ?>

<div id="new-message">
  <p class="m-header">new message</p>
  <p class="m-body">
    <form method="post">
      <input class="message-input" onkeyup="check_in_db()" list="user" id="user_to" type="text" placeholder="To: Employee Name or Number" autocomplete="off" name="user_to"/>
      <datalist id="user"></datalist>
      <br><br>
      <textarea name="message" placeholder="Write your message..."/></textarea>
    </br>
  </br>
      <input type="submit" value="Send" class="submit" id="send" name="send" />
      <button id="submit" onclick="document.getElementById('new-message').style.display='none'">Cancel</button>

    </form>
  </p>
  <p class="m-footer">Click send</p>
</div>

<?php
  if (isset($_POST['send'])){
    $user_from = $_SESSION['ID'];
    $user_to = $_POST['user_to'];
    $message = $_POST['message'];
    $date_time = date("Y-m-d h:i:sa");

    $sql = "INSERT INTO `Messages`(user_to, user_from, message, date_time)
     VALUES ('.$user_to.', '.$user_from.', '$message', '$date_time')";

  $r = mysqli_query($conn,$sql);
  if($r){
    //message sent
    echo "Message Sent";

  }
  else {
    echo $sql;
  }
  }
?>
<script src="jquery-3.4.1.min.js"></script>
<script>
  document.getElementById('send').disabled = true;


  function check_in_db() {
    var user_to = document.getElementById('user_to').value;

    $.post("check_in_db.php", {
      user: user_to
    },
    function(data, status) {
      if(data=='<option value="no user">'){
        document.getElementById('send').disabled = true;
      }
      else {
        document.getElementById('send').disabled = false;

    }
    document.getElementById('user').innerHTML = data;

    }
    );
  }
</script>
