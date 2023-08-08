<?php 
include '../themancode.php';

if (isset($_POST['search'])) {
	$jsno_sea = array();
	$limit = 7;
	$query = $_POST['search'];

	$results = mysqli_query($con,"SELECT * FROM items where name LIKE '%{$query}%' OR slug LIKE '%{$query}%' OR price LIKE '%{$query}%' LIMIT {$limit}") or die("Query failed");
        $output = "";
	if (mysqli_num_rows($results)>0) { 
         $output= '<tbody>';
       while ($row = mysqli_fetch_array($results))
       {
       	$output .= "<tr>
            <td><p><a href='search.php?slug-id-count={$row['slug']}' class='text-decoration-none text-dark'>{$row['name']}</a></p></td>
            </tr>";
       }
       $output .= "</tbody>";
       mysqli_close($con);
	 // echo $output; 
	 $jsno_sea = array('error'=>'no','res'=>$output);               
	}else{
		// echo '<p>Results not found</p>';
		$jsno_sea = array('error'=>'yes','msg'=>'<p>Results not found</p>');
	}
echo json_encode($jsno_sea);
}
 ?>
