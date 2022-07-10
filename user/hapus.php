<?php

require '../function.php';

session_start();

if( !isset($_SESSION["login"]) ){
  header("Location: ../index.php");
  exit;
}
if( $_SESSION["user_type"] != "admin" ){
  header("Location: ../index.php");
  exit;
}

$id = $_GET["productid"];

if( hapus($id) > 0 ){
    echo "
        <script>
            alert('Data Berhasil Dihapus!');
            if
            document.location.href='products.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data Gagal Dihapus!');
            document.location.href='products.php';
        </script>
    ";
}

?>