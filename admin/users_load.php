
<?php

sleep(1);
include '../themancode.php';

$limit = 10;

if (isset($_POST['Page_no'])) {
  $page = $_POST['Page_no'];
}else{
$page = 0;
}

$selectquery = "SELECT * FROM redcart  LIMIT {$page},$limit";
$query = mysqli_query($con,$selectquery);

if (mysqli_num_rows($query)>0) {
  $output = "";
  $output .="<tbody>";
  while ($row = mysqli_fetch_array($query)){
    $status='inactive';
  $class = "btn-danger";
  if ($row['status']!='inactive') {
    $status='active';
    $class = "btn-success";
  }
    $last_id = $row['id'];
 $output.= "<tr>
            <td><img src='../uploads/{$row['image']}' width='40' height='40'></td>
            <td>{$row['username']}</td>
            <td>{$row['email']}</td>
            <td>{$row['mobile']}</td>
            <td>{$row['address']}</td>
            <td>{$row['otp']}</td>
            <td><a href='?status={$row['user_id']}' class='btn $class btn-sm'>{$row['status']}</a></td>
            <td>
            <a href='?del_account={$row['user_id']}' class='btn btn-danger'><i class='fa fa-trash'></i></a></td>
            </tr>";
}

$output .="</tbody>

<tbody id='pagination'>
  <tr>
 <td><button class=' btn btn-outline-success' id='ajaxbtn' data-id='{$last_id}'>Load More</button></td>
</tr>
</tbody>";
echo $output ."{$last_id}";
}else{
  echo "";
}
 mysqli_close($con);
?>
