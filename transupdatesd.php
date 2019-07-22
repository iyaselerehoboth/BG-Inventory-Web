<?php
//Get JSON pasted by Android application.

include("config.php");

//$con = mysqli_connect("localhost", "ciani", "LZJiwGrgSsEu1qrk","sd");

$json = $_POST["unsyncedJSON"];

//Remove slashes

$json = stripslashes($json);

$data = json_decode($json);
//Utilize arrays to create response JSON

$a = array();
$b = array();

//Loop through an Array and insert data read from JSON into MySQL DB

for($i=0; $i<count($data); $i++)
{
	$res = mysqli_query($db_con, "update web_transactions set sdstatus = '{$data[$i]->status}' where transactionID = '{$data[$i]->idonline}'");

	//this is to generate the array of id and sync that updates the sync status of the local db
	if($res)
	{
		$b["idonline"] = $data[$i]->idonline;
		$b["sync"] = 'yes';
		array_push($a,$b);
	}else
	{
		$b["idonline"] = $data[$i]->idonline;
		$b["sync"] = 'no';
		array_push($a,$b);
	}
}

echo json_encode($a);

?>