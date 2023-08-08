<?php
    include 'themancode.php';

    if (isset($_POST['email'])) {
    	$msg = array("Error");
        $email = $_POST['email'];
        $token = bin2hex(random_bytes(15));
        $query =  mysqli_query($con,"update admin set token='{$token}' where email='{$email}' and admin='admin'");

        if($query)
        {
            $msg = array('error'=>'no','msg'=>'<a href="forgot.php?getToken='.$token.'">Reset Now</a>');
        }else
        {
            $msg = array('error'=>'yes','msg'=>'Something went wrong');
        }

        echo json_encode($msg);
}
    ?>