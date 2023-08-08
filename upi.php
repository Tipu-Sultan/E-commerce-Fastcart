<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>UPI</title>
	<?php 
    include ('link.php');
     include ('cart_cal.php');
     include ('modals.php');

     ?>
</head>
<body>
<div class="container-fluid mt-5">
	<div class="row">
		<div class="col-lg-12 col col-md-12">
			<form id="upiform" method="POST">
			<div class="card">
				<div class="input-group">
					<input type="text" name="upid" id="upid" placeholder="Enter your UPI ID :" onkeyup="checkupi()">
					<input type="text" name="type" id="type" value="Verifyupi" hidden="">
					<button type="submit" id="upibtn" name="submit" class="btn btn-primary" >Verify</button>
				</div>
				<p id="upi_msg"></p>
			</div>
			</form>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
  function checkupi() {
        var val = document.getElementById('upid').value;
        if(val.length>5) {
            document.getElementById('upibtn').disabled='';
            document.getElementById("upi_msg").innerHTML = "Correct";
        }
        else {
          document.getElementById("upi_msg").innerHTML = "Please Enter Correct UPI ID";
            document.getElementById('upibtn').disabled='disabled';
        }
    }
  jQuery('#upiform').on('submit',function(e){
    $("#upibtn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Verifying...</span>");
    jQuery('#upibtn').attr('disabled',true);
    jQuery.ajax({
      url : 'tools.php',
      type : 'post',
      data:jQuery('#upiform').serialize(),
      success:function(result){
        var obj = jQuery.parseJSON(result);
        if(obj.error == 'no'){
        jQuery('#upi_msg').html(obj.msg);
        jQuery('#upibtn').html('recheck');
        jQuery('#upibtn').attr('disabled',false);
      }else{
        jQuery('#upi_msg').html(obj.msg);
        jQuery('#upibtn').html('Try again');
        jQuery('#upibtn').attr('disabled',false);
      }
      }
    });
    e.preventDefault();
  });
</script>
<?php include('footer.php'); ?>
</body>
</html>