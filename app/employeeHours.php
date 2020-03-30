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
        <title>Employee Hours</title>
    </head>
    <body>
      <?php
      include 'nav.php';
      ?>
      <h1 class="header-h1">Employee Hours</h1>

        <div class="php">
          <?php
              $userQuery = "SELECT Emp_ID, FName, LName, Employee_Hours, Wages FROM `Users` JOIN `Employee_Access` WHERE Approved=TRUE ORDER BY Emp_ID DESC";
              $userResult = mysqli_query($conn, $userQuery);
              $i = 1; // counter for checkboxes
              echo "<h2>Employee Hours</h2>";
              echo "<table class='content-table'>
                  <thead>
                  <tr>
                      <th>ID</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Total Hours</th>
                      <th>Wages</th>
                  </tr>
                  </thead>";
                  while ($row = mysqli_fetch_array($userResult)) {
                      echo "<tbody>";
                      echo "<tr>";
                          echo "<td name='id'>" . $row['ID'] . "</td>";
                          echo "<td name='fname'>" . $row['FName'] . "</td>";
                          echo "<td name='lname'>" . $row['LName'] . "</td>";
                          echo "<td name='role'>" . $row['Employee_Hours'] . "</td>";
                          echo "<td name='Wages>" . $row['Wages'] . "</td>";
                          echo "<td><input type='checkbox' name='check[$i]' value='".$row['ID']."'</td>";
                      echo "</tr>";
                      $i++;
                  }
                  echo "</tbody>";
              echo "</table>";

              include 'footer.php';
          ?>
        </div>
    </body>
</html>
