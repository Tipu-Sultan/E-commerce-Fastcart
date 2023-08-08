 <?php 
$upload = 'err'; 
if(!empty($_FILES['file'])){ 
  include 'themancode.php';
     $idupdate=$_POST['user_id'];
    // File upload configuration 
    $targetDir = "../product/"; 
    $allowTypes = array('mp4','jpg', 'png', 'jpeg', 'gif'); 
    $maxsize = 2097152;
    $fileName = basename($_FILES['file']['name']); 
    $targetFilePath = $targetDir.$fileName; 
     
    // Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
    if(in_array($fileType, $allowTypes)){ 

if (($_FILES['file']['size'] >= $maxsize) || ($_FILES['file']['size'] == 0)) {
                $upload = "file_err";

}else{
        // Upload file to the server 
        if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){ 
         $uquery = "insert into items(image)value('$fileName')";
         $success =  mysqli_query($con,$uquery);
            $upload = 'ok'; 
        } 
    } 
  }
} 
echo $upload; 
?>