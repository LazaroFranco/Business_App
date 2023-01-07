<?php
require 'db.php';

?>

<script LANGUAGE="JavaScript">
    function myFunction(id) {
      var x = document.getElementById(id);
      var y = document.querySelector('#hide');

      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        y.style.visibility='hidden';

      } else {
        x.className = x.className.replace(" w3-show", "");

      }
    }
      function mployee(emp){
        if (emp.value == "1"){
        document.getElementById("basic").style.display = "inline-grid";
        document.getElementById("buss_owner").style.display = "none";
        document.getElementById("button").style.display = "block";

    }
    if (emp.value == "0"){
        document.getElementById("basic").style.display = "inline-grid";
        document.getElementById("buss_owner").style.display = "inline-grid";
        document.getElementById("button").style.display = "block";

    }
      }
        </script>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="Tech by Laz, Techbylaz, Techbylazllc, Man-a-biz, lazaro franco, laz franco, Lazaro Franco Valdes, Laz, Lazaro, Franco, Valdes, Florida, Pennsylvania, git"/>

    <meta name="description" content="Business Management APP. Tech by Laz, LLC." />
    <meta name="author" content="Tech by Laz, LLC." />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
    <link rel="apple-touch-icon" sizes="128x128" href="manabizlogo.jpg"/>
    <link rel="icon" sizes="192x192" href="nice-manabizlogo.jpg"/>
    <link rel="shortcut icon" type="image/jpeg" href="manabizlogo.jpg"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="reg.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Register</title>
  </head>
  <body>
       <div class="bg" ></div>

       <header class="centered" id="header">
          <h1 class="header-h1">Man-a-Biz</h1>
          <h2 class="text-center mt-0">Register</h2>

           <section class="sign">
             <!--
             <a class="a" onclick="myFunction('Demo1')"  class="w3-btn w3-block w3-black w3-left-align" id="hide" >Login</a>
           -->
             <a class="a" href="index.php">Home</a>
             <div id="Demo1" class="w3-container w3-hide">
               <label for="uname"><b>Username</b></label>
                 <input type="text" placeholder="Enter Username" name="uname" required>

               <label for="psw"><b>Password</b></label>
                  <input type="password" placeholder="Enter Password" name="psw" required>
               <a class="a" onclick="myFunction('Demo1')" class="w3-btn w3-block w3-black w3-left-align" id="login">Login</a>
               <a class="a" onClick="history.go(0);">Cancel</a>
             </div>
       </header>
    <h3>What is your role?</h3>
  <form>
    <input type="radio" name="type-of-user" id="owner" onclick="mployee(this)" value="0"required>
      <label for="user">Business Owner</label>
      <input type="radio" name="type-of-user" id="employee" onclick="mployee(this)" value="1"required>
      <label for="user">Employee</label>
      <br>
      <div style="display: none; width: 75%; margin: 5%;" id="basic" class="show-forms-employee">
      <label for="Fname">First Name</label>
      <input class="" type="text" name="Fname">
      <br>
      <label for="Lname">Last Name</label>
      <input class="" type="text" name="Lname">
      <br>
      <label for="Email">Email</label>
      <input class="" type="text" name="Email">
      <br>
      <label for="Phone" class="">Phone</label>
      <input class="" id="phone-number" type="tel" name="Phone">
      <br>
      <label for="Birth" class="">Date Of Birth</label>
      <input class="" type="date" name="Birth">
      <br>
      <label for="Pword">Password</label>
      <input class="" type="password" id="myInput" name="Pword">
      <input type="checkbox" onclick="myFunction()">Show Password
      <br>
      <label for="Ccode" class="">Company Code</label>
      <input class="" type="text" name="Ccode">
      <br>

</div>
<div style="display: none; width: 75%;margin: 5%;" id="buss_owner" class="show-forms-employee">
      <label for="CompName">Company Name</label>
      <input class="" type="text" name="CompName">
      <br>
      <label for="BAddress">Business Address</label>
      <input class="" type="text" name="BAddress">
      <br>
      <label for="City">City</label>
      <input class="" type="text" name="City">
      <br>
      <label for="State" class="">State</label>
      <input class="" type="text" name="State">
      <br>
      <label for="BPhone" class="">Business Phone</label>
      <input class="" id="BPhone" type="tel" name="BPhone">
      <br>

</div>

<input style="display: none; text-align: center;width: 100%;" id="button" type="submit" name="submit" value="Submit">
  <form>
<?php
if(isset($_GET['submit'])){

  $role = $_GET['type-of-user'];
  $fname = $_GET['Fname'];
  $lname = $_GET['Lname'];
  $email = $_GET['Email'];
  $phone = $_GET['Phone'];
  $birth = $_GET['Birth'];
  $password = $_GET['Pword'];
  $compName = $_GET['CompName'];
  $baddress = $_GET['BAddress'];
  $city = $_GET['City'];
  $state = $_GET['State'];
  $bphone = $_GET['BPhone'];
  $Ccode = $_GET['Ccode'];
  $employID = "SELECT ID FROM users;";

  if(($role == "0" & $fname != "" & $lname != "" & $email != "" & $phone != ""
& $password != "" & $birth != "" & $compName != "" & $baddress != "" & $city != "" & $state != "" & $bphone != "" & $Ccode != "")){
  $sql = "INSERT INTO `company`(Business_Name, Business_Address, Phone, Email, City, State, Company_Code) VALUES ('$compName','$baddress','$bphone','$email','$city','$state','$Ccode')";
  mysqli_query($conn,$sql);

  $UserCompanyID = "SELECT ID FROM `Company` WHERE Company_Code = '$Ccode'";
  $result = mysqli_query($conn, $UserCompanyID);

  $resultCheck = mysqli_num_rows($result);
  if($resultCheck > 0){
    while($row = mysqli_fetch_assoc($result)){
    $compID = $row['ID'];
  }
  echo "<p>Submission for your company was succesful, please wait up to 48hrs for approval.</p>";
}
else {
  echo "<p>Error With your company's registration</p>";
  echo("Error description: " . mysqli_error($conn));
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

}

$sql = "INSERT INTO `users`(Fname, Lname, Phone, Email, Password, DoB, Company_Code, Approved) VALUES ('$fname','$lname','$phone','$email','$password','$birth', '$Ccode', '0')";
mysqli_query($conn,$sql);

  $sql = "INSERT INTO `Users`(Fname, Lname, Phone, Email, Password, DoB, Company_Code, Approved) VALUES ('$fname','$lname','$phone','$email','$password','$birth', '$Ccode', '0')";
  mysqli_query($conn,$sql);

  $UserID = "SELECT ID FROM `Users` WHERE Email = '$email'";
  $result = mysqli_query($conn, $UserID);

  $resultCheck = mysqli_num_rows($result);
  if($resultCheck > 0){
    while($row = mysqli_fetch_assoc($result)){
    $usersID = $row['ID'];
  }
  echo "<p>Submission for Your account was succesful, please wait up to 48hrs for approval.</p>";
}
else {
  echo "<p>Error With your account's Registration</p>";
  echo("Error description: " . mysqli_error($conn));
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
}
}

$sql = "INSERT INTO `Employees`(Company_Code, Emp_ID, Position) VALUES ('$Ccode', '$employID', 'Owner')";
mysqli_query($conn,$sql);

if($role == "1" & $fname != "" & $lname != "" & $email != "" & $phone != "" & $password != "" & $birth != ""){


  $sql = "INSERT INTO `Users`(Fname, Lname, Phone, Email, Password, DoB, Approved, Company_Code) VALUES ( '$fname','$lname','$phone','$email','$password','$birth','0','$Ccode')";
  mysqli_query($conn,$sql);

  $EmpID = "SELECT ID FROM `users` WHERE Email = '$email'";
  $result = mysqli_query($conn, $EmpID);

  $resultCheck = mysqli_num_rows($result);
  if($resultCheck > 0){
    while($row = mysqli_fetch_assoc($result)){
    $employID = $row['ID'];
  }
  echo "<p>Submission was succesful, please wait up to 48hrs for approval or contact us.</p>";
}
else {
  echo "<p>Error With employee account Registration</p>";
}

///// EMPLOYEES //////////////////
$sql = "INSERT INTO `Employees`(Company_ID, Emp_ID, Authorization) VALUES ('$compID', '$employID', 'Employee')";
mysqli_query($conn,$sql);

///// EMPLOYEES //////////////////
$sql = "INSERT INTO `Employees`(Company_Code, Emp_ID, Position) VALUES ('$Ccode', '$employID', 'Employee')";
mysqli_query($conn,$sql);

  ?>

  <?php

}
}

?>
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

  function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
</script>
</body>
<footer>
  <div>
    <div>&copy;<script>document.write(new Date().getFullYear());</script>, Man-A-Biz. Property of Tech by Laz, LLC.
    </div>
  </div>
</footer>
</html>
