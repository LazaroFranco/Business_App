<?php
  include_once 'db.php';
  session_start();
  if($_SESSION['loggedIn'] != TRUE){
      header('Location: index.php');
    }  if (!$conn) {
  	die("Connection failed: " . mysqli_error());
  }

  $ID = isset($_REQUEST['ID'])?$_REQUEST['ID']:'';

  if ($ID == $_SESSION['ID']) {
    header( 'Location: myprofile.php');
  }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js">
    </script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profile.css">
    <title>My Profile
    </title>
  </head>
  <body>
    <section>
      <?php
		include 'nav.php';
        $userQuery = "SELECT * FROM `Users` WHERE
        ID='$ID'
        ";
        $userResult = mysqli_query($conn, $userQuery);
        $i = 1; // counter for checkboxes
      ?>
    </section>
    <section>
      <div class="row">
        <div class="col-md-3">
          <div class="profile-usertitle">
            <div class="profile-usertitle-name">
              <?php

              while ($row = mysqli_fetch_array($userResult)) {
echo "<h1 class='header-h1'>". $row['Fname']. " " . $row['Lname'] .
"</h1>";

?>
            </div>
            <div class="profile-sidebar">
              <!-- SIDEBAR USERPIC -->
              <div class="profile-userpic">
                <?php
                if($row['image'] == ""){
                echo "<img src='images/default.svg' class='img-responsive' alt='Default'>";
                }
                else {
                echo "<img src='images/".$row['image'] ."' class='img-responsive' alt='Default'>"
                ;
                }
                echo "<br>";
                echo "<div class='profile-usertitle-job'>

                 ".$row['position']."
                 </div>
                ";
                }
                ?>
              </div>
              <!-- END SIDEBAR USERPIC -->
            </div>
            <div class="profile-usermenu">
              <ul class="nav">
                <li class="active">
                  <a onclick ="ov_show()" href="#overview">
                    <i class="glyphicon glyphicon-home">
                    </i>
                    Overview
                  </a>
                </li>
                <li>
                  <a href="#tasks" target="_blank">
                    <i class="glyphicon glyphicon-ok">
                    </i>
                    Tasks
                  </a>
                </li>
                <li>
                  <div>
                    <a style='cursor:grab; text-decoration: none;' href="#message-box" onclick="pm_show()" id="submit">Message</a>
                  </div>
                </li>
              </ul>
            </div>
            <!-- END MENU -->
          </div>
        </div>
        <div class="col-md-9">
          </

            <div class="col-md-9">
              <div id="ov" class="profile-content">
              <table class="table">

                <h2>Public Profile</h2>

              <tbody>
              <tr>
                <td>Name: </td>
                <td>
                   <?php
                   $userQuery = "SELECT * FROM Users WHERE  ID = '$ID'";

                   $userResult = mysqli_query($conn, $userQuery);
                   $i = 1; // counter for checkboxes

                   while ($row = mysqli_fetch_array($userResult)) {

                    echo "<p>". $row['Fname']. " " . $row['Lname'] . "</p>";
                  }
                     ?>
                </td>
              </tr>
              <tr>
                <td>Email:
                </td>
                <td>
                  <?php
                  $userQuery = "SELECT * FROM Users WHERE  ID = '$ID'";

                  $userResult = mysqli_query($conn, $userQuery);
                  $i = 1; // counter for checkboxes

                  while ($row = mysqli_fetch_array($userResult)) {

                    echo $row['Email'];
                }
                    ?>
                </td>
              </tr>
              <tr>
                <td>Phone:
                </td>
                <td>
                  <?php
                  $userQuery = "SELECT * FROM Users WHERE   ID = '$ID'";

                  $userResult = mysqli_query($conn, $userQuery);
                  $i = 1; // counter for checkboxes

                  while ($row = mysqli_fetch_array($userResult)) {

                   echo $row['Phone'];
                 }
                    ?>
                </td>
              </tr>
              <tr>
                <td>Company Code:
                </td>
                <td>
                  <?php
                  $userQuery = "SELECT * FROM Users WHERE   ID = '$ID'";


                  $userResult = mysqli_query($conn, $userQuery);
                  $i = 1; // counter for checkboxes

                  while ($row = mysqli_fetch_array($userResult)) {

                   echo $row['Company_Code'];
                 }
                    ?>
                </td>
              </tr>
            </tbody>
            </table>


            <tr>
              <td>
                <?php
                $userQuery = "SELECT * FROM Users WHERE     ID = '$ID'";

                $userResult = mysqli_query($conn, $userQuery);
                $i = 1; // counter for checkboxes

                while ($row = mysqli_fetch_array($userResult)) {
                 if(empty($row['bio'])) {
                   echo "<p class='me'>
                          <h2>" . $row['Fname'] . "'s Biography" ."</h2>
                           <p class='me'>I'm originally from a small country called New Zealand where we all have pet sheep and watch soccer every day of the week. I grew up in a small town but moved over to the UK a few years ago and I'm now living in the countryside in Ireland.
                           </p>
                         </p>";
                 } else {
                   echo "<p class='me'>";
                    echo "<h2>" . $row['Fname'] . "'s Biography" ."</h2>";
                          echo "<p>".$row['bio']."</p>";
                         echo"</p>";
                       }
                  $i++;
                }
                ?>
              </td>
            </tr>
            <div>
            <?php
            while ($row = mysqli_fetch_array($userResult)) {
              if(empty($row['bio'])){
              echo "<p class='me'>
                    <h2>More about me</h2>
                      <p class='me'>I'm originally from a small country called New Zealand where we all have pet sheep and watch soccer every day of the week. I grew up in a small town but moved over to the UK a few years ago and I'm now living in the countryside in Ireland.
                      </p>
                    </p>";
              } else {
                  echo "
                          <h2>More About Me</h2>
                          " . $row['bio'] . "
                  ";
                }
              }
           ?>
         </div>
          </div>
        <div id="tasks">
                <?php

                ?>
        </div>
        <div style="display:none;" id="message-box">
          <?php include 'message-system/right-col.php' ?>
        </div>
  </div>

      </div>
    </section>
    <script>
      // Validating Empty Field
      //Function To Display Popup
      function ov_show() {
        document.getElementById('ov').style.display = "block";
        document.getElementById('message-box').style.display = "none";

      }
      function pm_show() {
        document.getElementById('message-box').style.display = "block";
        document.getElementById('ov').style.display = "none";
        var rightContainer = document.getElementById("messages-container");
        rightContainer.scrollTop = rightContainer.scrollHeight;
      }


    </script>

  </body>

</html>
<?php
include 'footer.php';
 ?>
