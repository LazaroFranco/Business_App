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
    <p>750 E King St</p>
    <p>Lancaster, PA 17602</p>
    <p><a href="tel:1-717-299-7701" class="phone">717.299.7701</a></p>
  </address>
</footer>
