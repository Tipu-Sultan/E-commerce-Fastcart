<?php 
include 'cart_cal.php';
include 'link.php';
 $final_price = round($order_totals);
 if (isset($_SESSION['COUPON_ID'])) {
    $coupon_id = $_SESSION['COUPON_ID'];
    $coupon_str = $_SESSION['COUPON_CODE'];
    $coupon_value = $_SESSION['COUPON_VALUE'];
    $cart_value =$_SESSION['cart_value'];
    $fp =  round($cart_value);
    }
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<?php 
if (isset($_GET['order_id']) && isset($_GET['amt_id'])){
?>
<div class="container container-fluid mt-5">
   <div class="row justify-content-center" >
<div class="card w-50 bg-info bg-gradient">
    <div class="card-header">
        <h3>TheManCode Pay</h3>
    </div>
    <form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">
    <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" value="<?php echo $name; ?>" /><br/><br/>
    <input type="text" name="order_id" value="<?php echo $_GET['order_id'] ?>" hidden="">
    <input type="text" class="form-control" name="amt" id="amt" placeholder="Enter amt" value="<?php
                  echo $_GET['amt_id'];
                  ?>" /><br/>
    <input type="button" class="btn btn-primary" name="btn" id="btn" value="Pay Now" onclick="pay_now()"/>
</form>
</div>
</div> 
</div>
<?php
}else{
    ?>
    <div class="container container-fluid mt-5">
   <div class="row justify-content-center" >
<div class="card w-50 bg-info bg-gradient">
    <div class="card-header">
        <h3>TheManCode Pay</h3>
    </div>
    <form method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]);?>">
    <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" value="<?php echo $name; ?>" /><br/><br/>
    <input type="text" class="form-control" name="amt" id="amt" placeholder="Enter amt" value="<?php
                  if (isset($_SESSION['COUPON_ID'])) {
                    echo $fp;
                  }else{
                 echo $final_price ;
               }
                  ?>" /><br/>
    <input type="button" class="btn btn-primary" name="btn" id="btn" value="Pay Now" onclick="pay_now()"/>
</form>
</div>
</div> 
</div>
    <?php
}

 ?>
<script>
    function pay_now(){
        var name=jQuery('#name').val();
        var amt=jQuery('#amt').val();
        
         jQuery.ajax({
               type:'post',
               url:'payment_process.php',
               data:"amt="+amt+"&name="+name,
               success:function(result){
                   var options = {
                        "key": "rzp_test_4TXv7B3UorEY9h", 
                        "amount": amt*100, 
                        "currency": "INR",
                        "name": "Fastcart.com",
                        "description": "Test Transaction",
                        "image": "https://image.freepik.com/free-vector/logo-sample-text_355-558.jpg",
                        "handler": function (response){
                           jQuery.ajax({
                               type:'post',
                               url:'payment_process.php',
                               data:"payment_id="+response.razorpay_payment_id,
                               success:function(result){
                                   var sin = jQuery.parseJSON(result);
                                   if (sin.error =='no') {
                                    window.location.href='thank_you.php?txnId='+sin.pay;

                                   }
                               }
                           });
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
               }
           });
        
        
    }
</script>

