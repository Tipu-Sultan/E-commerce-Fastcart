<?php 
include 'themancode.php';
// date_default_timezone_set('Asia/Calcutta'); 
// $date = date("Y-m-d"); // time in India

$payment = mysqli_query($con,"select * from payment where payment_status='complete'");
// $pay = 0;
// $output = "";
$total = 0;
// $data = array();
while ($row = mysqli_fetch_array($payment)){
// $a = rand(100,300);
// $b = rand(10,200);
// $c = rand(40,140);
// $d = rand(0,10);
// $color= "rgba($a, $b, $c, $d)";    
// $amt = $amt + $res['amount'];
//     $data[]=array('uid'=>$res['id'],'amount'=>$amt,'amt'=>$res['amount'],'color'=>$color,'month'=>$res['month']);
$total = $total + $row['amount'];
}
// print json_encode($data);


 ?>


 <?php
//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'fastcart');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$query = sprintf("SELECT sum(amount) , MID(month,5, 10) AS TheMonth, MID(month,1,4) AS TheYear FROM `payment` GROUP BY TheMonth , TheYear");

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
$amt = 0;
foreach ($result as $res) {
$a = rand(100,300);
$b = rand(10,200);
$c = rand(40,140);
$d = rand(0,10);
$color= "rgba($a, $b, $c, $d)";  
    $data[]=array('color'=>$color,'total'=>$total,'month'=>$res['TheMonth'],'amount'=>$res['sum(amount)']);
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);