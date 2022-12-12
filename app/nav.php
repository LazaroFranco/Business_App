<?php
$currentFileInfo = pathinfo(__FILE__);
$requestInfo = pathinfo($_SERVER['REQUEST_URI']);
if($currentFileInfo['basename'] == $requestInfo['basename']){
  die();
}
if (!isset($_SESSION)){
  session_start();
  if($_SESSION['loggedIn'] != TRUE){
      header('Location: index.php');
    }}
?>
<link rel="stylesheet" href="style.css">

<div class="row" id="headerrow">
  <div class="column">
    <button class="openbtn" onclick="openNav()">&#9776;</button>
        <a class="openbtn-users" id="openbtn-users" onclick="openNavUsers()">View Your Team</a>
  </div>
  <div class="column">
    <?php
    echo "<h1 class='header-bn'>". $_SESSION['Business_Name'].
     "</h1>";
     ?>
  </div>
  <div class="column">
    <h2 class="header-h2" id="manabiz">Man-A-Biz</h2>
  </div>
</div>

<header>
  <nav>
    <ul id="mySidebar-users" class="sidebar">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNavUsers()">&times;</a>
      <?php
      $comp_id = $_SESSION['companyID'];
      echo "<h1 class='usersh1'>Your Team</h1>";
      $userQuery = mysqli_query($conn, "SELECT * FROM Users WHERE Company_ID = '$comp_id' AND Approved = '1'
      ;");

      $i = 1;
        while ($row =  mysqli_fetch_array($userQuery)) {
            if($row['image'] == ""){
            echo "<li style='margin-top: 1em;'>
            <img class='uimg' src='images/default.svg' class='img-responsive' alt='Default'>
            <a href='profile.php?ID=".$row['ID']."' style='cursor:grab;'>

            "
            .$row['Fname'].
            " "
            .$row['Lname'].
            "<br>"
            .
            "
            </a>
          </li>";
            }
            else {
            echo "<li style='margin-top: 1em;'>
            <img class='uimg' src='images/".$row['image'] ."' class='img-responsive' alt='Default'>

              <a href='profile.php?ID=".$row['ID']."' style='cursor:grab;'>

              "
              .$row['Fname'].
              " "
              .$row['Lname'].
              "<br>"
              .
              "
              </a>
            </li>";
            }
          $i++;
      }

      ?>
    </ul>
  </nav>

  <nav>
  <ul id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <li>
    <?php
        $Auth= $_SESSION['Authorization'];
        if ($Auth == 'Admin'){
          echo "<h3><a style='color: white;' href=\"/Business_App/app/myprofile.php\">
          <img src='images/".$_SESSION['image'] ."' class='img-responsive' alt='Default'>My Profile
          </a></h3>";
          echo "<ul>";
          echo "<li><a href=\"/Business_App/app/Admin.php\"> Admin Page</a></li>";
          echo "</ul>";
          echo "<h3>Employee Management</h3>";
          echo "<ul>";
          echo "<li><a href=\"/Business_App/app/employeeApproval.php\"> Employee Approval</a></li>";
          echo "<li><a href=\"/Business_App/app/employeeHours.php\"> Employee Hours</a></li>";
          echo "<li><a href=\"/Business_App/app/employees.php\">Employee List</a></li>";
          echo "<li><a href=\"/Business_App/app/message.php\"> Messages</a></li>";
          echo "<li><a href=\"/Business_App/app/vacationRequests.php\"> Vacation Requests</a></li>";
          echo "<h3>Company Management</h3>";
          echo "<li><a href=\"/Business_App/app/pricing.php\"> Pricing</a></li>";
          echo "<li><a href=\"/Business_App/app/inventory.php\"> Inventory</a></li>";
          echo "<li><a href=\"/Business_App/app/expenses.php\">  Expenses</a></li>";
          echo "<li><a href=\"/Business_App/app/orders.php\">  Orders</a></li>";

          echo "</ul>";
          echo "<li><a class='logout' href='/Business_App/app/logout.php'>Logout</a></li>";

        } else if ($Auth == 'Secretary'){
          echo "<h3><a style='color: white;' href=\"/Business_App/app/myprofile.php\">
          <img src='images/".$_SESSION['image'] ."' class='img-responsive' alt='Default'>My Profile
          </a></h3>";
          echo "<ul>";
          echo "</ul>";
          echo "<h3>Employee Management</h3>";
          echo "<ul>";
          echo "<li><a href=\"/Business_App/app/employeeApproval.php\"> Employee Approval</a></li>";
          echo "<li><a href=\"/Business_App/app/employees.php\">Employee List</a></li>";
          echo "<li><a href=\"/Business_App/app/message.php\"> Messages</a></li>";
          echo "<li><a href=\"/Business_App/app/vacationRequests.php\"> Vacation Requests</a></li>";
          echo "<h3>Company Management</h3>";
          echo "<li><a href=\"/Business_App/app/pricing.php\"> Pricing</a></li>";
          echo "<li><a href=\"/Business_App/app/inventory.php\"> Inventory</a></li>";
          echo "<li><a href=\"/Business_App/app/expenses.php\">  Expenses</a></li>";
          echo "<li><a href=\"/Business_App/app/orders.php\">  Orders</a></li>";
          echo "</ul>";
          echo "<li><a class='logout' href='/Business_App/app/logout.php'>Logout</a></li>";
        } else if ($Auth == 'Manager'){
          echo "<h3><a style='color: white;' href=\"/Business_App/app/myprofile.php\">
          <img src='images/".$_SESSION['image'] ."' class='img-responsive' alt='Default'>My Profile
          </a></h3>";
          echo "<ul>";
          echo "</ul>";
          echo "<h3>Employee Management</h3>";
          echo "<ul>";
          // echo "<li><a href=\"/Business_App/app/employeeApproval.php\"> Employee Approval</a></li>";
          echo "<li><a href=\"/Business_App/app/employees.php\">Employee List</a></li>";
          echo "<li><a href=\"/Business_App/app/message.php\"> Messages</a></li>";
          echo "<li><a href=\"/Business_App/app/vacationRequests.php\"> Vacation Requests</a></li>";
          echo "<h3>Company Management</h3>";
          echo "<li><a href=\"/Business_App/app/inventory.php\"> Inventory</a></li>";
          echo "<li><a href=\"/Business_App/app/expenses.php\">  Expenses</a></li>";
          echo "<li><a href=\"/Business_App/app/orders.php\">  Orders</a></li>";
          echo "</ul>";
          echo "<li><a class='logout' href='/Business_App/app/logout.php'>Logout</a></li>";
        } else if ($Auth == 'Employee'){
          echo "<h3><a style='color: white;' href=\"/Business_App/app/myprofile.php\">
          <img src='images/".$_SESSION['image'] ."' class='img-responsive' alt='Default'>My Profile
          </a></h3>";
          echo "<ul>";
          echo "</ul>";
          echo "<h3>Employee Management</h3>";
          echo "<ul>";
          // echo "<li><a href=\"/Business_App/app/employeeApproval.php\"> Employee Approval</a></li>";
          // echo "<li><a href=\"/Business_App/app/employees.php\">Employee List</a></li>";
          echo "<li><a href=\"/Business_App/app/message.php\"> Messages</a></li>";
          echo "<li><a href=\"/Business_App/app/vacationRequests.php\"> Vacation Requests</a></li>";
          echo "<h3>Company Management</h3>";
          echo "<li><a href=\"/Business_App/app/inventory.php\"> Inventory</a></li>";
          // echo "<li><a href=\"/Business_App/app/expenses.php\">  Expenses</a></li>";
          echo "<li><a href=\"/Business_App/app/orders.php\">  Orders</a></li>";
          echo "</ul>";
          echo "<li><a class='logout' href='/Business_App/app/logout.php'>Logout</a></li>";
        } else {
          echo "<h3><a style='color: white;' href=\"/Business_App/app/myprofile.php\">
          <img src='images/".$_SESSION['image'] ."' class='img-responsive' alt='Default'>My Profile
          </a></h3>";
          echo "<ul>";
          echo "</ul>";
          echo "<h3>Employee Management</h3>";
          echo "<ul>";
          echo "<li><a href=\"/Business_App/app/employeeApproval.php\"> Employee Approval</a></li>";
          echo "<li><a href=\"/Business_App/app/employees.php\">Employee List</a></li>";
          echo "<li><a href=\"/Business_App/app/message.php\"> Messages</a></li>";
          echo "<li><a href=\"/Business_App/app/vacationRequests.php\"> Vacation Requests</a></li>";
          echo "<h3>Company Management</h3>";
          echo "<li><a href=\"/Business_App/app/inventory.php\"> Inventory</a></li>";
          echo "<li><a href=\"/Business_App/app/expenses.php\">  Expenses</a></li>";
          echo "</ul>";
          echo "<li><a class='logout' href='/Business_App/app/logout.php'>Logout</a></li>";
        }

     ?>

   </li>
  </ul>
</nav>
</header>

<script>
/* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";

}

function openNavUsers() {
  document.getElementById("mySidebar-users").style.width = "250px";
}


/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
}

function closeNavUsers() {
  document.getElementById("mySidebar-users").style.width = "0";
}
</script>
