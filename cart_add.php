<?php
date_default_timezone_set("Asia/Calcutta");
    session_start();
    if (!isset($_SESSION['user_id'])) {
       header('Location:index.php');
       die();
     }
if (isset($_SESSION['user_id'])) {
    require 'themancode.php';
    //require 'header.php';
if (isset($_GET['item_id'])) {
$jsonLimit = array();
$user_id=$_SESSION['user_id'];
$item_id=$_GET['item_id'];
$items = mysqli_fetch_array(mysqli_query($con,"select * from items where id='$item_id' or slug='$item_id'"));
$iid = $items['id'];
$slugid  = $items['slug'];

$cartlist = mysqli_query($con,"select * from order_items where user_id='$user_id' and status='wishlist' and  slug='$slugid' or item_id=$iid ");

$added_in_cart = mysqli_query($con,"select * from order_items where user_id='$user_id' and status='added_in_cart' and  slug='$slugid' or item_id=$item_id"); 
 $wish_count = mysqli_num_rows($cartlist);
 $add_count = mysqli_num_rows($added_in_cart);
// for cartadded
    $item_ref_id ="TMC".(date('m')).bin2hex(random_bytes(3));
    $price_num = $items['price'];
    $slug = $items['slug'];
    $item_name = $items['name'];
    $size = $items['size'];
    $colors = $items['colors'];
    $type = $items['type'];
    $brief_info = $items['brief_info'];
    $image = $items['image'];
    $processed = date("Y/m/d");

if ($wish_count>0 || $add_count>0) {
    $add_to_cart_query="update order_items set status='added_in_cart',quantity='1',processed='0',delivered='{$processed}' where user_id='$user_id' and status='wishlist' and  item_id=$iid";
$add_to_cart_result=mysqli_query($con,$add_to_cart_query) or die(mysqli_error($con));

    if ($add_to_cart_query) {
        header('Location:cart.php');
    }
    $jsonLimit = array('error'=>'yes','msg'=>'Already in Wishlist');
}else {
  

 $add_to_copy="insert into order_items(item_ref_id,slug,user_id,item_id,price_num,item_name,size,colors,type,brief_info,image,status,processed,delivered) values('$item_ref_id','{$slug}','$user_id',$iid,$price_num,'$item_name','$size','$colors','$type','$brief_info','$image','wishlist','0','$processed')";

 $add_to_cart_copy=mysqli_query($con,$add_to_copy) or die(mysqli_error($con));

 $jsonLimit = array('error'=>'no','msg'=>'Item wishlisted');
}
 

    echo json_encode($jsonLimit);
}
}else{
    echo "<h2 style='text-align: center;margin-top: 100px;'>Please login <a href='#' data-mdb-toggle='modal' data-mdb-target='#login'>click here</a></h2>";
}
?>
