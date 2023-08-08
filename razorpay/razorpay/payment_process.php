<?php
session_start();
$payArray = array();
include('dbase.php');
if(isset($_POST['amt']) && isset($_POST['name'])){
    date_default_timezone_set("Asia/Calcutta");
    $amt=$_POST['amt'];
    $name=$_POST['name'];
    $payment_status="pending";
    $added_on=date('Y-m-d');
    $month =  date('D M Y');
    $payment = "insert into payment(name,amount,payment_status,added_on,month) values('$name','$amt','$payment_status','$added_on','$month')";
    $q = mysqli_query($con,$payment);
    $_SESSION['OID']=mysqli_insert_id($con);
}


if(isset($_POST['payment_id']) && isset($_SESSION['OID'])){
    $payment_id=$_POST['payment_id'];
    $succes = mysqli_query($con,"update payment set payment_status='complete',payment_id='$payment_id' where id='".$_SESSION['OID']."'");
    if ($succes) {
       $payArray = array('error'=>'no','pay'=>$payment_id);
    }
}
echo json_encode($payArray);
?>