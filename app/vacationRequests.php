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
            <label>Current Date:</label><input type="date" name="currentDate"/><br>
            <label>Employee First Name:</label><input type="text" name="fname"/><br>
            <label>Employee Last Name:</label><input type="text" name="lname"/><br>
            <label>Type of Request (Vacation/Sick):</label><input type="text" name="typeOfReq"/><br>
            <label>Paid </label><input type="radio" name="paid"/><br>
            <label>Unpaid </label><input type="radio" name="paid"/><br>
            <label>Comments:</label><input type="text" name="comments"/><br>
            <label>Start Date:</label><input type="date" name="startDate"/><br>
            <label>End Date:</label><input type="date" name="endDate"/><br>
            <input type="submit" name="submit" value="Submit Request">
        </form>
    </body>
</html>

<?php
    if (isset($_POST['submit'])) {
        $currentDate = $_POST['currentDate'];
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $typeOfRequest = $_POST['typeOfReq'];
        $paidOrUnpaid = $_POST['paid'];
        $comments = $_POST['comments'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        if (($currentDate != '') && ($firstName != '') && ($lastName != '') && ($typeOfRequest != '') && ($paidOrUnpaid != '') && ($startDate != '') && ($endDate !='')) {
            // NEED TO DEFINE VARIABLE FOR ID AND COMANPY_ID
            $insertRequest = "INSERT INTO `Vac_Req_Form` (ID, Company_ID, Current_Date, Fname, Lname, Type_Of_Request, Paid, Comments, Start_Date_Requested, End_Date_Requested, Approved) VALUES ('$currentDate', '$firstName', '$lastName', '$typeOfRequest', '$paidOrUnpaid', '$comments', '$startDate', '$endDate')";
            if (mysqli_query($conn, $insertRequest)) {
                echo "You have submitted a request for time off.";
            } else {
                echo "Error with submitting request." . mysqli_error($conn);
            }
        }
    }

?>