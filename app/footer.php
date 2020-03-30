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

<footer>
  <?php
  echo "<h2 class='footer-h2'>". $_SESSION['Business_Name'].
   "</h2>";
   ?>
  <address>
    <?php
    echo "</p>" . $_SESSION['Business_Address'] ."</p>";
    echo "</p>"
     . $_SESSION['Business_City'] . ", " .
     $_SESSION['Business_State'] .
     "</p>";

    echo "
    <p>
    <a href='".$_SESSION['Business_Phone']." class='phone'>
    ". $_SESSION['Business_Phone'] ."
    </a>
    </p>
    ";
    ?>

  </address>
</footer>
