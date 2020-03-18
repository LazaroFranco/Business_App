<?php
session_start();
include_once 'db.php';

if(isset($_GET['login'])) {
  $search = "SELECT * From Users;";
  $result = mysqli_query($conn, $search);
  while($row = mysqli_fetch_row($result)) {
    if ($row[9] == 1) {
      if ($row[5] == $_GET['uname'] ?? '') {
        if ($row[6] == $_GET['psw'] ?? ''){
          $_SESSION['role'] = $row[10];
        }}}}}
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
  // } else {
  //   // They ain't even logged in.
  //   header("Location: index.php");
  // }
  }
 ?>
 
 <!DOCTYPE html>
 <html lang="en" dir="ltr">

 <head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
   <link rel="stylesheet" href="styles.css" type="text/css">
   <title>Welcome!</title>
 </head>

 <body>
   <div class="bg"></div>
   <header class="centered" id="header">
     <h1 class="header-h1">Man-A-Biz</h1>
     <section class="sign">
       <a class="a" href="register.php">Register</a>
       <a class="a" onclick="myFunction('Demo1')" class="w3-btn w3-block w3-black w3-left-align" id="hide">Login</a>
       <div id="Demo1" class="w3-container w3-hide">
         <label for="uname"><b>Username</b></label>
         <input type="text" placeholder="Enter Username" name="uname" required>
         <label for="psw"><b>Password</b></label>
         <input type="password" placeholder="Enter Password" name="psw" required>
         <a class="a" onclick="myFunction('Demo1')" class="w3-btn w3-block w3-black w3-left-align" id="login"  name="login" href="login.php">Login</a>
       </div>
   </header>
   <nav class="nav">
     <div class="ul">
       <a href="/Man-A-Biz/app/index.php">Home</a>
       <a href="/Man-A-Biz/app/about.php">About Us</a>
     </div>
   </nav>
   <section class="hero-img"></section>
   <section class="home">
     <div class="container">
       <div class="row">
         <div class="col-sm-4">
           <img src="./images/connect.jpeg" alt="Connect image" height="250" width="325">
           <br>
           <h3>Connect</h3>
           <p>A Connection will be the first step to any system!</p>
           <p>From company administrator to contractors, you will be able to keep everyone in touch. </p>
         </div>
         <div class="col-sm-4">
           <img src="https://www.janbaskdigitaldesign.com/assets/frontend/img/img2/responsive-BannerodPatch.png" height="250" width="350">
           <h3>Personalize</h3>
           <p>See what you want to see!</p>
           <p>With this application you will be able to add or remove any operating system that will help you run your business!</p>
         </div>
         <div class="col-sm-4">
           <img src="https://img.evbuc.com/https%3A%2F%2Fcdn.evbuc.com%2Fimages%2F49131482%2F261103918272%2F1%2Foriginal.jpg?auto=compress&s=343edf3d16fa73337d4073e9231bbd8e" height="250" width="350">
           <h3>Manage</h3>
           <p>Manage your team with a click of a button!</p>
           <p>Our graphical user interface(GUI) will allow you to use every feature without a problem.</p>
         </div>
       </div>
     </div>
   </section>
   <?php

 ?>
   <footer>
     <h2 class="footer-h1">Man-A-Biz</h2>
     <address>
       <p>750 E King St</p>
       <p>Lancaster, PA 17602</p>
       <p><a href="tel:1-717-299-7701" class="phone">717.299.7701</a></p>
     </address>
   </footer>
   <script>
     function myFunction(id) {
       var x = document.getElementById(id);
       var y = document.querySelector('#hide');
       if (x.className.indexOf("w3-show") == -1) {
         x.className += " w3-show";
         y.style.visibility = 'hidden';
       } else {
         x.className = x.className.replace(" w3-show", "");
       }
     }
   </script>
 </body>

 </html>
