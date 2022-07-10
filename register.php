<?php
require 'function.php';
//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
/* if(session_id() == '' || !isset($_SESSION)){session_start();} */

if( isset($_POST["register"]) ){
  if( register($_POST) > 0 ){
      echo "
          <script>
              alert('Selamat Datang di Dunia Hewan');
              document.location.href='login.php';
          </script>
      ";
  } else {
      echo mysqli_error($conn);
  }
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
    <div class="register">
      <div class="row">
        <h2>Register</h2>
      </div>

      <!-- FORM REGISTER -->
      <form action="" method="post">
        <div class="form-group">
          <label for="first_name">Nama Depan</label>
          <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Nama Depan" required>
          <small id="first_name" class="form-text text-muted">Masukan Nama Depan</small>
        </div>
        <div class="form-group">
          <label for="last_name">Nama Belakang</label>
          <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Nama Belakang" required>
          <small id="last_name" class="form-text text-muted">Masukan Nama Belakang</small>
        </div>
        <div class="form-group">
          <label for="email">Alamat Email</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="Email" required> 
          <small id="email" class="form-text text-muted">Masukan Alamat E-mail</small>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
          <small id="password" class="form-text text-muted">Masukan password yang unik</small>
        </div>
        <div class="form-group">
          <label for="password2">Konfirmasi Password</label>
          <input type="password" name="password2" class="form-control" id="password2" placeholder="Konfirmasi Password" required>
          <small id="password2" class="form-text text-muted">Masukan Konfirmasi password</small>
        </div>
        <div class="form-group">
          <label for="user_address">Alamat</label>
          <textarea name="user_address" class="form-control" id="user_address" placeholder="Alamat" required></textarea>
          <small id="user_address" class="form-text text-muted">Masukan Alamat</small>
        </div>
        <div class="form-group">
          <label for="user_city">Kota</label>
          <input type="text" name="user_city" class="form-control" id="user_city" placeholder="Kota" required>
          <small id="user_city" class="form-text text-muted">Masukan Nama Kota</small>
        </div>
        <!-- User Sex -->
        <div class="form-group">
          <label for="user_sex">Jenis Kelamin</label>
            <div class="col-sm-10">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="user_sex" id="M" value="M" checked required>
                <label class="form-check-label" for="user_sex">
                  Laki-Laki
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="user_sex" id="F" value="F" required>
                <label class="form-check-label" for="user_sex">
                  Perempuan
                </label>
              </div>
            </div>
          <small id="user_sex" class="form-text text-muted">Pilih Jenis Kelamin</small>
        </div>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
            <!-- Button trigger modal -->
            <span>I agree to the </span><a href="" data-toggle="modal" data-target="#exampleModalScrollable">terms of service</a>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Terms of Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet iaculis metus, euismod finibus erat. Duis porttitor semper ex ac blandit. Aenean accumsan nisi eu massa malesuada porttitor. Sed blandit dolor nunc, ut sagittis quam aliquam et. Praesent rutrum quam in elit blandit molestie. Proin ut ante sit amet odio malesuada fermentum ut feugiat nulla. Morbi suscipit leo nibh, sed convallis libero rhoncus quis. Integer dictum consequat nibh quis efficitur. Suspendisse tristique metus id lacinia facilisis. Nulla faucibus sem sed dui rhoncus, quis posuere eros tincidunt. Nullam eros urna, volutpat vitae urna sed, consectetur elementum lacus. Aliquam volutpat bibendum felis non elementum. Duis varius justo in nulla fringilla, eu tristique magna hendrerit. Nam a ornare sem, in dapibus velit.
                      Nunc porta ipsum blandit, imperdiet orci id, molestie eros. Vestibulum elementum vitae turpis ut viverra. Mauris scelerisque nisi a metus tristique consequat. Ut sit amet vulputate tellus, eu varius velit. Ut tincidunt auctor lectus. Curabitur mauris ipsum, mollis vitae volutpat non, posuere ac nulla. Suspendisse potenti. Sed vitae vestibulum arcu. Integer ac rutrum nibh, eu imperdiet eros.
                      Fusce tempus nunc sit amet arcu dignissim, quis laoreet dolor placerat. In pretium, velit ac euismod mattis, justo magna tincidunt magna, nec tempus eros eros ac lectus. Ut tincidunt, sapien at feugiat malesuada, mi orci accumsan erat, in tincidunt tortor nunc et tellus. Integer quis ligula convallis, rutrum tellus nec, lacinia sem. Quisque imperdiet eros eget erat condimentum elementum. Suspendisse potenti. Etiam imperdiet nisi nec nulla molestie elementum vitae luctus erat. Quisque tristique ultricies nunc, non suscipit velit mattis vitae. Etiam pellentesque suscipit justo. Donec elementum est vitae arcu malesuada, ac consectetur nibh mollis. Fusce a quam quis lectus aliquet rhoncus et nec risus. Vivamus accumsan augue sed eros consequat, ac feugiat odio consequat. Donec posuere at libero eu lacinia. In hac habitasse platea dictumst. Maecenas scelerisque gravida vulputate. Nunc ut scelerisque lacus, iaculis auctor felis.
                      Cras tincidunt diam ut pellentesque convallis. Nullam nec placerat dui. Pellentesque vehicula elit in risus suscipit, at maximus risus ullamcorper. Nunc id libero sed orci pharetra tempus sit amet sed magna. Maecenas fermentum, magna eu imperdiet vehicula, nibh urna euismod sem, quis sollicitudin dui nunc ultrices metus. Nulla vel erat et lorem lobortis suscipit at ac est. Maecenas semper dictum ex, id ornare augue varius in. Nulla dapibus, purus at lobortis aliquam, nibh augue commodo felis, sit amet viverra enim diam eu nibh. Fusce rutrum interdum dolor a porta. Cras ultricies scelerisque lectus vel laoreet. Ut bibendum ullamcorper pretium. Morbi commodo elit vitae nulla gravida, eget iaculis orci feugiat. Curabitur semper massa velit, eu dapibus erat dapibus sed. Quisque dapibus convallis enim, consectetur sodales ante euismod eu.
                      Etiam cursus elementum odio eget laoreet. Morbi ornare pharetra nunc maximus blandit. Praesent tincidunt augue et metus iaculis, ut condimentum turpis blandit. Sed sit amet euismod lorem, ac varius lorem. Maecenas laoreet lacinia elit, et porttitor mauris laoreet eu. Integer condimentum eget quam consectetur sollicitudin. Aenean ac dui massa. Curabitur eget dui arcu. Nulla dictum tincidunt ante, vel lacinia risus lacinia in. Vivamus placerat justo erat, a molestie velit cursus molestie. Nam urna arcu, rutrum ut auctor eu, fringilla et nibh.
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" name="register" class="btn btn-success">Register</button>
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
