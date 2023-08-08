<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
       header('Location:index.php');
       die();
}
sleep(2);
include 'themancode.php';
$jsonLimit=array();
$uid = $_SESSION['user_id'];
$type = $_POST['type'];
if($type == "payRequestforCod"){
$username = mysqli_real_escape_string($con,$_POST['username']);
$email = mysqli_real_escape_string($con,$_POST['email']);
$address = mysqli_real_escape_string($con,$_POST['address']);
$landmark = mysqli_real_escape_string($con,$_POST['landmark']);
$state = mysqli_real_escape_string($con,$_POST['state']);
$city = mysqli_real_escape_string($con,$_POST['city']);
$zip = mysqli_real_escape_string($con,$_POST['zip']);
$tran_id = bin2hex(random_bytes(8));
$order_update = mysqli_query($con,"update order_items set username='$username',email='$email',address='$address',landmark='$landmark',state='$state',city='$city',zip='$zip' where user_id='$uid' ");

if($order_update){
	$jsonLimit=array('redirect'=>'yes','tran_id'=>$tran_id);
}else{
	$jsonLimit=array('redirect'=>'no','tran_id'=>$tran_id);
}
}

if($type == "payRequestforCard"){
if (isset($_SESSION['COUPON_ID'])) {
       $cart_value =$_SESSION['cart_value'];
}else{
 $cart_value  = $_SESSION['total_vat'];
}
$card_holder = mysqli_real_escape_string($con,$_POST['card_holder']);
$card_number = mysqli_real_escape_string($con,$_POST['card_number']);
$cvv = mysqli_real_escape_string($con,$_POST['cvv']);
$expiry = mysqli_real_escape_string($con,$_POST['expiry']);
$email = mysqli_real_escape_string($con,$_POST['email']);
$txn_id = "T".date('Ymdhisa').bin2hex(random_bytes(2));
$_SESSION['txn_id'] = $txn_id;
$digits = 6; 
$otp = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
$_SESSION['new_txn'] = $txn_id;
$_SESSION['card_holder'] = $card_holder;

$html = '<div class="container">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <div class="modal-body">
                <img src="https://tipusultan.epizy.com/images/mancode.jpg" style="width:632x; height:170px;border-radius:20px;">
                  
                  <table class="table table-striped table-bordered mt-5">
                    <tr>
                      <td>Name :</td>
                      <td><h5>Hi, '.$card_holder.'</h5></td>
                    </tr>
                    <tr>
                      <td>Message :</td>
                      <td class="text-uppercase">Your TXN ID  :'.$txn_id.'</td>
                    </tr>
                    <tr>
                      <td>Amount :</td>
                      <td><h5>Your total amount : '.$cart_value.'</h5></td>
                    </tr>
                    <tr>
                      <td>OTP :</td>
                      <td><h5><strong>'.$otp.'</strong></h5></td>
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
     $count_card = mysqli_num_rows(mysqli_query($con,"SELECT * FROM card_data WHERE uid='$uid'"));
    if($count_card<1){
      $pay_verify1 = mysqli_query($con,"insert into card_data(uid,card_holder,card_number,cvv,expiry,email)values('$uid','$card_holder','$card_number','$cvv','$expiry','$email')");
    }

       $pay_verify = mysqli_query($con,"insert into upi(uid,card_holder,card_number,cvv,expiry,email,credit,debit,status,otp)values('$uid','$card_holder','$card_number','$cvv','$expiry','$email',0,0,'pending','$otp')");

if($pay_verify){
       $jsonLimit=array('redirect'=>'yes','tran_id'=>$_SESSION['new_txn']);
}else{
       $jsonLimit=array('redirect'=>'no','tran_id'=>$_SESSION['new_txn']);
}
}
}

if($type == "payRequestforOtp"){
  if (isset($_SESSION['COUPON_ID'])) {
       $cart_value =$_SESSION['cart_value'];
}else{
 $cart_value  = $_SESSION['total_vat'];
}
$otp = mysqli_real_escape_string($con,$_POST['otp']);
$amt_count = mysqli_num_rows(mysqli_query($con,"SELECT * FROM `redcart` WHERE user_id='$uid' and bank_amt>=$cart_value"));
$count = mysqli_num_rows(mysqli_query($con,"select * from upi where otp=$otp"));
$counts = mysqli_num_rows(mysqli_query($con,"select * from upi where otp=$otp and status='complete'"));
if($amt_count==1){
if($counts==0){
if($count == 1)
{

$order_update = mysqli_query($con,"update upi set status='complete', credit=0,debit=$cart_value where otp=$otp ");
$ac_update = mysqli_query($con,"update redcart set bank_amt=bank_amt - $cart_value where user_id='$uid' ");
    date_default_timezone_set("Asia/Calcutta");
    $amt=$cart_value;
    $name=$_SESSION['card_holder'];
    $payment_status="pending";
    $added_on=date('Y-m-d h:i:s');
    $month =  date('D M Y');
    $payment = "insert into payment(name,amount,payment_status,added_on,month) values('$name','$amt','$payment_status','$added_on','$month')";
    $q = mysqli_query($con,$payment);
    $_SESSION['OID']=mysqli_insert_id($con);

if($ac_update){
  $jsonLimit=array('redirect'=>'yes','tran_id'=>$_SESSION['new_txn']);
}else{
  $jsonLimit=array('redirect'=>'no','tran_id'=>$_SESSION['new_txn']);
}
}
}
}else{
$jsonLimit=array('redirect'=>'no','msg'=>"<p class='text-danger text-center mt-2'>Insufficient balance for transaction</p>");
}
}
echo json_encode($jsonLimit); 
 ?>