<?php
 
  include 'themancode.php';

  if(isset($_SESSION['user_id'])){
     $uid = $_SESSION['user_id'];
    $confirm = mysqli_query($con,"SELECT * FROM redcart WHERE user_id='$uid'");
    $view = mysqli_fetch_assoc($confirm);
    $users = $view['name'];
    $user_id = $view['user_id'];
    $usernames = $view['username'];
    $image = $view['image'];
    $email = $view['email'];
    $address = $view['address'];
    $state = $view['state'];
    $otp = $view['otp'];
    $mobile = $view['mobile'];

  }
if (isset($_SESSION['user_id'])) {
include 'themancode.php';
           if (isset($_SESSION['user_id'])) {
              $uid = $_SESSION['user_id'];
              $cart_item = mysqli_query($con,"SELECT * FROM order_items WHERE user_id='$uid' and status='added_in_cart'");
            }else{
              $cid = $_SESSION['client_id'];
            $cart_item = mysqli_query($con,"SELECT * FROM order_items WHERE user_id='$cid' and status='added_in_cart'");
            }
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
             $cp = "Apply coupon First60";
           }else{
            $cp = "Apply coupon First50";
           }
                      
           if ($amount>1000) {
             $shipped  = "Free";
             $total_vat = ($amount+$gst);
           }else{
            $shipped = 70;
            $total_vat = ($amount+$gst+$shipped);
            $_SESSION['total_vat'] = $total_vat;
           }
 }



 if (isset($_SESSION['user_id']) || isset($_SESSION['client_id'])) {
           include 'themancode.php';
           if (isset($_SESSION['user_id'])) {
              $uid = $_SESSION['user_id'];
              $confirm_item = mysqli_query($con,"SELECT * FROM confirm WHERE user_id='$uid' and status='pending'");
            }else{
              $cid = $_SESSION['client_id'];
            $confirm_item = mysqli_query($con,"SELECT * FROM confirm WHERE user_id='$cid' and status='pending'");
            }
           $coupon_value = 0;
           $total_pay_amount = 0;
           $count_order = mysqli_num_rows($confirm_item);
           while($minuscart = mysqli_fetch_array($confirm_item)){
            $total_pay_amount = $total_pay_amount + $minuscart['price'];
            $coupon_value = $coupon_value + $minuscart['coupon_value'];

            }
 }
 if (isset($_SESSION['user_id']) || isset($_SESSION['client_id'])) {
           include 'themancode.php';
            if (isset($_SESSION['user_id'])) {
              $uid = $_SESSION['user_id'];
              $order_item = mysqli_query($con,"SELECT * FROM order_items WHERE user_id='$uid' and status='confirmed'");
            }else{
              $cid = $_SESSION['client_id'];
            $order_item = mysqli_query($con,"SELECT * FROM order_items WHERE user_id='$cid' and status='confirmed'");
            }
           $order_amount = 0;
           $order_gst = 0;
           $count_item = mysqli_num_rows($order_item);
           while($cart = mysqli_fetch_array($order_item)){

                $order_amount = $order_amount + $cart['price_num'];

            }
           $order_gst = ($order_amount*18/100);

           if ($order_amount>1000) {
             $order_shipped  = "Free";
             $order_total = ($order_amount+$order_gst-$coupon_value);
           }else{
            $order_shipped = 70;
            $order_total = ($order_amount+$order_gst+$order_shipped-$coupon_value);
           }
 }
 ?>