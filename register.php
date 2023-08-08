    <?php
    session_start();
    sleep(1);
    $sign_arr = array();
    include 'themancode.php';
    if (!empty($_POST['password']) && !empty($_POST['username']) && !empty($_POST['email'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']) ;
    $username = mysqli_real_escape_string($con, $_POST['username']) ;
    $email = mysqli_real_escape_string($con, $_POST['email']) ;
    $password= mysqli_real_escape_string($con, $_POST['password']) ;
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']) ;
    $agree = mysqli_real_escape_string($con, $_POST['agree']) ;

    $len = strlen($username);

    $pass = password_hash($password, PASSWORD_BCRYPT);
    $cpass = password_hash($cpassword, PASSWORD_BCRYPT);
    $token =bin2hex(random_bytes(15));
    $user_id ="TMC".bin2hex(random_bytes(2));
    $emailquery = "select * from redcart where email='{$email}' and username='{$username}'";
    $query = mysqli_query($con,$emailquery);
    $emailcount = mysqli_num_rows($query);
    if($emailcount>0){

    $sign_arr = array('is_error'=>'yes','msgs'=>"<p class='text-danger text-center'>Email and User already taken </p>");
    }else{

    if (ctype_alnum($username)) {

    $sign_arr = array('is_error'=>'yes','msgs'=>'<p class="text-danger text-center">Username must be Alpha-numeric</p>');
    }else{
      if ($len < 8) {
        $sign_arr = array('is_error'=>'yes','msgs'=>'<p class="text-danger text-center">Username must be 8 chars like (az,AZ,09,@!#)</p></p>');
      }else{
    if($password === $cpassword){
      if (strlen($password)< 8) {
        $sign_arr = array('error'=>'yes','msg'=>'<p>Password must be 8 chars like (az,AZ,09,@!#)</p>');
      }else{
    $insertquery = "insert into redcart(user_id,name,username, email, password, cpassword, status,agree,token,image) values('$user_id','$name','$username','$email','$pass','$cpass','inactive','$agree','$token','user.png')";
    $iquery = mysqli_query($con, $insertquery);
    if ($iquery) {

      $html = '<div class="container">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <div class="modal-body">
                <img src="https://tipusultan.epizy.com/images/mancode.jpg" style="width:632x; height:170px;border-radius:20px;">
                  
                  <table class="table table-striped table-bordered mt-5">
                    <tr>
                      <td>Name :</td>
                      <td><h5>Hi, '.$name.'</h5></td>
                    </tr>
                    <tr>
                      <td>Message :</td>
                      <td>Account verification was requested for your email: '.$email.'</td>
                    </tr>
                    <tr>
                      <td>Link :</td>
                      <td><h5><strong><a href="http://localhost/fastcart/activate.php?token='.$token.' ">click here</a></strong> to activate your account</h5></td>
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

       $sign_arr = array('is_error'=>'no','msgs'=>'<p class="text-success text-center">Hi '.$name.'  your account activation send to your email </p>');

  }
    }else{

    ?>
    <script>
    alert("Registration Failed!");
    </script>
    <?php
    }

    }

  }else{

    $sign_arr = array('is_error'=>'yes','msgs'=>'<p class="text-danger text-center">Password are not matched</p>');
    }
  }
    }
    }
  }else{
    $sign_arr = array('is_error'=>'yes','msgs'=>'<p class="text-danger text-center">Please fill form properly</p>');
  }
    echo json_encode($sign_arr);

    ?>