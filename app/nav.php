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
          echo "<li><a href=\"/Man-A-Biz/app/employeeApproval.php\"> Employee Approval</a></li>";
          echo "<li><a href=\"/Man-A-Biz/app/employeeHours.php\"> Employee Hours</a></li>";
        }
        echo "<li><a class='logout' href='/Man-A-Biz/app/logout.php'>Logout</a></li>"
     ?>
  </ul>
</nav>
</header>
