<?php
//include './nav.php';
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
        <title>Employee Registration Approval</title>
    </head>
    <body>

      <?php
          include 'nav.php';
          echo "<h1 class='header-h1'>Employee Approval</h1>";
          $userQuery = "SELECT ID, position, Fname, image, Lname, Type_Of_User FROM Users Where Approved=FALSE ORDER BY ID DESC";
          $userResult = mysqli_query($conn, $userQuery);
          $i = 1; // counter for checkboxes
          echo "<form action='' method='POST'>";
              echo "<h2>Registered Users</h2>";
              echo "<table class='content-table'>
                  <thead>
                  <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Role</th>
                      <th>Position</th>
                      <th>✅</th>
                  </tr>
                  </thead>";
                  while ($row = mysqli_fetch_array($userResult)) {
                      echo "<tbody>";
                      echo "<tr>";
                          echo "<td name='id'>" . $row['ID'] . "</td>";
                          if($row['image'] == ""){
                          echo "<td><img class='eap' src='images/default.svg' class='img-responsive' alt='Default'></td>";
                          }
                          else {
                          echo "<td><img class='eap' src='images/".$row['image'] ."' class='img-responsive' alt='Default'></td>"
                          ;
                          }
                          echo "<td name='fname'>" . $row['Fname'] . "</td>";
                          echo "<td name='lname'>" . $row['Lname'] . "</td>";
                          echo "<td name='role'>" . $row['Type_Of_User'] . "</td>";
                          echo "<td name='position'>" . $row['position'] . "</td>";
                          echo "<td><input type='checkbox' name='check[$i]' value='".$row['ID']."'</td>";
                      echo "</tr>";
                      $i++;
                  }
              echo "</tbody>";
              echo "</table>";
              echo "<input type='submit' name='approve' value='Approve'/>";
              echo "<input type='submit' name='remove' value='Remove'/>";
          echo "</form>";

          if(isset($_POST['approve'])) {
              if (isset($_POST['check'])) {
                  foreach ($_POST['check'] as $value) {
                      $update = "UPDATE Users SET Approved=TRUE WHERE ID='$value'";
                      mysqli_query($conn, $update);
                  }
              }
              header('Location: employeeApproval.php');
          }

          if (isset($_POST['remove'])) {
              if (isset($_POST['check'])) {
                  foreach ($_POST['check'] as $value) {
                      $update = "DELETE FROM Users WHERE ID='$value'";
                      mysqli_query($conn, $update);
                  }
              }
              header('Location: employeeApproval.php');
          }
      ?>


      <div id="rowmargin" class="row">
        <div class="column">
          <div class="boxx">
            <h3>Denied Number Of Users</h3>
            <?php
              $userQuery = "SELECT COUNT(*)
              AS NumberofUsers
              FROM Users
              WHERE Users.Approved = 0;";
              $userResult = mysqli_query($conn, $userQuery);
              while ($row = mysqli_fetch_array($userResult)) {
                echo "<div id='denied' class='loader'>";
                echo "<h1>" .$row['NumberofUsers']."</h1>";
                echo "</div> ";
            }
            ?>
          </div>
        </div>
        <div class="column">
          <div class="boxx">
            <h3>Approved Number Of Users</h3>
            <?php
              $userQuery = "SELECT COUNT(*)
              AS NumberofUsers
              FROM Users
              WHERE Users.Approved = 1;";
              $userResult = mysqli_query($conn, $userQuery);
              while ($row = mysqli_fetch_array($userResult)) {
              echo "<div id='approved' class='loader'>";
              echo "<h1>" .$row['NumberofUsers']."</h1>";
              echo "</div> ";
            }
            ?>
          </div>
        </div>
        <div class="column">

<<<<<<< HEAD
    /*echo "<footer>
            <h2 class='footer-h1'>Man-A-Biz</h2>
            <address>
                <p>750 E King St</p>
                <p>Lancaster, PA 17602</p>
                <p><a href='tel:1-717-299-7701' class='phone'>717.299.7701</a></p>
            </address>
        </footer>";
        */
?>
=======
          <div class="boxx">
              <h3>Total Number Of Users</h3>
              <?php
                $userQuery = "SELECT COUNT(*) AS NumberofUsers FROM Users";
                $userResult = mysqli_query($conn, $userQuery);
                while ($row = mysqli_fetch_array($userResult)) {
                  echo "<div id='total' class='loader'>";
                  echo "<h1>" .$row['NumberofUsers']."</h1>";
                  echo "</div> ";
              }
              ?>
          </div>
        </div>
      </div>
    </body>
<?php
include 'footer.php';

 ?>
</html>
>>>>>>> 6b42498c9f664167d0356adc855dfab12c6dd16d
