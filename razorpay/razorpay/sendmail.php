<?php 
include('dbase.php');
include('smtp/PHPMailerAutoload.php');
  $mail=new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host="smtp.gmail.com";
  $mail->Port=587;
  $mail->SMTPSecure="tls";
  $mail->SMTPAuth=true;
  $mail->Username="tipu@student.iul.ac.in";
  $mail->Password="TIPUHA1510L4Pwn9_i5iLNnuxXPftv9LmMTq8aBMW";
  $mail->SetFrom("tipu@student.iul.ac.in");
  $mail->addAddress("$email");
  $mail->IsHTML(true);
  $mail->Subject="ORDER PLACED MESSAGE";
  $mail->Body=$html;
  $mail->SMTPOptions=array('ssl'=>array(
    'verify_peer'=>false,
    'verify_peer_name'=>false,
    'allow_self_signed'=>false
  ));
 ?>