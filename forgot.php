

<?php
sleep(1); 
session_start();

include 'themancode.php';
$otpArr = array();
$type  = $_POST['type'];
if ($type == 'otp' && !empty($_POST['email'])) { 
  $email = $_POST['email'];
  $dataquery = mysqli_query($con,"SELECT * FROM redcart where email = '$email' or username = '$email'");
  $count = mysqli_num_rows($dataquery);
  $fetch = mysqli_fetch_array($dataquery);
  $digits = 6; 
  $otp = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
  if ($count>0) {
  $update = mysqli_query($con,"update redcart set otp=$otp where email = '$email' or username = '$email'");
  if ($update) {
  $html = '<div class="container">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <div class="modal-body">
                <img src="https://tipusultan.epizy.com/images/mancode.jpg" style="width:632x; height:170px;border-radius:20px;">
                  
                  <table class="table table-striped table-bordered mt-5">
                    <tr>
                      <td>Name :</td>
                      <td><h5>Hi, '.$fetch['name'].'</h5></td>
                    </tr>
                    <tr>
                      <td>Message :</td>
                      <td>Password resetting requested to your email: '.$fetch['email'].'</td>
                    </tr>
                    <tr>
                      <td>Link :</td>
                      <td><h5><strong>Your OTP is : '.$otp.'</strong></h5></td>
                    </tr>
                    <tr>
                      <td>Contact Us :</td>
                      <td>for further problems please contact on this number 9919408817 Thank You </td>
                    </tr>
                  </table>                        
             </div>

        </div>
      </div>
    </div>
  </div>';

 include('sendmail.php');
  if($mail->send()){
    $otpArr = array('opt_er'=>'no','msg'=>'<p class="text-success text-center">Hi '.$fetch['name'].' your OTP send to your mail id </p>');
  }
  }else{
    $otpArr = array('is_error' =>'yes','msg'=>'<p class="text-danger text-center">OTP Sending failed</p>');
  }
}else{
    $otpArr = array('is_error' =>'yes','msg'=>'<p class="text-danger text-center">Email not found</p>');
}
}


if ($type == 'resetapss') {
$otp= mysqli_real_escape_string($con, $_POST['otp']) ;  
$password= mysqli_real_escape_string($con, $_POST['password']) ;
$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']) ;
         
$pass = password_hash($password, PASSWORD_BCRYPT);
$cpass = password_hash($cpassword, PASSWORD_BCRYPT);
$resetapss = mysqli_query($con,"SELECT * FROM redcart where otp='$otp'");
$count  = mysqli_num_rows($resetapss);
if ($count>0) {
  $res = mysqli_fetch_array($resetapss);
  $otps = $res['otp'];
if ($otps === $otp) {
  if (strlen($password)>7){
$pass = mysqli_query($con,"update redcart set password='$pass',cpassword='$cpass' where otp='$otp'");
  if ($pass) {
  $otpArr = array('is_error' =>'no','msg'=>'<p class="text-success text-center">Password changed successfully</p>');
  }else{
    $otpArr = array('is_error' =>'yes','msg'=>'<p class="text-danger text-center">Password not changed</p>');
  }
}else{
  $otpArr = array('is_error' =>'yes','msg'=>'<p class="text-danger text-center">Password must be at least 8 Alphanumerics</p>');
}
}else{
      $otpArr = array('is_error' =>'yes','msg'=>'<p class="text-danger text-center">OTP not matched or Expire</p>');
}

}else{
      $otpArr = array('is_error' =>'yes','msg'=>'<p class="text-danger text-center">OTP not matched or Expire</p>');
}
}

echo json_encode($otpArr);
 ?>