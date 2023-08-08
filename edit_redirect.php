
 <?php 
 session_start();
 if (!isset($_SESSION['user_id'])) {
      header('Location:index.php');
      die();
    }
  sleep(2);
  include 'themancode.php';
if(!empty($_POST['username'])){ 
   $jsonLimit=array();
    
     $uid = $_SESSION['user_id'];
    $names = mysqli_real_escape_string($con,$_POST['names']);
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $state = mysqli_real_escape_string($con,$_POST['state']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $address = mysqli_real_escape_string($con,$_POST['address']);
    $mobile = mysqli_real_escape_string($con,$_POST['mobile']);

   $details_update = mysqli_query($con,"update redcart set name='$names',username='$username',state='$state',email='$email',address='$address',mobile='$mobile' where user_id='$uid'");
        if($details_update){ 
          $jsonLimit=array('is_error'=>'no','sid'=>'<p class="text-center text-success">edit successfully.</p>');
        }else{
            $jsonLimit=array('is_error'=>'yes','eid'=>'<p class="text-center text-danger">Not inserted.</p>');
        } 
  echo json_encode($jsonLimit); 
} 
?>


<?php  
if(!empty($_FILES['file'])){ 
  $upload = array('err');
  include 'themancode.php';
    $name = $_POST['user_id'];
    $imgID = $_POST['imgID'];

    // File upload configuration 
    $targetDir = "uploads/"; 
    $allowTypes = array('jpeg', 'jpg', 'png', 'webp','gif'); 
    $maxsize = 1048576;
    $fileName = basename($_FILES['file']['name']);

    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    $rand = rand(0,999999);
    $newName = $name.$rand.'.'.$extension;

    $targetFilePath = $targetDir.$newName; 
     
    // Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
    if(in_array($fileType, $allowTypes)){ 

if (($_FILES['file']['size'] >= $maxsize) || ($_FILES['file']['size'] == 0)) {
    $upload = array('is_error'=>'yes','msgs'=>'<p class="text-danger text-center">File size too large please upload 1 MB file</p>');

}else{

        if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){
            if ($imgID!="user.png") {
            unlink("uploads/".$imgID);
            }
           $size =  $_FILES['file']['size'];
         $upload_query = mysqli_query($con,"update redcart set image='$newName' where user_id='{$_SESSION['user_id']}' ");
        $upload = array('is_error'=>'no','msgs'=>'<p class="text-success text-center">Profile Picture changed Successfully</p>');
        }
      }
  }else{
    $upload = array('is_error'=>'yes','msgs'=>'<p class="text-danger text-center">Please select ("jepg", "jpg", "png", "webp","gif") file only</p>');
  }
  echo json_encode($upload);
} 

if (isset($_GET['repic'])) {
    $pid = $_GET['repic'];
    $imgID = $_GET['imgID'];
    if ($imgID!="user.png") {
        unlink("uploads/".$imgID);
    }
    $query = mysqli_query($con,"update redcart set image='user.png' where user_id='$pid'");
    if($query)
    {
        header('location:edit.php');
        die();
    }
}
?>
