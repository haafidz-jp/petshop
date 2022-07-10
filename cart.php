<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}session_start();

if(session_id() == '' || !isset($_SESSION)){session_start();}

include 'function.php';


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shopping Cart</title>
    <link rel="shortcut icon" href="img/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

  <!-- navigation bar -->
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
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
              <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="container">
      <div class="jumbotron cart-view">

          <h3 class="label-cart">Your Shopping Cart</h3>

            <?php
              if(isset($_SESSION['cart'])) {

            ?>

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                  </tr>
                </thead>
                <tbody>

            <?php
              $total = 0;
              foreach($_SESSION['cart'] as $product_id => $quantity) {

              $result = mysqli_query($conn,"SELECT * FROM products WHERE productid = ". $product_id);


              if($result){

                while($obj = $result->fetch_object()) {
                  $cost = $obj->price_product * $quantity; //work out the line cost
                  $total = $total + $cost; //add to the total cost
                  ?>

                      <tr>
                        <td><img src="img/products/<?php echo $obj->product_img_name?>" class="lazy-load" height="100px"></td>
                        <td><?php echo $obj->product_name ?></td>
                        <td><?php echo $quantity.'&nbsp;<a class="btn btn-quantity-plus btn-success" href="update-cart.php?action=add&id='.$product_id.'">+</a>&nbsp;<a class="btn btn-quantity-min btn-danger" href="update-cart.php?action=remove&id='.$product_id.'">-</a>'; ?></td>
                        <td><?php echo $cost ?></td>
                      </tr>
                  <?php
                }
              }

            }

            ?>
              <td colspan="3" align="right">Total</td>
              <td><?php echo $total ?></td>
            </tr>
            <tr>
              <td colspan="3"><a href="update-cart.php?action=empty" class="btn btn-danger">Empty Cart</a>&nbsp;<a href="product.php" class="btn btn-success">Continue Shopping</a></td>
              <td>
            <?php
            if(isset($_SESSION['login'])) {
              echo '<a href="orders-update.php"><button class="btn btn-info">Pay</button></a>';
            }

            else {
              echo '<a href="login.php"><button class="btn btn-info">Login</button></a>';
            }

            echo '</td>';

            echo '</tr>';

            ?>

          </tbody>
        </table>

        <?php
                  }


        else {
          echo "<p>You have no items in your shopping cart.</p> <a href='index.php'>Back to Home</a>";
        } ?>
        </div>
    </div>
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
            <br><input type="email" name="" value=""><button type="submit" class="btn-success" name="button"></button>
          </div>
        </div>
      </div>
      <div class="copyright">
        Copyright (c) 2022 PedroPetshop Copyright Holder All Rights Reserved.
      </div>
    </footer>


    <script type="text/javascript">
      var load = window.addEventListener("load", function() {


      });
      var resize = window.addEventListener("resize", function() {


      });
      var scroll = window.addEventListener("scroll", function() {


      });
      function loadImages() {
        var images = document.querySelectorAll(".lazy-load");

        for (var i = 0; i < immage.length; i++) {
          var imageBounds = images[i].getBoundingClientRect();

          if (imageBounds.top >= 0 &&
              imageBounds.left >= 0 &&
              imageBounds.bottom <= window.innerHeight &&
              imageBounds.right <= window.innerWidht) {
                images[i].src = "i"
          }
        }
      }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>
</html>
