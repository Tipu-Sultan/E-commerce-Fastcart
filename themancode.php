<?php
$servername = "sql200.infinityfree.com";
$username = "if0_35626457";
$password = "uACZUlW2D8Unhz";
$db = "if0_35626457_fastcart";
// Create connection
$con = new mysqli($servername, $username, $password,$db);

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

?>
