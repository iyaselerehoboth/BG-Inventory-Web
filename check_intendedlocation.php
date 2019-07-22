<?php

include("config.php");

$location = "ma";
//$location = ($_GET['location']);

$sql = "SELECT * FROM inventory_details WHERE lmdid LIKE '%".$location."%' OR warehousename LIKE '%".$location."%' OR customername LIKE '%".$location."%'";

$result = mysqli_query($db_con, $sql);

if(!$result){

	die("Error: " .mysqli_error());

}

if(mysqli_num_rows($result) >= 1){
	echo "greater";
	
}else{
	echo "smaller";
	
}



?>