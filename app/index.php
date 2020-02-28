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
       <div class="bg" ></div>

    <header class="centered" id="header">
       <h1 class="header-h1">Man-A-Biz</h1>
        <section class="sign">
          <a class="a" href="register.php">Register</a>
          <a class="a" onclick="myFunction('Demo1')"  class="w3-btn w3-block w3-black w3-left-align" id="hide" >Login</a>
          <div id="Demo1" class="w3-container w3-hide">
            <label for="uname"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Password</b></label>
               <input type="password" placeholder="Enter Password" name="psw" required>
            <a class="a" onclick="myFunction('Demo1')" class="w3-btn w3-block w3-black w3-left-align" id="login" href="login.php">Login</a>
          </div>
    </header>

     <nav class="nav">
        <div class="ul">
             <a href="/Man-A-Biz/app/index.php">Home</a>
             <a href="">PAGE 1</a>
             <a href="">PAGE 2</a>
             <a href="/Man-A-Biz/app/about.php">About Us</a>
          </div>
     </nav>

     <section class="hero-img"></section>

<section class="home">
<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <h3>Column 1</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
    </div>
    <div class="col-sm-4">
      <h3>Column 2</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
    </div>
    <div class="col-sm-4">
      <h3>Column 3</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
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
        y.style.visibility='hidden';

      } else {
        x.className = x.className.replace(" w3-show", "");

      }

    }



        </script>
  </body>
</html>
