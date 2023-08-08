
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
// $query = "SELECT sum(amount) , MID(month,5, 10) AS TheMonth, MID(month,1,4) AS TheYear FROM `payment` GROUP BY TheMonth , TheYear";

$query = "SELECT sum(amount) AS total_amount,
DATE_FORMAT(added_on, '%M') AS TheMonth,
DATE_FORMAT(added_on, '%Y') AS TheYear
FROM payment
GROUP BY TheMonth,TheYear";

// $query = "SELECT DATE_TRUNC('month', added_on) AS month,
//        SUM(amount) AS monthly_earning
// FROM payment
// GROUP BY month
// ORDER BY month";

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
$data[]=array('color'=>$color,'month'=>$res['TheMonth'],'year'=>$res['TheYear'],'amount'=>$res['total_amount']);
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);