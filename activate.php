
<?php

include 'link.php';
include 'themancode.php';
if (!empty($_GET['token'])) {
	$token = $_GET['token'];

	$updatequery = " update redcart set status='active' where token='$token' or username='$token' or email='$token' ";
    $fetch = mysqli_fetch_array(mysqli_query($con,"SELECT * from redcart WHERE token='$token' or username='$token' or email='$token' "));
	$query =  mysqli_query($con,$updatequery);
	if ($query) {
		$msg = "Hi {$fetch['name']} your account is now active ";
	}else{
		$msg = "account activation is failed";
	}
}else{
		$msg = "Something went wrong";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Activation</title>
</head>
<body>
	<div class="container mt-5">
		<div class="row">
			<div class="card">
				<div class="card-body">
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong><a href="index.php">Home</a> : </strong><?php
                      if(isset($msg))
                      {
                      	echo $msg;
                      }
                      ?>
					  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>



