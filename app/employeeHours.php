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
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css" type="text/css">
        <title>Employee Hours</title>
    </head>
    <body>
        <div class="bg" ></div>
        <h1 class="header-h1">Company Name</h1>
    </body>
</html>

<?php

    $userQuery = "SELECT ID, Fname, Lname, Employee_Hours, Wages FROM `Users` JOIN `Employee_Access` WHERE Approved=TRUE ORDER BY ID DESC";
    $userResult = mysqli_query($conn, $userQuery);
    $i = 1; // counter for checkboxes
    echo "<h2>Employee Hours</h2>";
    echo "<table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Total Hours</th>
            <th>Wages</th>
        </tr>";
        while ($row = mysqli_fetch_array($userResult)) {
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
    echo "</table>";

    echo "<footer>
            <h2 class='footer-h1'>Man-A-Biz</h2>
            <address>
                <p>750 E King St</p>
                <p>Lancaster, PA 17602</p>
                <p><a href='tel:1-717-299-7701' class='phone'>717.299.7701</a></p>
            </address>
        </footer>";
?>

   
