<?php
//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

include 'function.php';

if(isset($_SESSION['cart'])) {

  $total = 0;

  foreach($_SESSION['cart'] as $product_id => $quantity) {
    $result = $conn->query("SELECT * FROM products WHERE productid = ".$product_id);

    if($result){

      if($obj = $result->fetch_object()) {


        $cost = $obj->price_product * $quantity;

        $user = $_SESSION["email"];

        $query = $conn->query("INSERT INTO orders (product_code, product_name, price, units, total, email) VALUES( '$obj->product_code', '$obj->product_name', $obj->price_product, $quantity, $cost, '$user')");

        if($query){
          $newqty = $obj->qty_product - $quantity;
          if($conn->query("UPDATE products SET qty_product = '.$newqty.' WHERE productid = ".$product_id)){

          }
        }

        //send mail script
        $query = $conn->query("SELECT * from orders order by date desc");
        if($query){
          while ($obj = $query->fetch_object()){
            $subject = "Your Order ID ".$obj->id;
            $message = "<html><body>";
            $message .= '<p><h4>Order ID ->'.$obj->id.'</h4></p>';
            $message .= '<p><strong>Date of Purchase</strong>: '.$obj->date.'</p>';
            $message .= '<p><strong>Product Code</strong>: '.$obj->product_code.'</p>';
            $message .= '<p><strong>Product Name</strong>: '.$obj->product_name.'</p>';
            $message .= '<p><strong>Price Per Unit</strong>: '.$obj->price.'</p>';
            $message .= '<p><strong>Units Bought</strong>: '.$obj->units.'</p>';
            $message .= '<p><strong>Total Cost</strong>: '.$obj->total.'</p>';
            $message .= "</body></html>";
            $headers = "From: rizkyhh1999@gmail.com";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            $sent = mail($user, $subject, $message, $headers) ;
            if($sent){
              $message = "";
            }
            else {
              echo 'Failure';
            }
          }
        }
      }
    }
  }
}

unset($_SESSION['cart']);
header("location:success.php");

?>
