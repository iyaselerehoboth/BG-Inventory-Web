<?php

$con = mysqli_connect("localhost", "bulkbana_tgl", "9t69ns333", "bulkbana_bg_inventory");


$date = $_POST["lastNumberUpdate"];

$a = array();
$b = array();

//Loop through an Array and insert data read from JSON into MySQL DB
$fetch = mysqli_query($con, "select * from wh_phones where timestamp > '$date'");

while($res = mysqli_fetch_array($fetch))
{
	$b["timestamp"] = $res["timestamp"];
	$b["warehouse"] = $res["warehouse"];
	$b["warehouseID"] = $res["warehouseID"];
	$b["phone"] = $res["phone"];

	array_push($a,$b);
}

echo json_encode($a);

?>
