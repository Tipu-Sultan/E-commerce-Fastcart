<?php 
include '../themancode.php';

if (isset($_GET['slug-id-count'])) {
	$slug = $_GET['slug-id-count'];
	$search = mysqli_query($con,"SELECT * FROM items WHERE slug='$slug'") or die("Query failed");
        $output = "";
	if (mysqli_num_rows($search)>0) { 
         $output= '<tbody>';
       while ($row = mysqli_fetch_array($search))
       {
       	$output .= "<tr>
            <td><p><a href='../product_details.php?pid={$row['id']}' class='text-decoration-none text-dark'>{$row['name']}</a></p></td>
            </tr>";
       }
       $output .= "</tbody>";
       mysqli_close($con);
	 echo $output;               
	}else{
		echo '<p>Results not found</p>';
	}
}
 ?>

 