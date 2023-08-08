<?php 
session_start();
include 'themancode.php';
include ('cart_cal.php');
$pid = $_POST['pid'];
$redata = mysqli_query($con,"select *  from product_review where pid='$pid' ORDER BY id DESC LIMIT 10");
    while($res = mysqli_fetch_array($redata))
    {
      echo '<tr>
                        <td><img src="uploads/'.$res['image'].'" width="30" height="30" class="img-responsive rounded-circle"></td>
                        <td>
                            <h6>'.$res['review'].'</h6>
                        </td>
                        </tr>';
    }
 ?>