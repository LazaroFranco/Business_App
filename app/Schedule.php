<?php
include_once 'db.php';
if (!isset($_SESSION)){
  session_start();
}  if($_SESSION['loggedIn'] != TRUE){
      header('Location: index.php');
    }if (!$conn) {
    die("Connection failed: " . mysqli_error());
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css">
        <title>Schedule</title>

    </head>
    <body>
      <?php
      include 'nav.php';
      ?>
        <div class="bg" ></div>
        <h1 class="header-h1">Schedule</h1>

        <section class="php">
          <?php
              // INSERT YOUR QUERIES HERE!!
              echo "<h1>INSERT YOUR QUERY</h1>";

            include 'footer.php';
          ?>

        </section>
    </body>
</html>
