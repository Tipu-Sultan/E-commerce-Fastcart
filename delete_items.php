<?php 
session_start();
include('themancode.php');
  $uid = $_SESSION['user_id'];

  if (isset($_GET['cancel_items']) && isset($_GET['order_id']) && isset($_GET['qty'])) {
    $ref_id = mysqli_real_escape_string($con,$_GET['cancel_items']);
    $oid = mysqli_real_escape_string($con,$_GET['order_id']);
    $price = mysqli_real_escape_string($con,$_GET['price']);
    $qty = mysqli_real_escape_string($con,$_GET['qty']);

    $counts  = mysqli_num_rows(mysqli_query($con,"select * from order_items where order_id='$oid'"));
    if($counts == 1)
    {
      $order_items = mysqli_query($con,"DELETE FROM `order_items` WHERE item_ref_id='$ref_id' and status='confirmed'");
      $confirm_items = mysqli_query($con,"DELETE FROM `confirm` WHERE order_id='$oid'");
      if($confirm_items)
      {
        header('location:orders.php');
        die();
      }
    }
    else
    {
      $newPrice = ($price * $qty);
      $gst = ($newPrice * 18)/100;
      $actual_price = $newPrice + $gst;
      $del_cart = mysqli_query($con,"DELETE FROM `order_items` WHERE item_ref_id='$ref_id' and status='confirmed'");
      $confirm_update = mysqli_query($con,"UPDATE `confirm` SET price=price-$actual_price,total_item=total_item-$qty WHERE order_id='$oid' ");
      if($confirm_update)
      {
        header('location:order_details.php?order_id='.$oid);
        die();
      }
    }
  }
  ?>