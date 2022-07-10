<?php

require 'function.php';
if(session_id() == '' || !isset($_SESSION)){session_start();}

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ){
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  // ambil email berdasarkan id
  $result = mysqli_query($conn, "SELECT email FROM users WHERE user_id = $id");
  $row = mysqli_fetch_assoc($result);

  // cek cookie dan email
  if( $key === hash('sha256', $row['email']) ){
    $_SESSION['login'] = true;
  }
}

if(isset($_SESSION["login"])){
  header("Location: product.php");
  exit;
}

if( isset($_POST["login"]) ){

  $email = $_POST["email"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

  // cek email
  if( mysqli_num_rows($result) === 1 ){
    // cek password
    $row = mysqli_fetch_assoc($result);

    if( password_verify($password, $row["password"]) ){

      // set session
      $_SESSION["login"] = true;
      $_SESSION['email'] = $email;
      // cek rememeber me
      if( isset($_POST["rememberme"]) ){
        // buat cookie
        setcookie('id', $row['user_id'], time() + 1800);
        setcookie('key', hash('sha256', $row['email']), time() + 1800);
      }

      // cek admin atau bukan
      if( $row['user_type']=="admin" ){

        $_SESSION['user_type'] = "admin";
        header("Location: user/index.php");
        exit;
      } else {
        header("Location: product.php");
        exit;
      }

    }

  }

  $error = true;

}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Pet Shop</title>

    <link rel="shortcut icon" href="img/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  </head>

  <body>
<!-- navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">
          <img class="brand" src="img/logotext.png" alt="logo">
        </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <a class="navbar-brand" href="index.php">
            <img class="brand" src="img/logotext.png" alt="logo">
          </a>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#service">Service</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#location">Location</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-1">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search fa-1x"></i></button>
        </form>
        <div class="right-navbar">
          <ul class="navbar-nav mr-auto">
              <a class="nav-link"><i class="fas fa-shopping-cart"></i></a>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="login.php">Login</a>
                <a class="dropdown-item" href="register.php">Register</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- login form -->
    <div class="login">
      <div class="row">
        <h2>Login</h2>
      </div>

      <?php if ( isset($error) ){
        echo "
          <script>
              alert('Email atau Password Salah');
              document.location.href='login.php';
          </script>
      ";
      }?>

      <form action="" method="post">
        <div class="form-group">
          <label for="email">Alamat Email</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="Email">
          <small id="email" class="form-text text-muted">Masukan Alamat Email</small>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="rememberme" id="rememberme">
            <label class="form-check-label" for="rememberme">
              remember me
            </label>
          </div>
        </div>
          <small class="form-text text-muted text-decs">Belum punya aku register <a href="register.php">disini</a> </small>
        <button type="submit" name="login" class="btn btn-success">Login</button>
      </form>
    </div>
<!-- footer -->
    <footer>
      <div class="container">
          <div class="row">
            <div class="col-md-4">
              <h2>INFORMATION</h2>
              <br><a href="#">About Us</a>
              <br><a href="#">Contact Us</a>
              <br><a href="#">Find Us</a>
            </div>
            <div class="col-md-4">
              <h2>Contact Us</h2>
              <br><a href="#">Jl. Pedro si Kucing, Bekasi</a>
              <br><a href="#">0899 6212 8228</a>
              <br><a href="#">Instagram : @pedropetshop</a>
            </div>
            <div class="col-md-4">
              <h2>NEWSLETTER</h2>
              <br>You may unsubscribe at any moment. For that purpose, please find our contact info in the legal notice.
              <br><input type="email" name="" value=""><button type="submit" name="button"></button>
            </div>
          </div>
        </div>
        <div class="copyright">
          Copyright (c) 2022 PedroPetshop Copyright Holder All Rights Reserved.
        </div>
      </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>
</html>
