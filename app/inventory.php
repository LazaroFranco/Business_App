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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <title>Inventory</title>
    </head>
    <body>
        <?php
            include 'nav.php';
            echo "<h1 class='header-h1'>Inventory</h1>";
            echo "<p>Merchandise for our use in order to provide goods and services to our customers.</p>";

            // add item form
            echo "<form action='inventory.php' method='POST'>
                    <label>Item Name or Description: </label><input type='text' name='item-name'/><br>
                    <label>Quantity: </label><input type='text' name='item-quantity'/><br>
                    <label>Price: </label><input type='text' name='item-price'/></br>
                    <input type='submit' name='addItemButton' value='Add Item'/>
                 </form>";

            //if (isset($_GET['login'])) {
                if (isset($_POST['addItemButtom'])) {
                    $itemName = $_POST['item-name'];
                    $itemQuantity = $_POST['item-quantity'];
                    $itemPrice = $_POST['item-price'];
                    $companyID = $_SESSION['companyID'];

                    if (($itemName != '') && ($itemQuantity != '') && ($itemPrice != '')) {
                        $insertItem = "INSERT INTO `Inventory` (Company_ID, Item_Name, Price, Quantity) VALUES ('$companyID', '$itemName', '$itemPrice', '$itemQuantity')";
                        if (mysqli_query($conn, $insertItem)) {
                            echo "You have entered " . $itemName . "into the inventory.";
                        } else {
                            echo "Error with adding item to the inventory." . mysqli_error($conn);
                        }
                    }
                    header('Location: inventory.php');
                }
            

                // intentory table
                $getInventoryQuery = "SELECT * From `Inventory`";
                $getInventoryResults = mysqli_query($conn, $getInventoryQuery);
                echo "<form action='inventory.php' method='POST'>";
                echo    "<table class='content-table'>
                            <thead>
                                <tr>
                                    <th>Item Number</th>
                                    <th>Description</th>
                                    <th>Price per Unit</th>
                                    <th>Quantity in Stock</th>
                                    <th>Total Price</th>
                                <tr>
                            </thead>";
                while ($row = mysqli_fetch_array($getInventoryResults)) {
                    $totalPrice = number_format($row['Quantity'] * $row['Price'], 2);
                    echo    "<tbody>
                                <tr>
                                    <td name='ID'>" . $row['ID'] . "</td>
                                    <td name='item-name'>" . $row['Item_Name'] . "</td>
                                    <td name='price'>" . "$" . $row['Price'] . " " .  "</td>
                                    <td name='quantity'>" . $row['Quantity'] . " " . "</td>
                                    <td name='total-price'>" . "$" . $totalPrice . "</td>
                                <tr>
                            </tbody>";
                }
                echo    "</table>";
                echo "</form>";
            //}
            // . "<button><i id='edit-price-icon' class='material-icons'>mode_edit</i></button>" .
        ?> 
        
    </body>
</html>
