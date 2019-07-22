<?php

include("config.php");

//$name = "AgroChem:Apron Star";
$clientname = ($_GET['client']);

//$clientname = "Nestle";

$sql = "SELECT * FROM customer_t WHERE customername =?";

$stmt = $db_con->prepare($sql);
$stmt->bind_param("s", $clientname);
$stmt->execute();

$result = $stmt->get_result();


//$result = mysqli_query($db_con, $sql);7

//$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
//$result = mysqli_query($db_con, $sql);
if(!$result){
	die("Error: " .mysqli_error($db_con));
}

while($row = mysqli_fetch_assoc($result)){
    
    echo $row['customerid'];
}

?>