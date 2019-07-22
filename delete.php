<?php  

/** 
 * Created by PhpStorm. 
 * User: Ehtesham Mehmood 
 * Date: 11/24/2014 
 * Time: 11:55 PM 
 */  
 
include("config.php");  

echo "We got Here";



$delete_id=$_GET['del'];  

echo $delete_id;

$delete_query="DELETE FROM hq_login_table WHERE name ='$delete_id'";//delete query  

echo $delete_query;

$run=mysqli_query($db_con,$delete_query);  

if($run)  
{  
//javascript function to open in the same window  
    echo "<script>window.open('view_allUsers.php?deleted=user has been deleted','_self')</script>";  
}  
  
?>