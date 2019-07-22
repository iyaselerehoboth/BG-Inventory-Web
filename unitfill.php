<?php

include("config.php");

//$name = "AgroChem:Apron Star";
$itemname = ($_GET['value']);

$sql = "SELECT * FROM item_t WHERE itemname = '".$itemname."'";


$result = mysqli_query($db_con, $sql);
if(!$result){
	die("Error: " .mysqli_error());
}

while($row = mysqli_fetch_assoc($result)){

    echo $row['itemunit'];
}

?>
