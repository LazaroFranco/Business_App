<?php
require "db.php";
session_start();
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
        document.getElementById("button").style.display = "inline-grid";
        document.getElementById("section").style.display = "inline-grid";

    }
    if (emp.value == "0"){
        document.getElementById("basic").style.display = "none";
        document.getElementById("buss_owner").style.display = "inline-grid";
        document.getElementById("button").style.display = "inline-grid";
        document.getElementById("section").style.display = "inline-grid";
    }
      }

        </script>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
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
      <label for="user">Employee</label><br>
<div style="display: none;" id="basic" class="show-forms-employee">
      <label for="Fname">First Name</label><input class="" type="text" name="Fname"><br>
      <label for="Lname">Last Name</label><input class="" type="text" name="Lname"><br>
      <label for="Email">Email</label><input class="" type="text" name="Email"><br>
      <label for="Phone" class="">Phone (Format: 000-000-0000)</label><input class="" type="tel" name="Phone" pattern="[[0-9]{3}-[0-9]{3}-[0-9]{4}"><br>
      <label for="Birth" class="">Date Of Birth</label><input class="" type="date" name="Birth"><br>
      <label for="Pword">Password</label><input class="" type="text" name="Pword"><br>
      <label for="Ccode" class="">Company Code</label><input class="" type="text" name="Ccode"><br>

</div>
<div style="display: none;" id="buss_owner" class="show-forms-employee">
      <label for="CompName">Company Name</label><input class="" type="text" name="CompName"><br>
      <label for="BAddress">Business Address</label><input class="" type="text" name="BAddress"><br>
      <label for="City">City</label><input class="" type="text" name="City"><br>
      <label for="State" class="">State</label><input class="" type="text" name="State"><br>
      <label for="BPhone" class="">Business Phone (Format: 000-000-0000)</label><input class="" type="tel" name="BPhone" pattern="[[0-9]{3}-[0-9]{3}-[0-9]{4}"><br>

</div>
<div>
<input style="display: none;" id="button" type="submit" name="submit" value="Submit">
<br>
<p style="display: none;" id="section">
Thank you for information, we will contact you within 48 hours
</p>
</div>

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
      $compID = "No";

      if(($role == "0" & $fname != "" & $lname != "" & $email != "" & $phone != ""
    & $password != "" & $birth != "" & $compName != "" & $baddress != "" & $city != "" & $state != "" & $bphone != "" & $Ccode != "")){
      $sql = "INSERT INTO `Company`(Business_Name, Business_Address, Phone, Email, City, State, Company_Code) VALUES ('$compName','$baddress','$bphone','$email','$city','$state','$Ccode')";
      mysqli_query($conn,$sql);

      $UserCompanyID = "SELECT ID FROM `Company` WHERE Company_Code = '$Ccode'";
      $result = mysqli_query($conn, $UserCompanyID);

      $resultCheck = mysqli_num_rows($result);
      // RESULT CHECK SHOWS RESULT ID
      //  $resultCheck;
       "<p>Submission was succesful, please wait up to 48hrs for approval.</p>";
      if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
        $compID = $row['ID'];
      }
      }


      $sql = "INSERT INTO `Users`(Fname, Lname, Phone, Email, Password, DoB, Company_Code, Approved, Type_Of_User, Company_ID) VALUES ('$fname','$lname','$phone','$email','$password','$birth', '$Ccode', '0','$role','$compID')";
      mysqli_query($conn,$sql);

      $EmpID = "SELECT ID FROM `Users` WHERE Email = '$email'";
      $result = mysqli_query($conn, $EmpID);

      $resultCheck = mysqli_num_rows($result);
      // RESULT CHECK SHOWS RESULT ID
      //  $resultCheck;
       "<p>Submission was succesful, please wait up to 48hrs for approval.</p>";
      if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
        $EmpID = $row['ID'];
      }
      }


      $sql = "INSERT INTO `Employees`(Company_ID, Emp_ID, Authorization) VALUES ('$compID', '$EmpID', 'Secretary')";
      mysqli_query($conn,$sql);
      ?>
      <!--
      <script type="text/javascript">
      window.location.href = 'https://business-app.herokuapp.com/app/';
      </script>

    -->
      <?php
    }
    if($role == "1" & $fname != "" & $lname != "" & $email != "" & $phone != "" & $password != "" & $birth != ""){

      $UserCompanyID = "SELECT ID FROM `Company` WHERE Company_Code = '$Ccode'";
      $result = mysqli_query($conn, $UserCompanyID);

      $resultCheck = mysqli_num_rows($result);
      // RESULT CHECK SHOWS RESULT ID
      //  $resultCheck;
       "<p>Submission was succesful, please wait up to 48hrs for approval.</p>";
      if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
        $compID = $row['ID'];
      }
      }


      $sql = "INSERT INTO `Users`(Company_ID, Fname, Lname, Phone, Email, Password, DoB, Approved, Type_Of_User, Company_Code) VALUES ('$compID', '$fname','$lname','$phone','$email','$password','$birth','0','$role','$Ccode')";
      mysqli_query($conn,$sql);

      $EmpID = "SELECT ID FROM `Users` WHERE Email = '$email'";
      $result = mysqli_query($conn, $EmpID);

      $resultCheck = mysqli_num_rows($result);
      // RESULT CHECK SHOWS RESULT ID
      // echo $resultCheck;
      echo "<p>Submission was succesful, please wait up to 48hrs for approval.</p>";
      if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
        $EmpID = $row['ID'];
      }
      }

      $sql = "INSERT INTO `Employees`(Company_ID, Emp_ID, Authorization) VALUES ('$compID', '$EmpID', 'Employee')";
      mysqli_query($conn,$sql);

      ?>
      <!--
      <script type="text/javascript">
      window.location.href = 'https://business-app.herokuapp.com/app/';
      </script>
    -->
      <?php

    }



    }
    ?>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- SimpleLightbox plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

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
  <footer class="bg-light py-5">
    <div>
      <div>&copy;<script>document.write(new Date().getFullYear());</script>, Man-A-Biz. Property of Tech by Laz, LLC.
      </div>
    </div>
  </footer>
</html>
