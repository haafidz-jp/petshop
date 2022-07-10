<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

?>

<!doctype html>
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
    <a class="navbar-brand" href="#">
      <img class="brand" src="img/logotext.png" alt="logo">
    </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <a class="navbar-brand" href="product.php">
        <img class="brand" src="img/logotext.png" alt="logo">
      </a>
      <li class="nav-item">
        <a class="nav-link" href="product.php">Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="product.php">Service</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="product.php">Location</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-1">
      <input class="form-control mr-sm-2" type="search" name="keyword" id="keyword" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search" id="search"><i class="fas fa-search"></i></button>
    </form>
    <div class="right-navbar">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a href="cart.php" class="nav-link"><i class="fas fa-shopping-cart"></i></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="profile.php?">Profile</a>
            <a class="dropdown-item" href="orders.php">Orders</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>


  <div class="container">
    <div class="jumbotron cart-view">
        <h3 class="label-cart">Selamat Pembayaran anda BERHASIL!</h3>
        <a href="index.php">Kembali ke Home</a>
    </div>
  </div>

<!-- footer -->
  <footer>
    <div class="container">
        <div class="row">
          <div class="col-md-4 mb-5">
            <h3>INFORMATION</h3>
            <br><a href="#">About Us</a>
            <br><a href="#">Contact Us</a>
            <br><a href="#">Find Us</a>
          </div>
          <div class="col-md-4 mb-5">
            <h3>CONTACT US</h3>
            <br><a href="#">Jl. Pedro si Kucing, Bekasi</a>
            <br><a href="#">0899 6212 8228</a>
            <br><a href="#">Instagram : @pedropetshop</a>
          </div>
          <div class="col-md-4 mb-5">
            <h3>NEWSLETTER</h3>
            <br>You may unsubscribe at any moment. For that purpose, please find our contact info in the legal notice.
            <br><input type="email" class="input-subscribe" placeholder="Subscribe NEWSLETTER.."   name="" value=""><button type="submit" class="btn-subscribe" name="button">SUBSCRIBE</button>
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
