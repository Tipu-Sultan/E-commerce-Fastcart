<?php 
session_start();
include 'themancode.php';
if (isset($_POST['slug'])) {
  $jsonLimit=array();
$eid = mysqli_real_escape_string($con,$_POST['eid']);
$name = mysqli_real_escape_string($con,$_POST['name']);
$slug = mysqli_real_escape_string($con,$_POST['slug']);
$type = mysqli_real_escape_string($con,$_POST['type']);
$stock = mysqli_real_escape_string($con,$_POST['stock']);


$product_update = mysqli_query($con,"update items set name='$name',slug='$slug',type='$type',stock='$stock' where id=$eid");

if($product_update){
	$jsonLimit=array('is_error'=>'no','dd'=>'it is way');
}else{
	$jsonLimit=array('is_error'=>'yes');
}
echo json_encode($jsonLimit); 
}
 ?>


 <?php 
 sleep(2);
if(!empty($_FILES['file'])){ 
  $jsonLimit=array();
  include 'themancode.php';
    $product_name = mysqli_real_escape_string($con,$_POST['product_name']);
    $Price = mysqli_real_escape_string($con,$_POST['Price']);
    $Category = mysqli_real_escape_string($con,$_POST['Category']);
    $product_details = mysqli_real_escape_string($con,$_POST['product_details']);
    $qty = mysqli_real_escape_string($con,$_POST['qty']);

    $slug = md5($product_name);
    // measurements
    $sizes = $_POST['sizes'];
    // measurements
    $colors = $_POST['colors'];

    $targetDir = "../product/"; 
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif','webp','avif','heic'); 
    $maxsize = 2097152;
    $rand = rand(0,99999);
    $filename=$_FILES['file']['name'];
    $ext=pathinfo($filename,PATHINFO_EXTENSION);
    $fileName = basename($_FILES['file']['name'],$ext); 
    $newName = $rand.$fileName."jpeg";
    $targetFilePath = $targetDir.$newName; 
     
    // Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
    if(in_array($fileType, $allowTypes)){ 

if (($_FILES['file']['size'] >= $maxsize) || ($_FILES['file']['size'] == 0)) {
                $jsonLimit=array('is_error'=>'file_err');

}else{
        // Upload file to the server 
        if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){ 
           $product_update = mysqli_query($con,"insert into items (slug,name,price,type,qty,brief_info,image)values('$slug','$product_name','$Price','$Category','$qty','$product_details','$newName')");
            $li = mysqli_insert_id($con);

            foreach ($sizes as $index => $value) {
            $new_size = $value;
            $q  = mysqli_query($con,"insert into sizes(item_id,sizes)values('$li','$new_size')");
            }
            foreach ($colors as $indexs => $values) {
            $new_colors = $values;
            $q  = mysqli_query($con,"insert into colors(item_id,colors)values('$li','$new_colors')");
            }
            if(!empty($_FILES['catalog'])){
            $extension=array('jpg', 'png', 'jpeg', 'gif','webp','avif','heic');
            $maxsize = 1048576;
            foreach ($_FILES['catalog']['tmp_name'] as $key => $value) {
            $filename=$_FILES['catalog']['name'][$key];
            $filename_tmp=$_FILES['catalog']['tmp_name'][$key];
            $ext=pathinfo($filename,PATHINFO_EXTENSION);
            $finalimg='';
            if(in_array($ext,$extension))
            {
                if (($_FILES['catalog']['size'][$key] >= $maxsize) || ($_FILES['catalog']['size'] == 0)) {
                 $jsonLimit=array('is_error'=>'file_err');
                 break; 
            }else{
            $fileName = basename($filename,$ext); 
            $newfilename = time().$fileName."jpeg";
            move_uploaded_file($filename_tmp, '../gallery/'.$newfilename);
            $finalimg=$newfilename;
            $insertqry="INSERT INTO `product_gallery`( `pid`, `p_image`) VALUES ($li,'$finalimg')";
            mysqli_query($con,$insertqry);
            $jsonLimit=array('is_error'=>'no');
            }
            }else
            {
                $jsonLimit=array('is_error'=>'type_err');
            }
            }
            }
            $jsonLimit=array('is_error'=>'no');
        }else{
        	$jsonLimit=array('is_error'=>'yes');
        } 
    } 
  }else{
  	$jsonLimit=array('is_error'=>'type_err');
  }
  echo json_encode($jsonLimit); 
} 
?>