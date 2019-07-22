<?php

include("config.php");  


$cancel_id=$_GET['cancel'];  

echo $cancel_id;

//Cancel sql



$cancel_sql = "UPDATE web_transactions SET status = 'Cancelled', pcstatus = 'Cancelled', sdstatus = 'Cancelled' WHERE transactionID = '$cancel_id'";

$runcancel = mysqli_query($db_con,$cancel_sql);

/*if(!runcancel){
    die("ERROR: " .mysqli_error());
}*/

if(!$runcancel){
    die("Error: " .mysqli_error($db_con));
}else{
    
?>


    <script>window.open('cancel_transaction.php?cancelled=transaction has been cancelled','_self')</script>;  
<?php
 
            $curl = curl_init();
            $number = "+2348069599816";
            $from = "Inventory";
            $text = "Cancel Transaction with TransactionID: ".$cancel_id;

            $url = "http://ngn.rmlconnect.net:8080/bulksms/bulksms?username=BabbanGona&password=K6kRuXKS&type=5&dlr=0&destination=".urlencode($number)."&source=".urlencode($from)."&message=".urlencode($text)."";

            //$url = "https://www.example.com/file.php?phone=".urlencode($phone)."&message=".urlencode($message)."";
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($curl);

            echo $result;

            curl_close($curl);
}

?>
