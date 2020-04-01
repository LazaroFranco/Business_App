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
        <title>Inventory</title>
    </head>
    <body>
        <?php
            include 'nav.php';
            echo "<h1 class='header-h1'>Inventory</h1>";
            echo "<p>Merchandise for our use in order to provide goods and services to our customers.</p>";
            $getInventoryQuery = "SELECT Item_Name, Price, Quantity From `Inventory`";
            $getInventoryResults = mysqli_query($conn, $getInventoryQuery);

            echo "<form action='inventory.php' method='POST'>";
            echo    "<table class='content-table'>
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Quantity in Stock</th>
                                <th>Price per Unit</th>
                                <th>Total Price</th>
                            <tr>
                        </thead>";
            while ($row = mysqli_fetch_array($getInventoryResults)) {
                $totalCost = number_format($row['Quantity'] * $row['Price'], 2);
                echo    "<tbody>
                            <tr>
                                <td name='item-name'>" . $row['Item_Name'] . "</td>
                                <td name='quantity'>" . $row['Quantity'] . "</td>
                                <td name='price'>" . "$" . $row['Price'] . "</td>
                                <td name='total-price'>" . "$" . $totalCost . "</td>
                            <tr>
                        </tbody>";
            }
            echo    "</table>";
            echo "</form>";
            

        ?>


    </body>
</html>
