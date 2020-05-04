<?php
include_once 'db.php';
if (!$conn) {
    die("Connection failed: " . mysqli_error());
}
if (!isset($_SESSION)){
    session_start();
  }if($_SESSION['loggedIn'] != TRUE){
    header('Location: index.php');
  }
  if($_SESSION['Authorization'] != 'Admin' & $_SESSION['Authorization'] != 'Secretary' & $_SESSION['Authorization'] != 'Manager'){
    header('Location: myprofile.php');
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

                if (isset($_POST['submit'])) {
                    $hours = $_POST['hours'];
                    $insertHours = "INSERT INTO 'Employee_Access' (Employee_Hours) VALUES ('$hours')";
                    if (mysqli_query($conn, $insertHours)) {
                        echo "You have entered hours.";
                    } else {
                        echo "Something went wrong." . mysqli_error($conn);
                    }
                }

                $userQuery = "SELECT Emp_ID, FName, LName, Employee_Access.Wages FROM `Users` JOIN `Employee_Access`";
                $userResult = mysqli_query($conn, $userQuery);
                $i = 1; // counter for checkboxes
                echo "<h2>Employee Hours</h2>";
                echo "<form action='employeeHours.php' method='POST'>";
                    echo "<table class='content-table'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Total Hours</th>
                                    <th>Wages</th>
                                    <th>✅</th>
                                </tr>
                            </thead>";
                        while ($row = mysqli_fetch_array($userResult)) {
                            $ID = $row['ID'];
                            $fname = $row['FName'];
                            $lname = $row['LName'];
                            $wages = $row['Wages'];
                            $employeehours = $row['Employee_Hours'];
                            echo "<tbody>";
                            echo "<tr>";
                                echo "<td name='id'>" . $ID . "</td>";
                                echo "<td name='fname'>" . $fname . "</td>";
                                echo "<td name='lname'>" . $lname . "</td>";
                                echo "<td name='hours'><input type='text' name='hours' placeholder='".$employeehours."'/></td>";
                                echo "<td name='Wages>" . $wages . "</td>";
                                echo "<td><input type='checkbox' name='check[$i]' value='".$ID."'</td>";
                            echo "</tr>";
                            $i++;
                        }
                        echo "</tbody>";
                    echo "</table>";
                    echo "<input type='submit' name='submit' value='Submit Hours'/>";
                echo "</form>";
                include 'footer.php';
          ?>
        </div>
    </body>
</html>
