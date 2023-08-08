<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
      header('Location:index.php');
      die();
    }
include 'themancode.php';
 $data = $_GET['datavalue'];

$city_q = mysqli_query($con,"SELECT * FROM cities where state_id='$data'");

	while ($row = mysqli_fetch_array($city_q)){
		?>
		<option value="<?php echo $row['id'].$row['city'] ?>"><?php echo $row['city'] ?></option>
		<?php
	}
 


 ?>