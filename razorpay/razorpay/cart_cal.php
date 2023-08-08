<?php 
    session_start();
include 'dbase.php';

           $uid = $_SESSION['user_id'];
            $users = $_SESSION['username'];
            $name = $_SESSION['name'];
           $cartitem = mysqli_query($con,"SELECT * FROM order_items where user_id='$uid' and status='added_in_cart'");
           $amt_vat = 0;
           $total_cart = 0;
           while($cart = mysqli_fetch_array($cartitem)){
                       $amt_vat = $amt_vat + $cart['price_num'];
                       $total_cart = $total_cart + $cart['quantity'];

                  }
                  $total_cart;
           $amt_vat;
          $gst = 0;
          $shipped = 0;
          $gst = ($amt_vat*18)/100;
          if ($amt_vat>1000) {
             $order_shipped  = "Free";
             $order_totals = ($amt_vat+$gst);
           }else{
            $order_shipped = 70;
            $order_totals = ($amt_vat+$gst+$shipped);
           } 
 ?>