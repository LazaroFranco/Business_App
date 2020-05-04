<?php
//include './nav.php';
include_once 'db.php';
if (!$conn) {
    die("Connection failed: " . mysqli_error());
}
if (!isset($_SESSION)){
  session_start();
}

if($_SESSION['loggedIn'] != TRUE){
    if($_SESSION['email'] != 'Admin'){
  header('Location: index.php');
}}

$userQ = "SELECT COUNT(*) AS NumberofUsers, Approved FROM Users GROUP BY Approved";
$result= mysqli_query($conn, $userQ);

$denied = "SELECT COUNT(*) AS NumberofUsers, Approved FROM Users
WHERE Users.Approved = 0;";
$deniedResult = mysqli_query($conn, $denied);

$approved = "SELECT COUNT(*) AS NumberofUsers, Approved FROM Users
WHERE Users.Approved = 1;";
$approvedResult = mysqli_query($conn, $approved);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var dataTotal = google.visualization.arrayToDataTable([
          ['Users', 'Number'],
          <?php

            while($row = mysqli_fetch_array($result)) {
              echo "['". ($row['Approved'] ? 'Approved' : 'Not Approved') ."', ".$row["NumberofUsers"]."],";
            }
          ?>
          ]);

          var dataApproved = google.visualization.arrayToDataTable([
            ['Users', 'Number'],
            <?php

              while($row = mysqli_fetch_array($approvedResult)) {
                echo "['". ($row['Approved'] ? 'Approved' : 'Not Approved') ."', ".$row["NumberofUsers"]."],";
              }
            ?>
            ]);

            var dataDenied = google.visualization.arrayToDataTable([
              ['Users', 'Number'],
              <?php
                while($row = mysqli_fetch_array($deniedResult)) {
                  echo "['". ($row['Approved'] ? 'Approved' : 'Not Approved') ."', ".$row["NumberofUsers"]."],";
                }
              ?>
              ]);

        var options = {
          title:'Percentage of Approved and Dissaproved Users',
          is3D: true,
          colors: ['lightgrey', '#8B0F3D']
          };
        var chartTotal = new google.visualization.PieChart(document.getElementById('total'));
        chartTotal.draw(dataTotal, options);

        var chartApproved = new google.visualization.PieChart(document.getElementById('approved'));
        chartApproved.draw(dataApproved);

        var chartDenied = new google.visualization.PieChart(document.getElementById('denied'));
        chartDenied.draw(dataDenied);
      };
      </script>
      <link rel="stylesheet" href="style.css">
        <title>Admin</title>
    </head>
    <body>

      <?php
          $comp_id = $_SESSION['companyID'];
          include 'nav.php';
          echo "<h1 class='header-h1'>Employee Approval</h1>";
          $userQuery = "SELECT ID, position, Fname, image, Lname, Type_Of_User FROM Users Where Approved=FALSE  ORDER BY Type_Of_User DESC";
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
              echo "<meta http-equiv='refresh' content='0'>";

          }

          if (isset($_POST['remove'])) {
              if (isset($_POST['check'])) {
                  foreach ($_POST['check'] as $value) {
                      $update = "DELETE FROM Users WHERE ID='$value'";
                      mysqli_query($conn, $update);
                  }
              }
              echo "<meta http-equiv='refresh' content='0'>";
            }
      ?>

      <div class="boxx">

        <div class="row">
          <div class="col-md-10">
            <div style="width:900px; height:500px;" id="total"></div>
          </div>
        </div>
        </div>
    </body>
<?php
include 'footer.php';

 ?>
</html>
