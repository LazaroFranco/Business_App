<?php
include_once "db.php";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', true);
if (isset($_GET["login"])) {
    $search =
        "SELECT * From Users, Company WHERE Users.Company_Code = Company.Company_Code;";
    $result = mysqli_query($conn, $search);
    while ($row = mysqli_fetch_row($result)) {
        if ($row[9] == 1) {
            if ($row[5] == $_GET["uname"] ?? "") {
                if ($row[6] == $_GET["psw"] ?? "") {
                    $_SESSION["role"] = $row[10];
                    $_SESSION["loggedIn"] = true;
                    $_SESSION["ID"] = $row[0];
                    $_SESSION["companyID"] = $row[1];
                    $_SESSION["Fname"] = $row[2];
                    $_SESSION["Lname"] = $row[3];
                    $_SESSION["Phone"] = $row[4];
                    $_SESSION["email"] = $row[5];
                    $_SESSION["DoB"] = $row[7];
                    $_SESSION["CompanyCode"] = $row[8];
                    $_SESSION["Approved"] = $row[9];
                    $_SESSION["type_of_User"] = $row[10];
                    $_SESSION["image"] = $row[11];
                    $_SESSION["position"] = $row[12];
                    $_SESSION["bio"] = $row[13];
                    $_SESSION["Business_Name"] = $row[15];
                    $_SESSION["Business_Address"] = $row[16];
                    $_SESSION["Business_Phone"] = $row[17];
                    $_SESSION["Business_City"] = $row[19];
                    $_SESSION["Business_State"] = $row[20];
                    $employ_ID = $row[0];
                    $Auth = "SELECT * From Employees WHERE Emp_ID = $employ_ID;";
                    $AuthResult = mysqli_query($conn, $Auth);
                    while ($Arow = mysqli_fetch_row($AuthResult)) {
                        $_SESSION["Authorization"] = $Arow[5];
                    }
                    if ($row[5] == "Admin") {
                        header("Location: Admin.php");
                    } else {
                        header("Location: myprofile.php");
                    }
                    break;
                }
            }
        }
    }
}
if (isset($_GET["logout"])) {
    header("Location: logout.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Man-a-Biz</title>
  <!-- Favicon-->

  <!-- Bootstrap Icons-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
  <!-- SimpleLightbox plugin CSS-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="styles.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container px-4 px-lg-5">
      <a onClick="history.go(0);" class="navbar-brand">Man-A-Biz</a>
      <a class="a" href="register.php">Register</a>
      <a class="a" onclick="myFunction('Demo1')" id="hide">Login</a>
    </div>
    <section class="sign">

      <form style="margin-top: 50%;">
        <div id="Demo1" class="w3-container w3-hide">
          <div>
          <label for="uname"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="uname" required="">
        </div>
        <div>
          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="psw" required="">
        </div>
          <button type="submit" onclick="myFunction('Demo1')" id="login" name="login">Login</button>
          <button onClick="history.go(0);">Cancel</button>
        </div>
      </form>
    </section>
  </nav>
  <!-- Masthead-->
  <header class="masthead">
    <div class="container px-4 px-lg-5 h-100">
      <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-8 align-self-end">
          <h1 class="text-black font-weight-bold">Man-A-Biz</h1>
        </div>
      </div>
    </div>
  </header>
  <!-- Services-->
  <section class="page-section" id="services">
    <div class="container px-4 px-lg-5">
      <h2 class="text-center mt-0">At Your Service</h2>
      <hr class="divider" />
      <div class="row gx-4 gx-lg-5">
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div>
            <h3 class="h4 mb-2">Connect</h3>
            <p class="text-muted mb-0">A Connection will be the first step to any system! From company administrator to contractors, you will be able to keep everyone in touch.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <div class="mb-2"><i class="bi-laptop fs-1 text-primary"></i></div>
            <h3 class="h4 mb-2">Manage</h3>
            <p class="text-muted mb-0">Manage your team with a click of a button! Our graphical user interface(GUI) will allow you to use every feature without a problem.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div>
            <h3 class="h4 mb-2">Personalize</h3>
            <p class="text-muted mb-0">See what you want to see! With this application you will be able to add or remove any operating system that will help you run your business!</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Contact-->
  <section class="page-section" id="contact">
    <div class="container px-4 px-lg-5">
      <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-lg-8 col-xl-6 text-center">
          <h2 class="mt-0">Let's Get In Touch!</h2>
          <hr class="divider" />
          <p class="text-muted mb-5">Ready to start your next business with us? Send us a messages and we will get back to you as soon as possible!</p>
        </div>
      </div>
      <div class="container">
        <form method="POST" action="https://formspree.io/lazaro300x@icloud.com">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="fname">Your Name *</label>
                <input id="first_name" name="name" type="text" class="form-control" required="">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Your Email *</label>
                <input id="email" type="text" name="email" class="form-control">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Your Message *</label>
                <textarea name="message" class="form-control" rows="6"></textarea>
              </div>
              <input type="submit" id="submitButton" value="Send" class="btn btn-primary btn-xl ">
            </div>
          </div>
      </div>
      </form>
      </div>
      <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-lg-4 text-center mb-5 mb-lg-0">
          <i class="bi-phone fs-2 mb-3 text-muted"></i>
          <div>
            <a href="tel:7176173258">717-617-3258</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Footer-->
  <footer class="bg-light py-5">
    <div class="container px-4 px-lg-5">
      <div>&copy;<script>document.write(new Date().getFullYear());</script>, Man-A-Biz. Property of Tech by Laz, LLC.
      </div>
    </div>
  </footer>
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- SimpleLightbox plugin JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
  <!-- Core theme JS-->
  <script src="js/scripts.js"></script>
  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
  <!-- * *                               SB Forms JS                               * *-->
  <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
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
</html>
