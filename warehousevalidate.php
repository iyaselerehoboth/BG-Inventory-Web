<?php

include("config.php");

//$name = "AgroChem:Apron Star";
$warehousename = ($_GET['warehouse']);

//$warehousename = "kkk";

//$clientname = "Nestle";

$sql = "SELECT COUNT(id) FROM warehouse_t WHERE warehousename = '".$warehousename."'";


$result = mysqli_query($db_con, $sql);
if(!$result){
	die("Error: " .mysqli_error($db_con));
}

//$row = mysqli_fetch_array($db_con, $result);

$searchrow = mysqli_fetch_array($result);

$value =  $searchrow['COUNT(id)'];

//echo $value;
//$one = "1";
//echo $value;

if($value == 1){

	echo "";

}else{

	echo "Invalid Warehouse";
}


?>