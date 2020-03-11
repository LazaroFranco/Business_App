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
<nav>
  <ul>
    <li><a class="bluebox" href="/Man-A-Biz/app/logout.php">Logout</a></li>

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
        }
        }
     ?>
  </ul>
</nav>
