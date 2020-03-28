<?php
include_once 'db.php';
session_start();
if (!$conn) {
    die("Connection failed: " . mysqli_error());
}
$compID = $_SESSION['companyID'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css">
        <title>Employees</title>

    </head>
    <body>
      <?php
      include 'nav.php';
      ?>
        <h1 class="header-h1">Employees</h1>

        <section class="php">
        <script type="text/javascript">
              function editButton(edit){

            if (document.getElementById('edit').checked){
                document.getElementById("employee").style.display = "none";
                document.getElementById("nonemployee").style.display = "block";

            }
            else{
                document.getElementById("employee").style.display = "block";
                document.getElementById("nonemployee").style.display = "none";

            }
        }
        </script>
            <label class="switch">
    <input name="edit"  id="edit" type="checkbox" onclick="editButton(this)" unchecked>
    <span class="slider round"></span>
    </input>
    </label>
        <div id="leftbox">


        <div id="employee">
        <table>
            <tr>
        <th><h2 class="Theader">List of employees</h2></th>
        <th><h2 class="Theader">Position</h2></th>
        <th><h2 class="Theader">Wage</h2></th>
        </tr>
        <?php

        $sql = "SELECT * FROM Users JOIN Employees ON Users.ID = Employees.Emp_ID WHERE Employees.Company_ID = $compID";
        $result = mysqli_query($conn, $sql);
        if($result){
        while($row = mysqli_fetch_row($result)) {
            echo '<tr>';

            echo "<th>" . $row[2] ." ". $row[3] . "</th>";
            echo "<th>" . $row[14] . "</th>";
            echo "<th>" . $row[15] . "</th>";

            echo "</tr>";
       }
    }
    echo "</table>";
     ?>

        </div>
<div id="nonemployee" style="display: none;">

<table>
            <tr>
        <th><h2 class="Theader">List of employees</h2></th>
        <th><h2 class="Theader">Position</h2></th>
        <th><h2 class="Theader">Wage</h2></th>
        <th><h2 class="Theader">Edit</h2></th>

        </tr>
<?php
        $sql = "SELECT * FROM Users JOIN Employees ON Users.ID = Employees.Emp_ID WHERE Employees.Company_ID = $compID";
        $result = mysqli_query($conn, $sql);
        if($result){
        while($row = mysqli_fetch_row($result)) {
            echo '<form>';
            echo '<tr>';
            echo "<th>" . $row[2] ." ". $row[3] . "</th>";
            echo "<th>" . $row[14] . "<input name='position'type='text'>" ."</th>";
            echo "<th>" . $row[15] . "<input name='wage'type='number'>" . "</th>";
            echo "<th>" . '<input type="submit" name="submit" value=' ."$row[0]" .'>' . "</th>";

            echo "</tr>";
            echo '</form>';

       }
    }
     ?>
          </table>

     </div>
</div>
          <?php
if(isset($_GET['submit'])){
    $UsrID = $_GET['submit'];

    $position = $_GET['position'];
    $wage = $_GET['wage'];


    if(($position != '')){
    $sql = "UPDATE `Employees` SET `Position` = '$position' WHERE Emp_ID = '$UsrID'";
    mysqli_query($conn,$sql);
    }
    if(($wage != '')){
        $sql = "UPDATE `Employees` SET `Wage` = '$wage' WHERE Emp_ID = '$UsrID'";
        mysqli_query($conn,$sql);
    }
?>
    <script type="text/javascript">
    window.location.href = 'http://localhost/Man-A-Biz/app/Employees.php';
    </script>
    <?php
}

            include 'footer.php';
          ?>

        </section>
    </body>
</html>
