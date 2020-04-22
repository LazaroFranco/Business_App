<?php
include_once 'db.php';
session_start();
if($_SESSION['loggedIn'] != TRUE){
    header('Location: index.php');
  }if (!$conn) {
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
        <title>Orders</title>

    </head>
    <body>
      <?php
      include 'nav.php';
      
      ?>
        <div class="bg" ></div>
        <h1 class="header-h1">Orders</h1>
        <script type="text/javascript">
              function editButton(edit){

            if (document.getElementById('edit').checked){
                document.getElementById("add_ord").style.display = "block";

            }
            else{
                document.getElementById("add_ord").style.display = "none";


            }
        }

        function order(edit){

if (document.getElementById('schedule').checked){
    document.getElementById("scheduled").style.display = "block";

}
else{
    document.getElementById("scheduled").style.display = "none";


}

if (document.getElementById('completed').checked){
    document.getElementById("complete").style.display = "block";

}
else{
    document.getElementById("complete").style.display = "none";


}
}
        </script>
            <div class="group_of_switch">
                <label class="switch"> 
                    <input name="edit"  id="edit" type="checkbox" onclick="editButton(this)" unchecked>
                        <span class="slider round"></span>Add Order
                    </input>
                </label>

                <label class="switch"> 
                    <input name="schedule"  id="schedule" type="checkbox" onclick="order(this)" checked>
                        <span class="slider round"></span>Scheduled Orders
                    </input>
                </label>                

                <label class="switch"> 
                    <input name="complete"  id="completed" type="checkbox" onclick="order(this)" unchecked>
                        <span class="slider round"></span>Completed Orders
                    </input>
                </label>
    </div>
<br>
<br>
        <div class="boxed" id="add_ord" style="display: none;">

            <form action="orders.php" name="orders" method="POST">
                <label>Order Name
                    <input type="text" id="ord_name" name="ord_name"/>
                    </label>
                    <br>
                <label>Date Ordered
                    <input type="date" id="ord_date" name="ord_date" value="<?php echo date('Y-m-d')?>"/>
                </label>
                    
                    <label>Due Date
                    <input type="date" id="due_date" name="due_date"/>
                </label>
                <br>
                <label>Order Details
                <textarea type="text" id="ord_det" name="order_det" rows="5" cols="20"></textarea>
                </label>
                    <br>
                <input class="vrsubmit" type="submit" name="submit" id="submit" value="Submit Request">
        
            </form>
            </div>
            <br>


                        <?php
                    echo'<div id="scheduled" name="scheduled" style="display: block;">';
                    $getOrders = mysqli_query($conn, "SELECT * FROM Orders  WHERE Completed = '0' ORDER BY Due_Date Asc");
                    echo "<h1>Customer Order Schedule</h1>";
                        echo "<table class='content-table'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>Order Name</th>";
                                echo "<th>Date Ordered</th>";
                                echo "<th>Due Date</th>";
                                echo "<th>Order Details</th>";
                                echo "<th>Completed</th>";

                            echo "</tr>";
                        echo "</thead>";

                    while ($row = mysqli_fetch_array($getOrders)) {
                    echo "<tbody>";
                        echo "<tr>";
                            echo "<td>" . $row['Order_Name'] . "</td>";
                            echo "<td>" . $row['Date_Ordered'] . "</td>";
                            echo "<td>" . $row['Due_Date'] . "</td>";
                            echo "<td>" . $row['Order_Details'] . "</td>";
                            echo "<td><form action='orders.php' name='complete' method='POST'>
                            <button type='submit'> ✅ </button>
                            <input type='hidden' name='sub_ord' value='". $row['ID'] ."'/>
                            </form></td>";

                        echo "</tr>";
                        echo "</tbody>";
                    
                        }
                    echo"</table>";
                    echo"</div>";
                        echo"<br>";
                    echo'<div id="complete" name="Orders" style="display: none;">';

                        $getOrders = mysqli_query($conn, "SELECT * FROM Orders WHERE Completed = '1' ORDER BY Due_Date Asc ");
                    echo "<h1>Completed Orders</h1>";
                        echo "<table class='content-table'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>Order Name</th>";
                                echo "<th>Date Ordered</th>";
                                echo "<th>Due Date</th>";
                                echo "<th>Order Details</th>";

                            echo "</tr>";
                        echo "</thead>";

                    while ($row = mysqli_fetch_array($getOrders)) {
                    echo "<tbody>";
                        echo "<tr>";
                            echo "<td>" . $row['Order_Name'] . "</td>";
                            echo "<td>" . $row['Date_Ordered'] . "</td>";
                            echo "<td>" . $row['Due_Date'] . "</td>";
                            echo "<td>" . $row['Order_Details'] . "</td>";
      

                        echo "</tr>";
                        echo "</tbody>";
                    
                        }
                    echo"</table>";
                    echo"</div>";

            
                    if (isset($_POST['submit'])) {
                        
                      $ord_name = $_POST['ord_name'];
                      $ord_date = $_POST['ord_date'];
                      $due_date = $_POST['due_date'];
                      $order_det = $_POST['order_det'];
                      $compID = $_SESSION['companyID'];
  
                      if(($ord_name != "") & ($ord_date != "") & ($due_date != "") & ($order_det != "")){
                          $insertorder = "INSERT INTO `Orders` (Company_ID, Order_Name, Date_Ordered, Due_Date, Order_Details)
                                       VALUES ('$compID', '$ord_name', '$ord_date', '$due_date', '$order_det')";
                  if (mysqli_query($conn, $insertorder)) {
                      echo "You have submitted an order.";
                      $order_det = "";
                      echo "<meta http-equiv='refresh' content='0'>";
                  } else {
                      echo "Error with submitting request." . mysqli_error($conn);
                  }
                      }

                    }

                    if(isset($_POST['sub_ord'])){
                        $OrdID = $_POST['sub_ord'];
                        $sql = "UPDATE `Orders` SET Completed = '1' WHERE ID = '$OrdID'";
                        mysqli_query($conn,$sql);  
                        echo "<meta http-equiv='refresh' content='0'>";
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
// if ( window.history.replaceState ) {
//   window.history.replaceState( null, null, window.location.href );
// }
</script>