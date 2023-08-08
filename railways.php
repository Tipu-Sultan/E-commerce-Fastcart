<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Railways</title>
	<?php include('link.php') ?>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="row">
					<div class="col-lg-12">
						<div class="card-header bg-info">
					<h3 class="text-center">Railway Registration</h3>
				</div>
				<div class="card-body  justify-content-center">
					<div class="d-flex flex-row align-items-center mb-3">
                            <i class="text-dark fas fa-user fa-lg me-3 fa-fw"></i>
                            <div class="form-outline mb-0">
                              <input type="text" id="names" name="names" value="" class="form-control "  required="" />
                              <label class="form-label" for="name">First Name</label>
                            </div>
                    </div>

                     <div class="d-flex flex-row align-items-center mb-3">
                            <i class="text-dark fas fa-user fa-lg me-3 fa-fw"></i>
                            <div class="form-outline mb-0">
                              <input type="text" id="names" name="names" value="" class="form-control "  required="" />
                              <label class="form-label" for="name">Last Name</label>
                            </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-3">
                            <i class="text-dark fas fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline mb-0">
                              <input type="password" id="pwd" name="pwd" value="" class="form-control "  required="" />
                              <label class="form-label" for="name">Make a password</label>
                            </div>
                    </div>

                     <div class="sizes mt-3">
                                <h6 class="text-uppercase">Gender</h6>
                                <label class="radio">
                                <input onclick="" type="radio" name="sizes" value="" >
                                <span>Male</span>
                                </label>
                                <label class="radio">
                                <input onclick="" type="radio" name="sizes" value="" >
                                <span>Female</span>
                                </label>
                                <label class="radio">
                                <input onclick="" type="radio" name="sizes" value="" >
                                <span>Other</span>
                                </label>
                            </div>
                            <p class="mt-3"><input type="checkbox" name="agree" value="i have done this"   required="" /> I agree with terms & conditions</p>
                    <div class="d-flex flex-row align-items-center  mt-3">
                            <div class="form-outline flex-fill mb-0">
                              <button class="btn btn-primary" type="submit">Registrer now</button>
                              <input type="reset" id="names" name="reset" value="reset" class="btn btn-outline-danger" />
                            </div>

                    </div>
				</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
if (isset($_POST['submit'])) {
	$fname= mysqli_real_escape_string($con,$_POST['fname']);
	$lname= mysqli_real_escape_string($con,$_POST['lname']);
	$pwd= mysqli_real_escape_string($con,$_POST['pwd']);
	$agree= mysqli_real_escape_string($con,$_POST['agree']);

	$hash = md5($pwd);

	$insert = mysqli_query($con, "insert into(fname,lname,pwd,agree)values('$fname','$lname','$hash','$agree')");
}
 ?>
</body>
</html>