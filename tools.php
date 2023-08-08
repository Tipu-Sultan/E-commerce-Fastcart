
<?php
session_start();
if (isset($_SESSION['user_id'])) {
      $uid= $_SESSION['user_id'];
}

include 'cart_cal.php';
require('functions.inc.php');
$jsonLimit=array();

$type= get_safe_value($con,$_POST['type']);
if ($type == 'plus') {
  $id= get_safe_value($con,$_POST['id']);
  $limit = mysqli_fetch_array(mysqli_query($con,"select * from order_items where item_id='{$id}' and user_id='{$uid}' and status='added_in_cart'"));
$quantity = $limit['quantity'];
 // for first like
$cart_q = mysqli_query($con,"select * from items where id=$id ");  
$incp = mysqli_fetch_array($cart_q);
$price = $incp['price'];
  if ($quantity<5) {
$id= get_safe_value($con,$_POST['id']);
$up = mysqli_query($con,"update order_items set price_num=price_num+$price where item_id='{$id}' and user_id='{$uid}' and status='added_in_cart'");
$plus = mysqli_query($con,"update order_items set quantity=quantity+1 where item_id='{$id}' and user_id='{$uid}' and status='added_in_cart'");
}else{
  $jsonLimit=array('is_error'=>'yes','dd'=>'You can buy only 5 items at a time');
}
}else if($type == 'minus'){
  $id= get_safe_value($con,$_POST['id']);
  $limit = mysqli_fetch_array(mysqli_query($con,"select * from order_items where item_id='{$id}' and user_id='{$uid}' and status='added_in_cart'"));
$quantity = $limit['quantity'];
 // for first like
$cart_q = mysqli_query($con,"select * from items where id=$id ");  
$incp = mysqli_fetch_array($cart_q);
$price = $incp['price'];
  if ($quantity>1) {
    $id= get_safe_value($con,$_POST['id']);
 $ups = mysqli_query($con,"update order_items set price_num=price_num-$price where item_id='{$id}' and user_id='{$uid}' and status='added_in_cart' ");
 $minus = mysqli_query($con,"update order_items set quantity=quantity-1 where item_id='{$id}' and user_id='{$uid}' and status='added_in_cart'");
}
else{
  $jsonLimit=array('is_error'=>'yes','dd'=>'At least buy 1 item');
}
}else if($type == 'remove_item'){
  $id= get_safe_value($con,$_POST['id']);
     $uid= $_SESSION['user_id'];
    $delete_query="delete from order_items where user_id='{$uid}' and item_id=$id and status='added_in_cart' ";
    $delete_query_result=mysqli_query($con,$delete_query) or die(mysqli_error($con));
    
}
else if($type == 'notify'){
  $pid= $_POST['id'];
    $size=mysqli_query($con,"update notify set status='1' where  id='{$pid}'") or die(mysqli_error($con));
    
}else if($type == 'testimonial' && !empty($_POST['comments'])){
  $comment = $_POST['comments'];
  $insert_cmt = mysqli_query($con,"INSERT INTO testimonial (user_name,image,testimonial)values('$users','$image','$comment')");
  if ($insert_cmt) {
    $jsonLimit = array('error'=>'no','msg'=>'<p class="text-success">Review Listed .</p>');
  }else{
    $jsonLimit = array('error'=>'yes','msg'=>'Something went wrong');
  }
}



if ($type == "wishlist"|| $type == 'sizes' || $type == 'color') {
$user_id=$_SESSION['user_id'];

if ($type == 'wishlist') {
$pid = $_POST['pid'];
$slug_items = mysqli_query($con,"select * from items where id=$pid ");
$item_id = mysqli_fetch_assoc($slug_items);
$slug_id = $item_id['id'];

$cartlist = mysqli_query($con,"select * from order_items where status='wishlist' and item_id={$slug_id} and user_id='$user_id' ");

$added_in_cart = mysqli_query($con,"select * from order_items where status='added_in_cart' and item_id={$slug_id} and user_id='$user_id' ");  
$wish_count = mysqli_num_rows($cartlist);
$add_count = mysqli_num_rows($added_in_cart);
if ($wish_count>0 || $add_count>0) {
    $jsonLimit = array('error'=>'yes','msg'=>'Already in Wishlist');
}else {
  // for cartadded
    $item_ref_id ="TMC".(date('m')).bin2hex(random_bytes(3));
    $slug = $item_id['slug'];
    $price_num = $item_id['price'];
    $item_name = $item_id['name'];
    $size = $item_id['size'];
    $colors = $item_id['colors'];
    $type = $item_id['type'];
    $brief_info = $item_id['brief_info'];
    $image = $item_id['image'];
    $processed = date("Y/m/d");

$add_to_copy="insert into order_items(item_ref_id,slug,user_id,item_id,price_num,item_name,type,brief_info,image,status,processed,delivered) values('$item_ref_id','$slug','$user_id',$slug_id,$price_num,'$item_name','$type','$brief_info','$image','wishlist','0','$processed')";

 $add_to_cart_copy=mysqli_query($con,$add_to_copy) or die(mysqli_error($con));

 $jsonLimit = array('error'=>'no','msg'=>'Item wishlisted');
}
}

if ($type == 'sizes' || $type == 'color') {
$sid= get_safe_value($con,$_POST['sid']);
$cid= get_safe_value($con,$_POST['cid']);

$pid = $_POST['pid'];
$slug_items = mysqli_query($con,"select * from items where id=$pid ");
$item_id = mysqli_fetch_assoc($slug_items);
$slug_id = $item_id['id'];

$cartlist = mysqli_query($con,"select * from order_items where status='wishlist' and item_id={$slug_id} and user_id='$user_id' ");

$added_in_cart = mysqli_query($con,"select * from order_items where status='added_in_cart' and item_id={$slug_id} and user_id='$user_id' ");  
$wish_count = mysqli_num_rows($cartlist);
$add_count = mysqli_num_rows($added_in_cart);
if ($wish_count>0 || $add_count>0) {
  if($type == 'sizes'){
  $id= get_safe_value($con,$_POST['pid']);
  $uid= $_SESSION['user_id'];
  $sid= get_safe_value($con,$_POST['sid']);
  $size=mysqli_query($con,"update order_items set size='$sid' where item_id={$id} and user_id='{$uid}'") or die(mysqli_error($con));
    $jsonLimit = array('error'=>'yes','msg'=>'size updated in Wishlist');
}else if($type == 'color'){
  $id= get_safe_value($con,$_POST['pid']);
  $uid= $_SESSION['user_id'];
  $cid= get_safe_value($con,$_POST['cid']);
  $color=mysqli_query($con,"update order_items set colors='$cid' where item_id={$id} and user_id='{$uid}'") or die(mysqli_error($con));
 $jsonLimit = array('error'=>'yes','msg'=>'color updated in Wishlist');   
}
}else {
  // for cartadded
    $item_ref_id ="TMC".(date('m')).bin2hex(random_bytes(3));
    $slug = $item_id['slug'];
    $price_num = $item_id['price'];
    $item_name = $item_id['name'];
    $size = $item_id['size'];
    $colors = $item_id['colors'];
    $type = $item_id['type'];
    $brief_info = $item_id['brief_info'];
    $image = $item_id['image'];
    $processed = date("Y/m/d");

$add_to_copy="insert into order_items(item_ref_id,slug,user_id,item_id,price_num,item_name,size,colors,type,brief_info,image,status,processed,delivered) values('$item_ref_id','$slug','$user_id',$slug_id,$price_num,'$item_name','$sid','$cid','$type','$brief_info','$image','wishlist','0','$processed')";

 $add_to_cart_copy=mysqli_query($con,$add_to_copy) or die(mysqli_error($con));

 $jsonLimit = array('error'=>'no','msg'=>'Item wishlisted');
}
}

}

if ($type == 'pin' && isset($_POST['zip'])) {
  $pin = $_POST['zip'];
  $search_pin = mysqli_num_rows(mysqli_query($con,"select * from pin where pin=$pin"));
  if ($search_pin==1)
  {
  $jsonLimit = array('error'=>'no','msg'=>'<span class="text-success">Yes! We delivered here</span>');

  }else if ($search_pin==0)
  {
    $insert_pin = mysqli_query($con,"insert into pin(pin)values($pin)");
    $jsonLimit = array('error'=>'no','msg'=>'Sorry! Delivery not available');
  }
}

if ($type == 'Verifyupi') {
  $upid  = $_POST['upid'];
  $upi = mysqli_query($con,"select * from redcart where upi_id='$upid'");
  $count = mysqli_num_rows($upi);
  if ($count>0) {
    $jsonLimit = array('error'=>'no','msg'=>'<span class="text-success">Verified <i class="fa fa-check" aria-hidden="true"></i></span>');
  }else{
    $jsonLimit = array('error'=>'yes','msg'=>'<span class="text-danger">Upi Not found</span>');
  }
}

if ($type == 'geoloc') {
  $search  = $_POST['search'];
  $upi = mysqli_query($con,"select * from pin where pin='$search'");
  $count = mysqli_num_rows($upi);
  if ($count>0) {
    $jsonLimit = array('error'=>'no','msg'=>'<p class="text-success">Delivery available within 2 days <i class="fa fa-check" aria-hidden="true"></i></p>');
  }else{
    $jsonLimit = array('error'=>'yes','msg'=>'<p class="text-danger">Delivery not available on this location</p>');
  }
}

if ($type == 'knowmore') {
  $id  = $_POST['id'];
  $knowm = mysqli_query($con,"select * from trending_item where id='$id'");
  $item_data = mysqli_fetch_array($knowm);
  $count = mysqli_num_rows($knowm);
  if ($count>0) {
    $_SESSION['proID'] = $item_data['id'];
    $jsonLimit = array('is_error'=>'no','pid'=>$item_data['id'],'img'=>$item_data['image'],'price'=>$item_data['price'],'name'=>$item_data['name']);
  }
}

if ($type == 'reviews') {
  $reviews  = $_POST['reviews'];
  $img  = $_POST['img'];
  $usid  = $_POST['uid'];
  $pid = $_POST['pid'];
  $data_review = mysqli_query($con,"insert into product_review(image,uid,pid,review)values('$image','$usid','$pid','$reviews')");
  if ($data_review) {
    $jsonLimit = array('is_error'=>'no');
  }
}


echo json_encode($jsonLimit); 
 ?>
