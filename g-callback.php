<?php 
session_start();
include('themancode.php');
    $loginArr = array("error"=>'yes');
if (isset($_POST['google_email']) && !isset($_SESSION['client_id'])) {
    date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
    $times = date('d-m-Y H:i:s');
  $client_id = mysqli_real_escape_string($con,$_POST['client_id']);
  $name = mysqli_real_escape_string($con,$_POST['name']);
  $last_name = mysqli_real_escape_string($con,$_POST['last_name']);
  $picture_link = mysqli_real_escape_string($con,$_POST['picture_link']);
  $google_email = mysqli_real_escape_string($con,$_POST['google_email']);
  $sesskey = session_id();
  $_SESSION['user_id'] = $client_id;
 $res =  mysqli_query($con,"select * from redcart where user_id='{$client_id}'");
  $verify = mysqli_num_rows($res);
           
  if($verify>0)
  {
    $updates = mysqli_query($con,"update redcart set image='$picture_link',sesskey='$sesskey',last_login='$times',login_status=1,status='active' where user_id='{$client_id}'");
            $data = mysqli_fetch_assoc($res);
            $_SESSION['id'] = $data['id'];
            $_SESSION['user_id'] = $data['user_id'];
            $_SESSION['name'] = $data['name'];
            $_SESSION['last_name'] = $data['last_name'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['mobile'] = $data['mobile'];
            $_SESSION['image'] = $data['image'];
            $_SESSION['sesskey'] = $data['sesskey'];
            $_SESSION['last_login'] = $data['last_login'];
            $_SESSION['login_status'] = $data['login_status'];
    $loginArr = array("error"=>'login');
  }
  else{

           $newsql= mysqli_query($con,"insert into redcart (user_id,name,last_name,email,image,last_login,status) values('$client_id','$name','$last_name','$google_email','$picture_link','$times','active')");

            $insert_res =  mysqli_query($con,"select * from redcart where user_id='{$client_id}'");
            $newdata = mysqli_fetch_assoc($insert_res);
            $_SESSION['id'] = $newdata['id'];
            $_SESSION['user_id'] = $newdata['user_id'];
            $_SESSION['name'] = $newdata['name'];
            $_SESSION['last_name'] = $newdata['last_name'];
            $_SESSION['email'] = $newdata['email'];
            $_SESSION['image'] = $newdata['image'];
            $_SESSION['username'] = $newdata['username'];
            $_SESSION['mobile'] = $newdata['mobile'];
            $_SESSION['sesskey'] = $newdata['sesskey'];
            $_SESSION['last_login'] = $newdata['last_login'];
            $_SESSION['login_status'] = $newdata['login_status'];
            $loginArr = array("msg"=>'login');
  }





}
echo json_encode($loginArr);
 ?>
