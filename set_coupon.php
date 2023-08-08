

 <?php
session_start();
    require 'cart_cal.php';
 require('functions.inc.php');
 if (!isset($_SESSION['user_id'])) {
       header('Location:index.php');
       die();
     }
 // $sum = $_SESSION['tmt'];

$final_price = $total_vat;

$coupon_str=get_safe_value($con,$_POST['coupon_str']);
$res=mysqli_query($con,"select * from coupon_master where coupon_code='$coupon_str' and status='1'");
$count=mysqli_num_rows($res);
$jsonArr=array();

if (isset($_SESSION['COUPON_ID'])) {
    unset($_SESSION['COUPON_ID']);
    unset($_SESSION['COUPON_CODE']);
    unset($_SESSION['COUPON_VALUE']);
    unset($_SESSION['cart_value']);
}

if($count>0){
	$coupon_details=mysqli_fetch_assoc($res);
	$coupon_value=$coupon_details['coupon_value'];
	$id=$coupon_details['id'];
	$coupon_type=$coupon_details['coupon_type'];
	$cart_min_value=$coupon_details['cart_min_value'];
	
	if($cart_min_value>$final_price){
		$jsonArr=array('is_error'=>'yes','result'=>$final_price,'dd'=>'Cart total value must be '.$cart_min_value);
	}else{
		if($coupon_type=='Rupee'){
			$cart_value=$final_price-$coupon_value;
		}else{
			$coupon_value=(($final_price*$coupon_value)/100);
			$cart_value = $final_price-$coupon_value;
		}
      $dd = $coupon_value;
		$_SESSION['COUPON_ID']=$id;
		$_SESSION['COUPON_CODE']=$coupon_str;
		$_SESSION['COUPON_VALUE']=$dd;
		$_SESSION['cart_value']=$cart_value;
		$jsonArr=array('is_error'=>'no','result'=>round($cart_value),'dd'=>$dd. " ₹"."<span class='text-success'> coupon applied </span> <i class='fa fa-check-circle text-success' aria-hidden='true'></i>
",'minus_dd'=>"- <span class='text-success'>".$dd. " ₹ </span>");

	}
}else{
	$jsonArr=array('is_error'=>'yes','result'=>$cart_value,'dd'=>$dd.'Coupon code not found');
}

echo json_encode($jsonArr);
 ?>