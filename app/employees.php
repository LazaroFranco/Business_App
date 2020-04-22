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
      <div id="main">

</div>
        <h1 class="header-h1">Employees</h1>

        <div class="row">
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
        <table class="content-table">
          <thead>
            <tr>
        <th>List of employees</th>
        <th>Position</th>
        <th>Wage</th>
        <th>Authorization</th>
      </tr>
    </thead>
        <?php
        $sql = "SELECT * FROM Users JOIN Employees ON Users.ID = Employees.Emp_ID WHERE Employees.Company_ID = $compID AND Users.Approved = '1'";
        $result = mysqli_query($conn, $sql);
        if($result){
        while($row = mysqli_fetch_row($result)) {
          echo '<tbody>';
            echo '<tr>';

            echo "<td>" . $row[2] ." ". $row[3] . "</td>";
            echo "<td>" . $row[17] . "</td>";
            echo "<td>" . $row[18] . "</td>";
            echo "<td>" . $row[19] . "</td>";


            echo "</tr>";
       }
    }
    echo "</tbody>";
    echo "</table>";
     ?>

        </div>
<div id="nonemployee" style="display: none;">

<table class="content-table">
  <thead>
            <tr>
        <th>List of employees</th>
        <th>Position</th>
        <th>Wage</th>
        <th>Authorization</th>
        <th>Edit</th>

        </tr>
      </thead>
<?php
        $sql = "SELECT * FROM Users JOIN Employees ON Users.ID = Employees.Emp_ID WHERE Employees.Company_ID = $compID AND Users.Approved = '1'";
        $result = mysqli_query($conn, $sql);
        if($result){
        while($row = mysqli_fetch_row($result)) {
            echo '<tbody>';
            echo '<tr>';
            echo"<form action='employees.php' name='employees' method='POST'>";
            echo "<td>" . $row[2] ." ". $row[3] . "</td>";
            echo "<td>" . $row[17] . "<input name='position'type='text' placeholder='New Position'>" ."</th>";
            echo "<td>" . $row[18] . "<input name='wage'type='number' placeholder='New Wage'>" . "</td>";
            echo"<td>" . $row[19] . "<select name='auth'>
                <option value=''> </option>
                <option value='Employee'> Employee</option>
                <option value='Manager'>Manager</option>
                <option value='Secretary'>Secretary</option></select>
                </td>";
            echo"<td><button type='submit'> ✅ </button></td>";

            echo'<input type="hidden" name="submit" value=' ."$row[0]" .'>';
            echo "</tr>";
            echo "</tbody>";
            echo '</form>';

       }
    }
     ?>
          </table>
     </div>
</div>
          <?php
if(isset($_POST['submit'])){
    $UsrID = $_POST['submit'];

    $position = $_POST['position'];
    $wage = $_POST['wage'];
    $auth = $_POST['auth'];


    if(($position != '')){
    $sql = "UPDATE `Employees` SET `Position` = '$position' WHERE Emp_ID = '$UsrID'";
    mysqli_query($conn,$sql);
    }
    if(($wage != '')){
        $sql = "UPDATE `Employees` SET `Wage` = '$wage' WHERE Emp_ID = '$UsrID'";
        mysqli_query($conn,$sql);
    }
    if(($auth != '')){
      $sql = "UPDATE `Employees` SET `Authorization` = '$auth' WHERE Emp_ID = '$UsrID'";
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
      </div>

    </body>
</html>
