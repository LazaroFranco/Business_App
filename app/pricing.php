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
        <title>Pricing</title>

    </head>
    <body>
        <?php
            include 'nav.php';
        ?>
        <div class="bg" ></div>
        <h1 class="header-h1">Customer Pricing</h1>

        <section class="php">
            <?php
                echo "<p>Customer pricing for goods and/or services.</p>";

                // add good/services button logic
                if (isset($_POST['submit'])) {
                    $item = $_POST['item'];
                    $cost = $_POST['cost'];
                    $unit = $_POST['unit'];
                    $companyID = $_SESSION['companyID'];

                    if (($item != '') && ($cost != '')) {
                        $insertItem = "INSERT INTO `Customer_Pricing` (Company_ID, Description, Cost, Unit) VALUES ('$companyID', '$item', '$cost', '$unit')";
                        if (mysqli_query($conn, $insertItem)) {
                            echo "You have entered " . $item . " into your Customer Pricing at the cost of " . $cost . " per " . $unit . ".";
                        } else {
                            echo "Error with adding " . $item . " to the inventory." . mysqli_error($conn);
                        }
                    }
                    //header('Location: pricing.php');
                }

                // add item form
                echo "<form action='pricing.php' method='POST'>
                        <label>Item/Description: </label><input type='text' name='item'/><br>
                        <label>Cost: </label><input type='number' min='0.00' step='.01' name='cost'/><br>
                        <label>Per Unit Type: </label><input type='text' min='0' name='unit'/><br>
                        <input type='submit' name='submit' value='Submit'/>
                    </form><br>";
                
                // remove item button logic
                if (isset($_POST['rmv-item'])) {
                    if(isset($_POST['check'])) {
                        foreach ($_POST['check'] as $value) {
                            $selectDeletedItems = "SELECT Description FROM `Customer_Pricing` WHERE ID='$value'";
                            $result = mysqli_query($conn, $selectDeletedItems);
                            while ($row = mysqli_fetch_array($result)) {
                                $selectedItemName = $row['Description'];
                                $deleteItem = "DELETE FROM `Customer_Pricing` WHERE ID='$value'";
                                if (mysqli_query($conn, $deleteItem)) {
                                    echo "You have removed " . $selectedItemName . " from Customer Pricing.<br>";
                                } else {
                                    echo "Error with removing " . $selectedItemName . " from Customer Pricing." . mysqli_error($conn);
                                }
                            }
                        }
                    }
                }

                $getItemsQuery = "SELECT * From `Customer_Pricing`";
                $getItemsResults = mysqli_query($conn, $getItemsQuery);
                $i = 1;  // counter for checkboxes
                echo "<form action='pricing.php' method='POST'>";
                echo    "<table id='table' class='content-table'>
                            <thead>
                                <tr>
                                    <th>Item/Description Number</th>
                                    <th>Description</th>
                                    <th>Cost</th>
                                    <th>Unit</th>
                                    <th>✅</th>
                                </tr>
                            </thead>";
                while ($row = mysqli_fetch_array($getItemsResults)) {
                    $ID = $row['ID'];
                    $desc = $row['Description'];
                    $table_cost = $row['Cost'];
                    $table_unit = $row['Unit'];
                    echo    "<tbody>
                                <tr>
                                    <td>" . $ID . "</td>
                                    <td>" . $desc . "</td>
                                    <td>" . "$" . $table_cost . " " .  "</td>
                                    <td>" . $table_unit . " " . "</td>
                                    <td><input type='checkbox' name='check[$i]' value='" . $ID . "'/></td>";
                    echo        "</tr>";
                    $i++;
                    echo    "</tbody>";
                }
                echo    "</table>";
                echo "<input type='submit' name='rmv-item' value='Remove'/>";
                echo "</form>";

                include 'footer.php';

                mysqli_close($conn);
            ?>
        </section>
    </body>
</html>