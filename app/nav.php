<?php
$currentFileInfo = pathinfo(__FILE__);
$requestInfo = pathinfo($_SERVER['REQUEST_URI']);
if($currentFileInfo['basename'] == $requestInfo['basename']){
  die();
}
if (!isset($_SESSION)){
  session_start();
}
?>
<link rel="stylesheet" href="style.css">

<div class="row" id="headerrow">
  <div class="column">
    <button class="openbtn" onclick="openNav()">&#9776;</button>
        <a class="openbtn-users" id="openbtn-users" onclick="openNavUsers()">View Your Team</a>
  </div>
  <div class="column">
    <?php
    echo "<h1 class='header-bn'>". $_SESSION['Business_Name'].
     "</h1>";
     ?>
  </div>
  <div class="column">
    <h2 class="header-h2" id="manabiz">Man-A-Biz</h2>
  </div>
</div>

<header>
  <nav>
    <ul id="mySidebar-users" class="sidebar">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNavUsers()">&times;</a>
      <?php
      echo "<h1 class='usersh1'>Your Team</h1>";
      $userQuery = mysqli_query($conn, "SELECT * FROM Users
      ;");
      $i = 1;
        while ($row =  mysqli_fetch_array($userQuery)) {
            if($row['image'] == ""){
            echo "<li style='margin-top: 1em;'>
            <img class='uimg' src='images/default.svg' class='img-responsive' alt='Default'>
            <a href='profile.php?ID=".$row['ID']."' style='cursor:grab;'>

            "
            .$row['Fname'].
            " "
            .$row['Lname'].
            "<br>"
            .
            "
            </a>
          </li>";
            }
            else {
            echo "<li style='margin-top: 1em;'>
            <img class='uimg' src='images/".$row['image'] ."' class='img-responsive' alt='Default'>

              <a href='profile.php?ID=".$row['ID']."' style='cursor:grab;'>

              "
              .$row['Fname'].
              " "
              .$row['Lname'].
              "<br>"
              .
              "
              </a>
            </li>";
            }
          $i++;
      }
      if (isset($_POST['view_profile'])) {

      }
      ?>
    </ul>
  </nav>

  <nav>
  <ul id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <li>
    <?php
        $role= $_SESSION['role'];
        if ($role == 'admin'){
          echo "<li><a href=\"/Man-A-Biz/app/newpage.php\">New Page</a></li>";
        } else if ($role == 'owner'){
          echo "<li><a href=\"/Man-A-Biz/app/newpage.php\">New Page</a></li>";
        } else if ($role == 'supervisor'){
          echo "<li><a href=\"/Man-A-Biz/app/newpage.php\">New Page</a></li>";
        } else if ($role == 'employee'){
          echo "<li><a href=\"/Man-A-Biz/app/newpage.php\">New Page</a></li>";
        } else {
          echo "<h3><a style='color: white;' href=\"/Man-A-Biz/app/myprofile.php\">
          <img src='images/".$_SESSION['image'] ."' class='img-responsive' alt='Default'>My Profile
          </a></h3>";
          echo "<ul>";
          echo "<li><a href=\"/Man-A-Biz/app/Schedule.php\"> Employee Schedule</a></li>";
          echo "</ul>";
          echo "<h3>Employee Management</h3>";
          echo "<ul>";
          echo "<li><a href=\"/Man-A-Biz/app/employeeApproval.php\"> Employee Approval</a></li>";
          echo "<li><a href=\"/Man-A-Biz/app/employeeHours.php\"> Employee Hours</a></li>";
          echo "<li><a href=\"/Man-A-Biz/app/employees.php\">Employee List</a></li>";

          echo "<li><a href=\"/Man-A-Biz/app/vacationRequests.php\"> Vacation Requests</a></li>";
          echo "</ul>";
          echo "<li><a class='logout' href='/Man-A-Biz/app/logout.php'>Logout</a></li>";
        }

     ?>
   </li>
  </ul>
</nav>
</header>

<script>
/* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";

}

function openNavUsers() {
  document.getElementById("mySidebar-users").style.width = "250px";
}


/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
}

function closeNavUsers() {
  document.getElementById("mySidebar-users").style.width = "0";
}
</script>
