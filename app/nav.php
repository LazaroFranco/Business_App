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

<div class="row">
  <div class="column">
    <h2 class="header-h2">Man-A-Biz</h2>
  </div>
  <div class="column">
    <?php
    echo "<h1>". $_SESSION['Business_Name'].
     "</h1>";
     ?>
  </div>
  <div class="column">
    <?php
        echo "<li><a class='logout' href='/Man-A-Biz/app/logout.php'>Logout</a></li>"
    ?>
  </div>
</div>

<header>
  <nav>
  <ul>
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
          echo "<li><a href=\"/Man-A-Biz/app/profile.php\">My Profile</a></li>";
          echo "<li><a href=\"/Man-A-Biz/app/employeeApproval.php\"> Employee Approval</a></li>";
          echo "<li><a href=\"/Man-A-Biz/app/employeeHours.php\"> Employee Hours</a></li>";
          echo "<li><a href=\"/Man-A-Biz/app/employees.php\">Employee List</a></li>";
          echo "<li><a href=\"/Man-A-Biz/app/Schedule.php\"> Employee Schedule</a></li>";
          echo "<li><a href=\"/Man-A-Biz/app/vacationRequests.php\"> Vacation Requests</a></li>";
        }

     ?>
  </ul>
</nav>
</header>
