<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

include 'function.php';

$product_id = $_GET['id'];
$action = $_GET['action'];


if($action === 'empty')
  unset($_SESSION['cart']);

  $result = $conn->query("SELECT qty_product FROM products WHERE productid = ".$product_id);


if($result){

  if($obj = mysqli_fetch_object($result)) {

    switch($action) {

      case "add":
      if($_SESSION['cart'][$product_id]+1 <= $obj->qty_product)
        $_SESSION['cart'][$product_id]++;
      break;

      case "remove":
      $_SESSION['cart'][$product_id]--;
      if($_SESSION['cart'][$product_id] == 0)
        unset($_SESSION['cart'][$product_id]);
        break;



    }
  }
}


header("location:cart.php");


?>
