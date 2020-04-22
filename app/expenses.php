<?php
include_once 'db.php';
session_start();
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
        <title>Expenses</title>

    </head>
    <body>
      <?php
      include 'nav.php';
      $companyID = $_SESSION['companyID'];

      ?>
        <div class="bg" ></div>
        <h1 class="header-h1">Expenses</h1>
        <script type="text/javascript">
              function editButton(edit){

            if (document.getElementById('edit').checked){
                document.getElementById("add_exp").style.display = "block";

            }
            else{
                document.getElementById("add_exp").style.display = "none";


            }
        }
        </script>
        <label class="switch">
    <input name="edit"  id="edit" type="checkbox" onclick="editButton(this)" unchecked>
    <span class="slider round"></span>
    </input>
    </label>
        <div class="boxed" id="add_exp" style="display: none;">

            <form action="expenses.php" name="expenses" method="POST">
                <label>Expense Name
                    <input type="text" id="exp_name" name="exp_name"/>
                    </label>
                    <br>
                <label>Expense Cost
                    <input type="text" id="exp_cost" name="exp_cost"/>
                </label>
                    <br>
                <label>
                <h2>Expense Type:</h2>
                    <label>Building Expense
                    <input type="radio" id="build" name="type" value="build" />
                    </label>
                    <br>
                    <label>Equipment Expense
                    <input type="radio" id= "equipment" name="type" value="equipment" />
                    </label>
                    <label>Utilities Expense
                    <input type="radio" id= "utilities" name="type" value="utilities" />
                    </label>
                    <label>Other Expense
                    <input type="radio" id= "other" name="type" value="other" />
                    </label>
                </label>
                    <br>
                <input class="vrsubmit" type="submit" name="submit" id="submit" value="Submit Request">
        
            </form>
            </div>

                        <?php
                    $getBuilding = mysqli_query($conn, "SELECT * FROM Expenses WHERE Type_of_Exp = 'build' AND Company_ID = '$companyID'");
                    echo "<h1>Building Expenses</h1>";
                        echo "<table class='content-table'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>Expense Name</th>";
                                echo "<th>Cost</th>";
                            echo "</tr>";
                        echo "</thead>";

                    while ($row = mysqli_fetch_array($getBuilding)) {
                    echo "<tbody>";
                        echo "<tr>";
                            echo "<td>" . $row['Exp_Name'] . "</td>";
                            echo "<td>" . $row['Expense'] . "</td>";
                        echo "</tr>";
                        echo "</tbody>";
                    
                        }
                    echo"</table>";

                    $getEquipment = mysqli_query($conn, "SELECT * FROM Expenses WHERE Type_of_Exp = 'equipment' AND Company_ID = '$companyID'");

                        echo "<h1>Equipment Expenses</h1>";
                            echo "<table class='content-table'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Expense Name</th>";
                                    echo "<th>Cost</th>";
                                echo "</tr>";
                            echo "</thead>";

                        while ($row = mysqli_fetch_array($getEquipment)) {
                        echo "<tbody>";
                            echo "<tr>";
                                echo "<td>" . $row['Exp_Name'] . "</td>";
                                echo "<td>" . $row['Expense'] . "</td>";
                            echo "</tr>";
                            echo "</tbody>";
                        }
                    echo"</table>";



      
                    $getUtilities = mysqli_query($conn, "SELECT * FROM Expenses WHERE Type_of_Exp = 'utilities' AND Company_ID = '$companyID'");

                    echo "<h1>Utilities Expenses</h1>";
                        echo "<table class='content-table'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>Expense Name</th>";
                                echo "<th>Cost</th>";
                            echo "</tr>";
                        echo "</thead>";

                    while ($row = mysqli_fetch_array($getUtilities)) {
                    echo "<tbody>";
                        echo "<tr>";
                            echo "<td>" . $row['Exp_Name'] . "</td>";
                            echo "<td>" . $row['Expense'] . "</td>";
                        echo "</tr>";
                        echo "</tbody>";
                    }
                    echo"</table>";


                    $getOther = mysqli_query($conn, "SELECT * FROM Expenses WHERE Type_of_Exp = 'other' AND Company_ID = '$companyID'");

                    echo "<h1>Other Expenses</h1>";
                        echo "<table class='content-table'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>Expense Name</th>";
                                echo "<th>Cost</th>";
                            echo "</tr>";
                        echo "</thead>";

                    while ($row = mysqli_fetch_array($getOther)) {
                    echo "<tbody>";
                        echo "<tr>";
                            echo "<td>" . $row['Exp_Name'] . "</td>";
                            echo "<td>" . $row['Expense'] . "</td>";
                        echo "</tr>";
                        echo "</tbody>";
                    }
                    echo"</table>";


                
            
                    if (isset($_POST['submit'])) {
                        
                      $exp_name = $_POST['exp_name'];
                      $exp_cost = $_POST['exp_cost'];
                      $type = $_POST['type'];
                      $compID = $_SESSION['companyID'];
  
                      if(($exp_name != "") & ($exp_cost != "") & ($type != "")){
                          $insertexpenses = "INSERT INTO `Expenses` (Company_ID, Expense, Exp_Name, Type_of_Exp)
                                       VALUES ('$compID', '$exp_cost', '$exp_name', '$type')";
                  if (mysqli_query($conn, $insertexpenses)) {
                      echo "You have submitted an expense.";
                  } else {
                      echo "Error with submitting request." . mysqli_error($conn);
                  }
                      }

                    }
            ?>
        <section class="php">

          <?php
          

            include 'footer.php';
          ?>

        </section>
    </body>
</html>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>