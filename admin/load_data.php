
<?php

sleep(1);
include 'themancode.php';

$limit = 20;

if (isset($_POST['Page_no'])) {
  $page = $_POST['Page_no'];
}else{
$page = 0;
}

$selectquery = "SELECT * FROM items  LIMIT {$page},$limit";
$query = mysqli_query($con,$selectquery);

if (mysqli_num_rows($query)>0) {
  $output = "";
  $output .="<tbody>";
  while ($row = mysqli_fetch_array($query)){
    $last_id = $row['id'];
 $output.= "<tr>
            <td><img src='../product/{$row['image']}' width='40' height='40'></td>
            <td>{$row['name']}</td>
            <td>{$row['slug']}</td>
            <td>{$row['price']}</td>
            <td>{$row['type']}</td>
            <td>{$row['stock']}</td>
            <td><a href='edit_product.php?edit_id={$row['id']}' class='btn btn-primary-sm'><i class='fa fa-edit'></i></a>
            <a href='?del_id={$row['id']}' class='btn btn-danger'><i class='fa fa-trash'></i></a></td>
            </tr>";
}


$output .="</tbody>

<tbody id='pagination'>
  <tr>
 <td><button class=' btn btn-outline-success' id='ajaxbtn' data-id='{$last_id}'>Load More</button></td>
</tr>
</tbody>";
header('Content-Type: application/xls');
header('Content-Disposition: attachment; filename=report.xls');
echo $output ."{$last_id}";
}else{
  echo "";
}
 mysqli_close($con);
?>
