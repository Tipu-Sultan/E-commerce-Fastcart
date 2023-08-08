<?php
$msg =array('error'); 
if ($_POST['type']=="feed" && isset($_POST['pid'])){
	include 'dbase.php';
	$fid = $_POST['fid'];
    $pid = $_POST['pid'];
	$feed = mysqli_num_rows(mysqli_query($con,"select * from feed where payment_id='{$pid}' "));

	if($feed>0)
	{
		$update = mysqli_query($con,"update feed set feedback='$fid' where payment_id='{$pid}'");
		 $msg = array('error'=>'yes','msg'=>"{$fid}");

	}
	else
	{
		$insert = mysqli_query($con,"insert into feed(feedback,payment_id)values('$fid','$pid')");
		$msg = array('error'=>'no','msg'=>"{$fid}");
	}
}
echo json_encode($msg);
 ?>