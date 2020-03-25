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
            <label>Today's Date:</label><input type="date" name="todayDate"/><br>
            <label>Employee First Name:</label><input type="text" name="fname"/><br>
            <label>Employee Last Name:</label><input type="text" name="lname"/><br>
            <label>Type of Request (Vacation/Sick):</label><input type="text" name="typeOfReq"/><br>
            <label>Paid/Unpaid </label><input type="text" name="paidStatus"/><br>
            <label>Comments:</label><input type="text" name="comments"/><br>
            <label>Start Date:</label><input type="date" name="startDate"/><br>
            <label>End Date:</label><input type="date" name="endDate"/><br>
            <input type="submit" name="submit" value="Submit Request">
        </form>

        <input type="submit" name="vacReqForms" value="View Employee Requests">
    </body>
</html>

<?php
    if (isset($_POST['vacReqForms'])) {
        $getRequestList = "SELECT * FROM Vac_Req_Form WHERE Approved=0";
        $resultList = mysqli_query($conn, $getRequestList);
        $resultListCheck = mysqli_num_rows($resultList);
        if ($resultListCheck > 0) {
            echo "
                    <h1>Employee Requests for Time Off</h1>
                    <tr>
                        <th>Submission Date</th>
                        <th>Employee Name</th>
                        <th>Type of Request</th>
                        <th>Paid Status</th>
                        <th>Comments</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>
                ";
            $i = 1;
            while ($row = mysqli_fetch_assoc($resultList)) {
                echo "
                    <tr>
                        <td>" . $row['Today_Date'] . "</td>
                        <td>" . $row['Fname'] . ' ' . $row['Lname'] . "</td>
                        <td>" . $row['Type_of_Request'] . "</td>
                        <td>" . $row['Comments'] . "</td>
                        <td>" . $row['Start_Date_Requested'] . "</td>
                        <td>" . $row['End_Date_Requested'] . "</td>
                    </tr>
                ";
                
            }
        }
    }
//if (isset($_GET['login'])) {
    if (isset($_POST['submit'])) {
        $todayDate = $_POST['todayDate'];
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $typeOfRequest = $_POST['typeOfReq'];
        $paid = $_POST['paidStatus'];
        $comments = $_POST['comments'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        if (($todayDate != '') && ($firstName != '') && ($lastName != '') && ($typeOfRequest != '') && ($paid != '') && ($startDate != '') && ($endDate != '')) {
            if ($paid == "paid") {
                $paid = 1;
            } else if ($paid == "unpaid") {
                $paid = 0;
            }

            $currentDate = date('d-m-Y', strtotime(str_replace('-', '/', $todayDate)));
            $startDate = date('d-m-Y', strtotime(str_replace('-', '/', $startDate)));
            $endDate = date('d-m-Y', strtotime(str_replace('-', '/', $endDate)));

            $getUserData = "SELECT ID, Company_ID FROM `Users` WHERE Fname='$firstName' AND Lname='$lastName'";
            $result = mysqli_query($conn, $getUserData);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $user_ID = $row['ID'];
                    $company_ID = $row['Company_ID'];
                }
                $insertVacRequest = "INSERT INTO `Vac_Req_Form` (Company_ID, Employee_ID, Today_Date, Fname, Lname, Type_of_Request, Paid, Comments, Start_Date_Requested, End_Date_Requested, Approved)
                                     VALUES ('$company_ID', '$user_ID', '$todayDate', '$firstName', '$lastName', '$typeOfRequest', '$paid', '$comments', '$startDate', '$endDate', 0)";
                if (mysqli_query($conn, $insertVacRequest)) {
                    echo "You have submitted a request for time off.";
                } else {
                    echo "Error with submitting request." . mysqli_error($conn);
                }
            }
        }
    }
//}

?>