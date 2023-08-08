<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
      header('Location:index.php');
      die();
    }
include 'themancode.php';
 $data = $_GET['datavalue'];

$states_q = mysqli_query($con,"SELECT * FROM states where country_id='$data'");

	while ($row = mysqli_fetch_array($states_q)){
		?>
		<option value="<?php echo $row['id'].$row['name'] ?>"><?php echo $row['name'] ?></option>
		<?php
	}
 


 ?>