<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>OTP</title>
	<?php require('nav.php');
	if (isset($_SESSION['COUPON_ID'])) {
    $coupon_id = $_SESSION['COUPON_ID'];
    $coupon_str = $_SESSION['COUPON_CODE'];
    $coupon_value = $_SESSION['COUPON_VALUE'];
    $cart_value =$_SESSION['cart_value'];
    }else{
    $coupon_id = '';
    $coupon_str = '';
    $coupon_value = '';
    $cart_value = '';
    }

    
	  ?>
</head>
<body>
<div class="container mt-5">
	<div class="row ">
		<div class="col-lg-12 d-flex  justify-content-center">
			<div class="card  w-50 d-flex  justify-content-center">
				<h5 class="text-center text-success">An OTP email send on your email</h5>
				<div class="card-body">
					<table class="table">
						<tr>
							<td>Name :</td>
							<td><?php echo $_SESSION['card_holder'] ?></td>
						</tr>
						<tr>
							<td>Txn id :</td>
							<td class="text-uppercase"><?php echo $_SESSION['new_txn'] ?></td>
						</tr>
						<tr>
							<td>Amount :</td>
							<td><?php
                  if (isset($_SESSION['COUPON_ID'])) {
                    echo $cart_value;
                  }else{
                 echo $total_vat ;
               }
                  ?></td>
						</tr>
					</table>
          <form method="post" id="otpverification">
				<div class="">
                    <input
                      type="tel"
                      class="form-control"
                      name="otp"
                      id="otp"
                      value=""
                      placeholder="OTP"
                    />
                    <input
                      type="text"
                      class="form-control form-control-lg"
                      name="type"
                      id="type"
                      value="payRequestforOtp"
                      hidden=""
                    />
                  </div>
                  <button id="upi_btn" class="btn btn-info btn-lg btn-block mt-3" name="submit">proceed OTP</button>
                  <div id="otpmsg">
                    
                  </div>
                  </form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  jQuery('#otpverification').on('submit',function(e){
    $("#upi_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Requesting...</span>");
    jQuery('#upi_btn').attr('disabled',true);
    jQuery.ajax({
            type: 'POST',
            url: 'redirect.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
      success:function(result){
        var obj = jQuery.parseJSON(result);
         if(obj.redirect == 'yes'){
          window.location = 'onlinepay.php?txnId='+obj.tran_id;
        }else if(obj.redirect == 'no'){
          jQuery('#otpmsg').html(obj.msg);
          jQuery('#upi_btn').html('Retry');
        jQuery('#upi_btn').attr('disabled',false);
        }
      }
    });
    e.preventDefault();
  });
</script>
<?php include('footer.php'); ?>
</body>
</html>