<?php
include_once 'db.php';
if (!isset($_SESSION)){
    session_start();
}
    if($_SESSION['loggedIn'] != TRUE){
        header('Location: index.php');
      }    
    $compID =$_SESSION['companyID'];
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
        <title>Inventory</title>
    </head>
    <body>
        <?php
        $grandTotal = NULL;
            include 'nav.php';
            echo "<h1 class='header-h1'>Inventory</h1>";
            echo "<p>Merchandise for your company's use in order to provide goods and services to our customers.</p>";
            // add item button logic
            if (isset($_POST['addItemButton'])) {
                $itemName = $_POST['item-name'];
                $itemQuantity = $_POST['item-quantity'];
                $itemPrice = $_POST['item-price'];
                $companyID = $_SESSION['companyID'];

                if (($itemName != '') && ($itemQuantity != '') && ($itemPrice != '')) {
                    $sql = "SELECT Item_Name FROM `Inventory` WHERE Item_Name = '$itemName' AND Company_ID = '$companyID'";
                    $result = mysqli_query($conn, $sql);
                    if($result->num_rows == 1){
                        $updateItem = "UPDATE `Inventory` SET Price = $itemPrice, Quantity = $itemQuantity WHERE Item_Name = '$itemName' AND Company_ID = '$companyID'";
                        $updateresult = (mysqli_query($conn, $updateItem));
                    }
                    else{
                    $insertItem = "INSERT INTO `Inventory` (Company_ID, Item_Name, Price, Quantity) VALUES ('$companyID', '$itemName', '$itemPrice', '$itemQuantity')";
                    if (mysqli_query($conn, $insertItem)) {
                        echo "You have entered " . $itemName . " into the inventory.";
                    } else {
                        echo "Error with adding item to the inventory." . mysqli_error($conn);
                    }
                }
            }
                header('Location: inventory.php');

            }

            // add item form
            echo "<form action='inventory.php' method='POST'>
                    <label>Item Name or Description: </label><input type='text' name='item-name'/><br>
                    <label>Quantity: </label><input type='number' min='0' name='item-quantity'/><br>
                    <label>Price: </label><input type='number' min='0.00' step='.01' name='item-price'/><br>
                    <input type='submit' name='addItemButton' value='Add Item'/>
                 </form><br>";
            
            // remove item button logic
            if (isset($_POST['rmv-item-btn'])) {
                if(isset($_POST['check'])) {
                    foreach ($_POST['check'] as $value) {
                        $selectDeletedItems = "SELECT Item_Name FROM `Inventory` WHERE ID='$value'";
                        $result = mysqli_query($conn, $selectDeletedItems);
                        while ($row = mysqli_fetch_array($result)) {
                            $selectedItemName = $row['Item_Name'];
                            $deleteItem = "DELETE FROM `Inventory` WHERE ID='$value'";
                            if (mysqli_query($conn, $deleteItem)) {
                                echo "You have removed " . $selectedItemName . " from the inventory.<br>";
                            } else {
                                echo "Error with removing " . $selectedItemName . " from the inventory." . mysqli_error($conn);
                            }
                        }
                    }
                }
            }

            // intentory table
            $totalPriceQuery = "UPDATE `Inventory` SET Total_Price=Price*Quantity";
            $totalPriceResults = mysqli_query($conn, $totalPriceQuery);
            $getGrandTotalValueQuery = "SELECT SUM(Total_Price) AS Grand_Total FROM `Inventory` WHERE Company_ID = $compID";
            $getGrandTotalValueResult = mysqli_query($conn, $getGrandTotalValueQuery);
            if(!($getGrandTotalValueResult)){
                echo"Nothing in Inventory!";
            }
            else{
            while ($row = mysqli_fetch_array($getGrandTotalValueResult)) {
                $grandTotal = $row['Grand_Total'];
            }
        }

            $getInventoryQuery = "SELECT * From `Inventory` WHERE Company_ID = $compID";
            $getInventoryResults = mysqli_query($conn, $getInventoryQuery);
            $i = 1;  // counter for checkboxes
            echo "<form action='inventory.php' method='POST'>";
            echo    "<table id='table' class='content-table'>
                        <thead>
                            <tr>
                                <th>Item Number</th>
                                <th>Description</th>
                                <th>Price per Unit</th>
                                <th>Quantity in Stock</th>
                                <th>Total Price</th>
                                <th>✅</th>
                            </tr>
                        </thead>";
            while ($row = mysqli_fetch_array($getInventoryResults)) {
                $ID = $row['ID'];
                $itemName = $row['Item_Name'];
                $quantity = $row['Quantity'];
                $price = $row['Price'];
                $totalPrice = $row['Total_Price'];
                echo    "<tbody>
                            <tr>
                                <td name='ID'>" . $ID . "</td>
                                <td name='item-name'>" . $itemName . "</td>
                                <td name='price'>" . "$" . $price . " " .  "</td>
                                <td name='quantity'>" . $quantity . " " . "</td>
                                <td name='total-price' class='total-price'>" . "$" . $totalPrice . "</td>
                                <td><input type='checkbox' name='check[$i]' value='" . $ID . "'/></td>";
                echo        "</tr>";
                $i++;
                echo    "</tbody>";
            }
            echo    "</table>";
            echo "Total Cost of Current Inventory: $" . $grandTotal . "<br>";
            echo "<input type='submit' name='rmv-item-btn' value='Remove item(s)'/>";
            echo "</form>";

            mysqli_close($conn);
        ?> 
        
    </body>
</html>
