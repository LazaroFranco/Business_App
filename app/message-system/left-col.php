
<link rel="stylesheet" href="style.css">

<div id="left-col-container">
  <div onclick="document.getElementById('new-message').style.display='block'" Eclass="white-back">
    <a style='cursor:grab; text-decoration: none;' id="submit">New Message</a>
  </div>

<?php

require 'db.php';
if (!$conn) {
    die("Connection failed: " . mysqli_error());
}
if (!isset($_SESSION)){
  session_start();
  if($_SESSION['loggedIn'] != TRUE){
      header('Location: index.php');
    }}
$compID = $_SESSION['companyID'];

$no_message = false;
if(isset($_GET['ID'])){
  $_GET['ID'] = $_GET['ID'];

  $q = "SELECT * FROM Users WHERE Approved = '1' AND Company_ID = $compID";

        $myResult = mysqli_query($conn, $q);


        $r = mysqli_query($conn,$q);
        if($r){
          if(mysqli_num_rows($r)>0){
            while($row=mysqli_fetch_assoc($r)){
                ?>
                    <?php echo
        "<a class='mContacts' href='?ID=".$row['ID']."' style='cursor:grab;'>";

        if($row['image'] == "") {
        echo "<img class='mImage' src='images/default.svg' class='img-responsive' alt='Default'>          ".$row['Fname']."
        ".$row['Lname']."";
        }
        else {
        echo "<img class='mImage' src='images/".$row['image'] ."' class='img-responsive' alt='Default'>           ".$row['Fname']."
        ".$row['Lname']."";
        }

        echo "</a>";
                    ?>
                <?php
            }
          }
        }
        else {
          echo "No user";
        }
}

else {
  $q = "SELECT * FROM Users WHERE Company_ID = '$compID' AND Approved = '1'";

        $myResult = mysqli_query($conn, $q);


        $r = mysqli_query($conn,$q);
        if($r){
          if(mysqli_num_rows($r)>0){
            while($row=mysqli_fetch_assoc($r)){
                ?>
                    <?php echo
        "<a class='mContacts' href='?ID=".$row['ID']."' style='cursor:grab;'>";

        if($row['image'] == "") {
        echo "<img class='mImage' src='images/default.svg' class='img-responsive' alt='Default'>          ".$row['Fname']."
        ".$row['Lname']."";
        }
        else {
        echo "<img class='mImage' src='images/".$row['image'] ."' class='img-responsive' alt='Default'>           ".$row['Fname']."
        ".$row['Lname']."";
        }

        echo "</a>";
                    ?>
                <?php
            }
          }
        }
        else {
          echo "No user";
        }
      }
      mysqli_close($conn);

?>

</div>

<?php


?>
