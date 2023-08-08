<?php 
session_start();

sleep(2);
include 'cart_cal.php';
if (!isset($_SESSION['user_id'])) {
       header('Location:index.php');
       die();
 }
date_default_timezone_set("Asia/Calcutta");
$uid = $_SESSION['user_id'];
$jsonLimit=array();
$type = $_POST['type'];
if(isset($_POST['cod']) && $type =="payRequestforCod"){
$order_id = date('Ymdhisa').bin2hex(random_bytes(2));

$delivered = date("Y/m/d", strtotime(' +3 day'));

$cod = mysqli_real_escape_string($con,$_POST['cod']);
$number = mysqli_real_escape_string($con,$_POST['number']);

$order_update = mysqli_query($con,"update order_items set order_id='$order_id',delivered='$delivered',processed='10',status='confirmed' where user_id='$uid' and status='added_in_cart' ");

   // for confirmed

$cart_data = mysqli_query($con,"select * from order_items where order_id='$order_id' and status='confirmed' ");
$data = mysqli_fetch_array($cart_data);

$total_vat;
$email = $data['email'];
$username = $data['username'];
$address = $data['address'];
$zip = $data['zip'];
$cod = $_POST['cod'];
$image = $data['image'];
if (isset($_SESSION['COUPON_ID'])) {
    $coupon_id = $_SESSION['COUPON_ID'];
    $coupon_str = $_SESSION['COUPON_CODE'];
    $coupon_value = $_SESSION['COUPON_VALUE'];
    $cart_value =$_SESSION['cart_value'];

    $html = '<div class="container">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <div class="modal-body">
                <img src="https://tipusultan.epizy.com/images/mancode.jpg" style="width:632x; height:170px;border-radius:20px;">
                  
                  <table class="table table-striped table-bordered mt-5">
                    <tr>
                      <td>Name :</td>
                      <td><h5>Hi, '.$username.'</h5></td>
                    </tr>
                    <tr>
                      <td>Message :</td>
                      <td>Your order placed successfully ORDEER NO. :'.$order_id.'</td>
                    </tr>
                    <tr>
                      <td>Amount :</td>
                      <td><h5>Your total amount : '.$total_vat.'</h5></td>
                    </tr>
                    <tr>
                      <td>Link :</td>
                      <td><h5><strong><a href="http://localhost/fastcart/invoice.php?invoice='.$order_id.'">Click here to download invoice</a></strong></h5></td>
                    </tr>
                    <tr>
                      <td>Contact Us :</td>
                      <td>for further problems please contact this number 9919408817 Thank You </td>
                    </tr>
                  </table>                        
             </div>

        </div>
      </div>
    </div>
  </div>';

 include('sendmail.php');
  if($mail->send()){

     $confirms = mysqli_query($con,"insert into confirm(order_id,txn_id,user_id,username,email,number,address,price,total_item,image,coupon_id,coupon_value,coupon_code,cod,zip,status,date)values('$order_id','COD','$uid','$username','$email','$number','$address',$cart_value,$total_cart,'$image',$coupon_id,'$coupon_value','$coupon_str','$cod','$zip','pending','$delivered')");

        $item_fetch = mysqli_query($con, "select * from order_items where order_id='$order_id'");
while($items = mysqli_fetch_array($item_fetch))
{
    $itemid = $items['item_id'];
    $qty = $items['quantity'];
    $qty_update = mysqli_query($con,"update items set qty=qty-$qty where id=$itemid"); 
} 
  }
    }else{
    
$html = '<div class="container">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <div class="modal-body">
                <img src="https://tipusultan.epizy.com/images/mancode.jpg" style="width:632x; height:170px;border-radius:20px;">
                  
                  <table class="table table-striped table-bordered mt-5">
                    <tr>
                      <td>Name :</td>
                      <td><h5>Hi, '.$username.'</h5></td>
                    </tr>
                    <tr>
                      <td>Message :</td>
                      <td>Your order placed successfully ORDEER NO. :'.$order_id.'</td>
                    </tr>
                    <tr>
                      <td>Amount :</td>
                      <td><h5>Your total amount : '.$total_vat.'</h5></td>
                    </tr>
                    <tr>
                      <td>Link :</td>
                      <td><h5><strong><a href="http://localhost/fastcart/invoice.php?invoice='.$order_id.'">Click here to download invoice</a></strong></h5></td>
                    </tr>
                    <tr>
                      <td>Contact Us :</td>
                      <td>for further problems please contact this number 9919408817 Thank You </td>
                    </tr>
                  </table>                        
             </div>

        </div>
      </div>
    </div>
  </div>';

  include('sendmail.php');
  if($mail->send()){

    $confirm = mysqli_query($con,"insert into confirm(order_id,txn_id,user_id,username,email,number,address,price,total_item,image,coupon_value,cod,zip,status,date)values('$order_id','COD','$uid','$username','$email','$number','$address',$total_vat,$total_cart,'$image','0','$cod','$zip','pending','$delivered')");

    $item_fetch = mysqli_query($con, "select * from order_items where order_id='$order_id'");
while($items = mysqli_fetch_array($item_fetch))
{
    $itemid = $items['item_id'];
    $qty = $items['quantity'];
    $qty_update = mysqli_query($con,"update items set qty=qty-$qty where id=$itemid"); 
} 
    }
    }   
$notify = mysqli_query($con,"insert into notify (user_id,message)values('$uid','Hi $users you order new product')");

if($notify){
	$jsonLimit=array('redirect'=>'yes','ord_msg'=>'order-id-'.$order_id);

}else{
	$jsonLimit=array('redirect'=>'yes');
}
unset($_SESSION['COUPON_ID']);
    unset($_SESSION['COUPON_CODE']);
    unset($_SESSION['COUPON_VALUE']);
    unset($_SESSION['cart_value']);
  }
echo json_encode($jsonLimit); 
 ?>

 