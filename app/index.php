<?php
session_start();
include_once 'db.php';
  if (isset($_SESSION['ID'])){
    // Start looking for roles.
    $role= $_SESSION['role'];
    // echo "Hello, " . $_SESSION['firstName'] . "! You are a " . $role . ".";
    if ($role == "admin"){
      // Create the Admin Home.
        include("./admin/admin_home.php");
      } else if ($role == "owner"){
        // Create the Owner Home.
          include("./owner/owner.php");
        } else if ($role == "supervisor"){
          // Create the supervisor Home.
            include("./supervisor/supervisor_home.php");
          } else if ($role == "employee"){
            // Create the employee Home.
              include("./employee/employee_home.php");
            }
  } else {
    // They ain't even logged in.
    header("Location: index.php");
  }

 ?>
