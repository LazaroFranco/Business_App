<?php
  include_once 'db.php';
  session_start();
  if($_SESSION['loggedIn'] != TRUE){
      header('Location: myprofile.php');
    }  if (!$conn) {
  	die("Connection failed: " . mysqli_error());
  }
  if(isset($_POST['upload'])) {
  	move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name']);
    $q= "UPDATE Users SET image = '".$_FILES['file']['name']."'
    WHERE
    Users.Fname = '".$_SESSION['Fname']."'
    AND
    Users.Lname = '".$_SESSION['Lname']."'
    AND
    Users.DoB = '".$_SESSION['DoB']."'
    ";
    $qResult = mysqli_query($conn, $q);
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
        Users.Fname = '".$_SESSION['Fname']."'
        AND
        Users.Lname = '".$_SESSION['Lname']."'
        AND
        Users.DoB = '".$_SESSION['DoB']."'
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
echo "<h1 class='header-h1'>". $_SESSION['Fname']. " " . $_SESSION['Lname'] .
"</h1>"
?>
            </div>
            <div class="profile-sidebar">
              <!-- SIDEBAR USERPIC -->
              <div class="profile-userpic">
                <?php
                while ($row = mysqli_fetch_array($userResult)) {
                if($row['image'] == ""){
                echo "<img src='images/default.svg' class='img-responsive' alt='Default'>";
                }
                else {
                echo "<img src='images/".$row['image'] ."' class='img-responsive' alt='Default'>"
                ;
                }
                echo "<br>";
                }
                ?>
              </div>
              <!-- END SIDEBAR USERPIC -->
              <!-- SIDEBAR USER TITLE -->
              <div class="profile-usertitle-job">
                <?php echo $_SESSION['position'] ?>
              </div>
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
                  <a onclick ="pv_show()" href="#private-information">
                    <i class="glyphicon glyphicon-lock">
                    </i>
                    Private Information
                  </a>
                </li>
                <li>
                  <a id="popup" onclick="div_show()" href="#account-settings">
                    <i class="glyphicon glyphicon-user">
                    </i>
                    Account Settings
                  </a>
                </li>
                <li>
                  <a href="#tasks" target="_blank">
                    <i class="glyphicon glyphicon-ok">
                    </i>
                    Tasks
                  </a>
                </li>
              </ul>
            </div>
            <!-- END MENU -->
          </div>
        </div>
        <div class="col-md-9">
          <div id="pv" class="profile-content" style="display:none;">
            <table class="table">
              <h2>Your Information To The Company (Private)</h2>
              <tbody>
              <tr>
                <td>Age:
                </td>
                <td>
                  <?php echo $_SESSION['DoB'] ?>
                </td>
              </tr>
              <tr>
                <td>Email:
                </td>
                <td>
                  <?php echo $_SESSION['email'] ?>
                </td>
              </tr>
              <tr>
                <td>Phone:
                </td>
                <td>
                  <?php echo $_SESSION['Phone'] ?>
                </td>
              </tr>
              <tr>
                <td>Company Code:
                </td>
                <td>
                  <?php echo $_SESSION['CompanyCode'] ?>
                </td>
              </tr>
            </tbody>
            </table>
          </div>
          </

            <div class="col-md-9">
              <div id="ov" class="profile-content">
                <button onClick="window.location.reload();">Refresh Data</button>
              <table class="table">

                <h2>Public Profile</h2>

              <tbody>
              <tr>
                <td>Name: </td>
                <td>
                  <?php
                   echo "<p>". $_SESSION['Fname']. " " . $_SESSION['Lname'] . "</p>"?>
                </td>
              </tr>
              <tr>
                <td>Email:
                </td>
                <td>
                  <?php echo $_SESSION['email'] ?>
                </td>
              </tr>
              <tr>
                <td>Phone:
                </td>
                <td>
                  <?php echo $_SESSION['Phone'] ?>
                </td>
              </tr>
              <tr>
                <td>Company Code:
                </td>
                <td>
                  <?php echo $_SESSION['CompanyCode'] ?>
                </td>
              </tr>
            </tbody>
            </table>

            <tr>
              <td>
                <?php
                $userQuery = "SELECT * FROM Users WHERE     Fname = '".$_SESSION['Fname']."'";
;

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
          <div id="abc" style="display:none;">
            <!-- Popup Div Starts Here -->
            <div id="popupSettings">
              <form action="" enctype="multipart/form-data" id="form" method="post" name="form">
                <h2>Account Settings</h2>
                <label>Update Profile Picture
                  <input type="file" name="file">
                </label>
                <br>
                <input type="submit" name="upload" value="Upload" id="upload">
                </input>
              </form>

              <form action="" id="form" method="POST" name="form">
                <br>
                <label for="Email">Email: </label><input class="" type="text" value="<?php echo $_SESSION['email']; ?>" name="Email">
                <br>
                <label for="Phone" class="">Phone (Format: 000-000-0000): </label>
                <input class="" type="tel" value="<?php echo $_SESSION['Phone']; ?>" name="Phone" pattern="[[0-9]{3}-[0-9]{3}-[0-9]{4}">
                <br>
                <label for="bio">Biography: </label>
                <br>
                  <textarea id="froala-editor" name="bio" value="<?php echo $row['bio']; ?>" rows="10" cols="30"></textarea>
                <br>
                <input value="Submit" type="submit" name="submit" id="submit">
              </input>
              <br>
              <a onclick="ov_show()" href="#">
                Close Settings
              </a>
              <?php
                if(isset($_POST['submit'])) {
                  $email = $_POST['Email'];
                  $phone = $_POST['Phone'];
                  $bio= $_POST['bio'];

                  $sql= "UPDATE Users SET Users.Email='$email', Users.Phone='$phone', Users.bio='$bio'
                  WHERE
                  Users.Fname = '".$_SESSION['Fname']."'
                  AND
                  Users.Lname = '".$_SESSION['Lname']."'
                  AND
                  Users.DoB = '".$_SESSION['DoB']."'
                  ";

                mysqli_query($conn, $sql);


              }

              ?>
              </form>

          </div>
        </div>
        <div id="tasks">
                <?php

                ?>

        </div>
      </div>
    </section>
    <script>
      // Validating Empty Field
      //Function To Display Popup
      function div_show() {
        document.getElementById('abc').style.display = "block";
        document.getElementById('ov').style.display = "none";
        document.getElementById('pv').style.display = "none";
      }
      //Function to Hide Popup
      function div_hide(){
        document.getElementById('abc').style.display = "none";
        document.getElementById('pv').style.display = "none";
        document.getElementById('ov').style.display = "none";
      }
      function pv_show() {
        document.getElementById('pv').style.display = "block";
        document.getElementById('abc').style.display = "none";
        document.getElementById('ov').style.display = "none";
      }
      function ov_show() {
        document.getElementById('ov').style.display = "block";
        document.getElementById('abc').style.display = "none";
        document.getElementById('pv').style.display = "none";
      }


      function refreshPage(){
}
    </script>

  </body>

</html>
<?php
include 'footer.php';
 ?>
