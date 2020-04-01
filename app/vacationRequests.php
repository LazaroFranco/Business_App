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
        <title>Vacation Request</title>
    </head>
    <body>

    <?php
        include 'nav.php';
    ?>
    <h2 class="header-h1">Vacation Request Form</h1>
      <div class="boxed">
        <form action="vacationRequests.php" class="vrform "name="vacReq" method="POST">
            <label>Today's Date:</label><input type="date" name="todayDate" value="<?php echo date('Y-m-d')?>"/><br>
            <label>Employee First Name:</label><input type="text" name="fname"/><br>
            <label>Employee Last Name:</label><input type="text" name="lname"/><br>
            <section>
              <h2>Type of Request (Vacation/Sick):</h2>
              <label class="vacation">Vacation
                <input type="radio" id="vacation" name="vacType" value="vacation"/>
                </label>
                <br>
              <label>Sick
                <input type="radio" id="sick" name="vacType" value="sick"/>
              </label>
                <br>
             <label>
               <h2>Paid/Unpaid:</h2>
                <label>Paid
                <input type="radio" id="paid" name="paidStatus" value="paid"/>
                </label>
                <br>
                <label>Unpaid
                <input type="radio" id= "unpaid" name="paidStatus" value="unpaid"/>
                </label>
              </label>
            </section>
                <br>
            <label>Comments:</label>
            <input type="text" name="comments"/>
            <br>
            <label>Start Date:</label>
            <input type="date" name="startDate"/>
            <br>
            <label>End Date:</label>
            <input type="date" name="endDate"/>
            <br>
            <input class="vrsubmit" type="submit" name="submit" id="submit" value="Submit Request">
        </form>
        <form action="vacationRequests.php" name="viewReqs" method="POST">
            <input type="submit" id="submit" name="vacReqForms" value="View Employee Requests">
        </form>
      </div>
<?php
//if (isset($_GET['login'])) {
    if (isset($_POST['submit'])) {
        $todayDate = $_POST['todayDate'];
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $typeOfRequest = $_POST['vacType'];
        $paidStatus = $_POST['paidStatus'];
        $comments = $_POST['comments'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        if (($todayDate != '') && ($firstName != '') && ($lastName != '') && ($typeOfRequest != '') && ($paidStatus != '') && ($startDate != '') && ($endDate != '')) {
            if ($typeOfRequest == "vacation") {
                $typeOfRequest = "vacation";
            } else if ($typeOfRequest == "sick") {
                $typeOfRequest = "sick";
            }

            if ($paidStatus == "paid") {
                $paid = 1;
            } else if ($paidStatus == "unpaid") {
                $paid = 0;
            }

            $getUserData = "SELECT ID, Company_ID FROM `Users` WHERE Fname='$firstName' AND Lname='$lastName' AND Approved=0";
            $result = mysqli_query($conn, $getUserData);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $user_ID = $row['ID'];
                    $company_ID = $row['Company_ID'];
                }
                $insertVacRequest = "INSERT INTO `Vac_Req_Form` (Company_ID, Employee_ID, Today_Date, Fname, Lname, Type_of_Request, Paid, Comments, Start_Date_Requested, End_Date_Requested, Approved)
                                     VALUES ('$company_ID', '$user_ID', '$todayDate', '$firstName', '$lastName', '$typeOfRequest', '$paidStatus', '$comments', '$startDate', '$endDate', 0)";
                if (mysqli_query($conn, $insertVacRequest)) {
                    echo "You have submitted a request for time off.";
                } else {
                    echo "Error with submitting request." . mysqli_error($conn);
                }
            }
        }
    }
//}
if (isset($_POST['vacReqForms'])) {
    $getRequestList = mysqli_query($conn, "SELECT * FROM Vac_Req_Form WHERE Approved=0");
    $i = 1;
    echo "<form class='vrform2' action='vacationRequests.php' method='POST'>";
        echo "<h1>Employee Requests for Time Off</h1>";
            echo "<table class='content-table'>";
              echo "<thead>";
                echo "<tr>";
                    echo "<th>Submission Date</th>";
                    echo "<th>Employee Name</th>";
                    echo "<th>Type of Request</th>";
                    echo "<th>Paid Status</th>";
                    echo "<th>Comments</th>";
                    echo "<th>Start Date</th>";
                    echo "<th>End Date</th>";
                    echo "<th>✅</th>";
                echo "</tr>";
              echo "</thead>";

        while ($row = mysqli_fetch_array($getRequestList)) {
          echo "<tbody>";
            echo "<tr>";
                echo "<td>" . $row['Today_Date'] . "</td>";
                echo "<td>" . $row['Fname'] . ' ' . $row['Lname'] . "</td>";
                echo "<td>" . $row['Type_of_Request'] . "</td>";
                echo "<td>" . $row['Paid'] . "</td>";
                echo "<td>" . $row['Comments'] . "</td>";
                echo "<td>" . $row['Start_Date_Requested'] . "</td>";
                echo "<td>" . $row['End_Date_Requested'] . "</td>";
                echo "<td><input type='checkbox' name='check[$i]' value='".$row['ID']."'/></td>";
            echo "</tr>";
            echo "</tbody>";
            $i++;
        }
        echo "</table>";
        echo "<input id='submit' type='submit' name='approve' value='Approve'/>";
        echo "<input id='submit' type='submit' name='deny' value='Deny'/>";
    echo "</form>";

            if (isset($_POST['approve'])) {
                if (isset($_POST['check'])) {
                    foreach ($_POST['check'] as $value) {
                        $approveRequest = "UPDATE `Vac_Req_Form` SET Approved=1 WHERE ID='$value'";
                        mysqli_query($conn, $approveRequest);
                    }
                }
                header('Location: vacationRequests.php');
            }
            if (isset($_POST['deny'])) {
                if (isset($_POST['check'])) {
                    foreach ($_POST['check'] as $value) {
                        $deleteRequest = "DELETE FROM `Vac_Req_Form` WHERE ID='$value'";
                        mysqli_query($conn, $deleteRequest);
                    }
                }
                header('Location: vacationRequests.php');
            }
        }
        include 'footer.php';
        mysqli_close($conn);
        ?>
    </body>
</html>
