<?php 
include 'themancode.php';
session_start();

$sign_arr = array();
if (isset($_POST['search'])) {
	$query = $_POST['search'];
	$allowed = array(".", "-", "_");
	if (ctype_alnum($query)) {
		$sign_arr = array('error'=>'yes','msg'=>'<p>Username must be alpha-numeric</p></p>');
	}else if(strlen($query)<8){
		$sign_arr = array('error'=>'yes','msg'=>'<p>Username must be 8 chars like (az,AZ,09,@!#)</p>');
	}else{
	$sign_arr = array('error'=>'no','msg'=>'<p><span class="text-success">'.$query.'</span> Yes its alphanumeric</p>');

	$results = mysqli_query($con,"SELECT * FROM redcart where username='{$query}' ") or die("Query failed");
        $output = "";
	if (mysqli_num_rows($results)>0) { 
	$sign_arr = array('error'=>'yes','msg'=>'<p><span class="text-success">'.$query.'</span> already exists</p>');

	}else{
		// echo '<p>Results not found</p>';
		$sign_arr = array('error'=>'yes','msg'=>'<p class="text-success">'.$query.'</p>');
	}
mysqli_close($con);
}
}

if (isset($_POST['alpha'])) {
	$alpha = $_POST['alpha'];

	if (ctype_alnum($alpha)) {
	$sign_arr = array('error'=>'yes','msg'=>'<p>Password must be alpha-numeric</p></p>');
	}else if(strlen($alpha)<8){
	$sign_arr = array('error'=>'yes','msg'=>'<p>Password must be 8 chars like (az,AZ,09,@!#)</p>');

	}else{
		$sign_arr = array('error'=>'no','msg'=>'<p><span class="text-success">'.$alpha.'</span> Yes its alphanumeric</p>');
	}
}


if (isset($_GET['query'])) {
	$limit = 7;
	$query = $_GET['query'];

	$results = mysqli_query($con,"SELECT * FROM items where name LIKE '%{$query}%' OR slug LIKE '%{$query}%' OR price LIKE '%{$query}%' LIMIT {$limit}") or die("Query failed");
        $output = "";
	if (mysqli_num_rows($results)>0) { 
         $output= '<tbody>';
       while ($row = mysqli_fetch_array($results))
       {
       	$output .= "<tr>
            <td><p><a href='search.php?query={$row['slug']}' class='text-decoration-none text-dark'>{$row['name']}</a></p></td>
            </tr>";
       }
       $output .= "</tbody>";
       mysqli_close($con);
	 // echo $output; 
	 $sign_arr = array('error'=>'no','res'=>"{$output}");               
	}else{
		// echo '<p>Results not found</p>';
		$sign_arr = array('error'=>'yes','msg'=>'<p>Results not found</p>');
	}
}

echo json_encode($sign_arr);

 ?>
