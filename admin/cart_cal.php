<?php 
session_start();
  include 'themancode.php';

  if(isset($_SESSION['user_id'])){
     $uid = $_SESSION['user_id'];
    $confirm = mysqli_query($con,"SELECT * FROM redcart WHERE user_id='$uid'");
    $view = mysqli_fetch_assoc($confirm);
    $users = $view['username'];
    $image = $view['image'];
    $email = $view['email'];
    $address = $view['address'];
    $state = $view['state'];
    $otp = $view['otp'];
    $mobile = $view['mobile'];

  }
if (isset($_SESSION['user_id'])) {
include 'themancode.php';
           $uid = $_SESSION['user_id'];
           $cart_item = mysqli_query($con,"SELECT * FROM order_items where user_id='$uid' and status='added_in_cart' ");
           $amount = 0;
           $gst = 0;
           $count_cart_items = mysqli_num_rows($cart_item);
           $total_cart = 0;
           while($cart = mysqli_fetch_array($cart_item)){
                       $amount = $amount + $cart['price_num'];
                       $total_cart = $total_cart + $cart['quantity'];

                  }
                  $total_cart;
           $gst = ($amount*18/100);

           if ($amount>3000) {
             $cp = "Apply coupon First50";
           }else{
            $cp = "Apply coupon First60";
           }
                      
           if ($amount>1000) {
             $shipped  = "Free";
             $total_vat = ($amount+$gst);
           }else{
            $shipped = 70;
            $total_vat = ($amount+$gst+$shipped);
           }
 }



 if (isset($_SESSION['user_id'])) {
           include 'themancode.php';
           $uid = $_SESSION['user_id'];
           $order_item = mysqli_query($con,"SELECT * FROM order_items WHERE user_id='$uid' and status='confirmed'");
           $order_amount = 0;
           $order_gst = 0;
           $count_item = mysqli_num_rows($order_item);
           while($cart = mysqli_fetch_array($order_item)){

                $order_amount = $order_amount + $cart['price_num'];

            }
           $order_gst = ($order_amount*18/100);

           if ($order_amount>1000) {
             $order_shipped  = "Free";
             $order_total = ($order_amount+$order_gst);
           }else{
            $order_shipped = 70;
            $order_total = ($order_amount+$order_gst+$order_shipped);
           }
 }
 ?>