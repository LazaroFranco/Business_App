<?php
include_once '../db.php';
session_start();
if (!$conn) {
  die("Connection failed: " . mysqli_error());
}

  if(isset($_POST['user'])) {
    $q = 'SELECT * FROM Users
          WHERE Users.Fname="'.$_POST['user'].'"
          OR Users.ID="'.$_POST['user'].'"
          OR Users.Lname="'.$_POST['user'].'"
          '  ;

    $r = mysqli_query($conn, $q);
    if($r) {
      if(mysqli_num_rows($r)>0){
        while($row = mysqli_fetch_assoc($r)) {
          echo "<select>";
          echo "<option value='".$row['ID']."'>". $row['Fname']. " " . $row['Lname'] .
          "</option>";
          echo "</select>";
        }
      }
      else {
        echo "<option value='no user'>";
      }
    }
  }
  mysqli_close($conn);

?>
