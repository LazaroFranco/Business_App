<link rel="stylesheet" href="style.css">

<div id='right-col-container'>

  <?php
  require 'db.php';
  if (!$conn) {
      die("Connection failed: " . mysqli_error());
  }

  $no_message = false;
  if(isset($_GET['ID'])){
    $_GET['ID'] = $_GET['ID'];


    $q="SELECT * FROM Messages
        JOIN Users
        ON Users.ID = {$_GET['ID']}
        WHERE user_from = {$_SESSION['ID']}
        OR user_to = {$_GET['ID']}
        ORDER BY date_time DESC LIMIT 1";

    $r = mysqli_query($conn, $q);
    if (!$r) {
      printf("Error: %s\n", mysqli_error($conn));
      exit();
  }
    while ($row = mysqli_fetch_array($r)) {
        echo "<header class='mheader'>";
              if($row['image'] == "") {
              echo "<img class='eap' src='images/default.svg' class='img-responsive' alt='Default'>          ".$row['Fname']."
              ".$row['Lname']."";
              }
              else {
              echo "<img class='eap' src='images/".$row['image'] ."' class='img-responsive' alt='Default'>           ".$row['Fname']."
              ".$row['Lname']."";
              }


           echo "</header>";
    }
    ?>
<div id='messages-container'>


<?php

}

else {
  die("<br><br><br>

  <h1>Hi ".$_SESSION['Fname'].",<br>Please select someone to message.</h1>");
  $q="SELECT * FROM Messages
      WHERE user_from = {$_SESSION['ID']}
      OR user_to = {$_GET['ID']}
      ORDER BY date_time DESC LIMIT ";

  $r = mysqli_query($conn, $q);
  if (!$r) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
  if($r) {
    if(mysqli_num_rows($r)>0) {
      while($row = mysqli_fetch_assoc($r)){
        $user_to = $row['user_to'];
        $user_from = $row['user_from'];

        if($_SESSION['ID']==$user_from) {
          $_GET['ID'] = $user_to;

        }
        else {
          $_GET['ID'] = $user_from;
        }
      }
    }

  }
  else {
    //query problem
    $r;
  }
}
if($no_message == false) {

 $myQuery = "SELECT *
  FROM Messages
 JOIN Users
  ON Messages.user_from = Users.ID
  WHERE
  user_from= {$_SESSION['ID']}
  AND
  user_to = {$_GET['ID']}
  OR
  user_to={$_SESSION['ID']}
   AND
   user_from = {$_GET['ID']}
  ";


$myResult = mysqli_query($conn, $myQuery);

while ($row = mysqli_fetch_array($myResult)) {

  if($row['user_from'] == $_SESSION['ID']) {



?>
      <div class='blue-message'>
        <p class="blue-p"><?php echo $row['message']; ?>
          <br><p class="-p" style="font-size: 10px;">
          <?php echo $row['date_time'];?>
        </p>
        </p>
      </div>

<?php
    }
    else {
?>
      <div class='grey-message'>
        <p class="grey-p"><?php echo $row['message']; ?>
          <br><p class="grey-p" style="font-size: 10px;">
          <?php echo $row['date_time'];?>
        </p>
        </p>

        </div>

<?php
    }
  }
}
else {
  echo "No messages from you";
  $no_message = true;
}
mysqli_close($conn);

?>
</div>
<form id="message-form" method="POST">
  <textarea class='mtextarea'id="message" placeholder='Write your message...'></textarea>
</form>
</div>

<script src="jquery-3.4.1.min.js"></script>
<script>
$("document").ready(function(event) {
  //if any button is clicked inside
  // right-col-container

  $("#right-col-container").on('submit', '#message-form', function() {
    var message = $("#message").val();
    //send the data to sending_process.php file
    $.post("sending_process.php?ID=<?php echo $_GET['ID']?>", {
      text: message,
    },
    // in return we'll get
    function(data, status) {
      //first remove the text from
      //message_text so
      $("#message").val("");

      //now add the data inside
      //the message container
      document.getElementById("messages-container").innerHTML += data;

    }

    );
  });

  $("#right-col-container").keypress(function(e) {
    //as we will submit the form with enter button so
    if (e.keyCode == 13 && !e.shiftKey) {
      // it means enter this click without shift key
      // so subumit the form
      $("#message-form").submit();
    }
  });
});

window.onload=function () {
     var rightContainer = document.getElementById("messages-container");
     rightContainer.scrollTop = rightContainer.scrollHeight;
}

</script>
