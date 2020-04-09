<?php
//include './nav.php';
include_once '../db.php';
if (!$conn) {
    die("Connection failed: " . mysqli_error());
}

//$ID = isset($_REQUEST['ID'])?$_REQUEST['ID']:'';

//if ($ID == $_SESSION['ID']) {
//  header( 'Location: message.php');
//}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="../style.css">
        <title>Message</title>
    </head>
    <body>

      <?php
          include '../nav.php';
          include 'new-message.php';
      ?>

    <div id="container">
      <div id="menu">
        <?php
         echo "Welcome, ";
         echo $_SESSION['Fname'];
         echo " ";
         echo $_SESSION['Lname'];
        ?>
      </div>
        <div id="left-col">
          <?php include 'left-col.php' ?>
        </div>
        <div id="right-col">
          <?php include 'right-col.php' ?>
        </div>
    </div>
    </body>
      <?php
      include '../footer.php';

      ?>
</html>
