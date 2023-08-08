

 <?php
session_start();
include 'themancode.php';
$lg = array("err");     
if(isset($_POST['sesskey']))
    {
        $updates = mysqli_query($con,"update redcart set login_status=0 where user_id= '{$_SESSION['user_id']}'");
        unset($_SESSION['id']);
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        unset($_SESSION['last_name']);
        unset($_SESSION['image']);
        unset($_SESSION['email']);
        unset($_SESSION['last_login']);
        if (session_destroy()) {
        $lg = array('error'=>"no");
        }
    }



echo json_encode($lg );
?>

