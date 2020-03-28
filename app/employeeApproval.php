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

    </body>
</html>

<?php
    include 'nav.php';
    echo "<h1 class='header-h1'>Employee Approval</h1>";
    $userQuery = "SELECT ID, Fname, Lname, Type_Of_User FROM Users Where Approved=FALSE ORDER BY ID DESC";
    $userResult = mysqli_query($conn, $userQuery);
    $i = 1; // counter for checkboxes
    echo "<form action='' method='POST'>";
        echo "<h2>Registered Users</h2>";
        echo "<table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Role</th>
            </tr>";
            while ($row = mysqli_fetch_array($userResult)) {
                echo "<tr>";
                    echo "<td name='id'>" . $row['ID'] . "</td>";
                    echo "<td name='fname'>" . $row['Fname'] . "</td>";
                    echo "<td name='lname'>" . $row['Lname'] . "</td>";
                    echo "<td name='role'>" . $row['Type_Of_User'] . "</td>";
                    echo "<td><input type='checkbox' name='check[$i]' value='".$row['ID']."'</td>";
                echo "</tr>";
                $i++;
            }
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
    mysqli_close($conn);

    include 'footer.php';
?>
