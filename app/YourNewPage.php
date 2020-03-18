<?php
include_once 'db.php';
if (!$conn) {
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
        <title>Your New Page</title>

    </head>
    <body>

        <div class="bg" ></div>
        <h1 class="header-h1">Your New Page</h1>
        <?php
        include 'nav.php';
        ?>
        <section class="php">
          <?php
              // INSERT YOUR QUERIES HERE!!
              echo "<h1>INSERT YOUR QUERY</h1>";

            include 'footer.php';
          ?>

        </section>
    </body>
</html>
