<?php

define ('DB_SERVER','localhost');
define ('DB_USERNAME','root');
define ('DB_PASSWORD','');
define ('DB_NAME','bg_inventory_update');







$db_con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);
/*if($db_con){
    print"Database connection successful";
}else{
    print"Unable to connect";
}*/
?>
