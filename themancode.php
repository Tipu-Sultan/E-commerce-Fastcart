<?php
$servername = "x71wqc4m22j8e3ql.cbetxkdyhwsb.us-east-1.rds.amazonaws.com	";
$username = "vegcuj78pv7itev1";
$password = "j8wv84ntls6f8zzw";
$db = "tipspo91cerg8q8n";
// Create connection
$con = new mysqli($servername, $username, $password,$db);

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

?>
