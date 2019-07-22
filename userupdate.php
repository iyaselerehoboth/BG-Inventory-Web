<?php

$con = mysqli_connect("localhost", "bulkbana_tgl", "9t69ns333", "bulkbana_bg_inventory");

$date = $_POST["lastUserUpdate"];

$a = array();
$b = array();

//Loop through an Array and insert data read from JSON into MySQL DB
$fetch = mysqli_query($con, "select * from users where timestamp > '$date'");

while($res = mysqli_fetch_array($fetch))
{
	$b["id"] = $res["id"];
	$b["timestamp"] = $res["timestamp"];
	$b["username"] = $res["username"];
	$b["password"] = $res["password"];
	$b["department"] = $res["department"];

	array_push($a,$b);
}

echo json_encode($a);

?>
