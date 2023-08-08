<?php 
include 'themancode.php';
$jsonLimit=array();
if(!empty($_POST['process'])){ 
 $jsonLimit=array();
 $per = $_POST['process'];
 $oid = $_POST['orderid'];
 $process = mysqli_query($con,"update confirm set processed='$per' where order_id='$oid'");
 if ($process) {
 		 $jsonLimit=array('is_error'=>'no','msg'=>'Process added');
 	}	
}

if(!empty($_POST['soid'])){ 
 $jsonLimit=array();
 $soid = $_POST['soid'];
 $staus = $_POST['status'];
 $staus_up = mysqli_query($con,"update confirm set status='$staus' where order_id='$soid'");
 if ($staus_up) {
         $jsonLimit=array('is_error'=>'no','msg'=>'Updated');
    }   
}

if(!empty($_POST['item_process'])){ 
 $jsonLimit=array();
 $item_id = $_POST['item_id'];
 $item_process = $_POST['item_process'];
 $staus_up = mysqli_query($con,"update order_items set processed='$item_process' where order_id='$item_id'");
 if ($staus_up) {
         $jsonLimit=array('is_error'=>'no','msg'=>'Updated');
    }   
}
 echo json_encode($jsonLimit); 	
 ?>