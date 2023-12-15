<?php 
include('themancode.php');
include('smtp/PHPMailerAutoload.php');
  $mail=new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host="smtp.gmail.com";
  $mail->Port=587;
  $mail->SMTPSecure="tls";
  $mail->SMTPAuth=true;
  $mail->Username="";
  $mail->Password="";
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
  
  // if($mail->send()){}
 ?>
