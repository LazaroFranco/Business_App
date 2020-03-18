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
        <title>Vacation Request</title>
    </head>
    <body>
        <div class="bg" ></div>
        <h1 class="header-h1">Company Name</h1>
        <h2 class="header-h1">Vacation Request Form</h1>

        <form action="vacationRequests.php" name="vacReq" method="POST">
            <label>Current Date:</label><input type="date" name="date"/><br>
            <label>Employee First Name:</label><input type="text" name="fname"/><br>
            <label>Employee Last Name:</label><input type="text" name="lname"/><br>
            <label>Type of Request (Vacation/Sick):</label><input type="text" name="typeOfReq"/><br>
            <label>Paid</label><input type="checkbox" name="paid"/><label>Unpaid</label><input type="checkbox" name="unpaid"/><br>
            <label>Comments:</label><input type="text" name="comments"/><br>
            <label>Start Date:</label><input type="date" name="startDate"/><br>
            <label>End Date:</label><input type="date" name="endDate"/><br>
            <input type="submit" name="submit" value="Submit Request">
        </form>
    </body>
</html>
