<?php
include("config.php");
session_start();

?>

<style>

.numberbox{
    width: 30%;
    height: 50%;
    background: rgba(0, 0, 20, 0.3);
    color: #fff;
    top: 50%;
    left: 50%;
    position: absolute;
    transform: translate(-50%, -50%);
    box-sizing: border-box;
    padding: 70px 30px;
}

.box{

	width: 50%;
	box-sizing: border-box;
	background: rgba(255,255,255);

}


</style>

<form action = "" method = "post">
<input type = "submit" name = "try" value = "Activate" />
</form>


<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

if(isset($_POST['try'])){

?>
			<div class="numberbox">
            <center>
            <form action = "" method = "post">
                <p>Enter Phone Number: </p><input type = "text" name = "number1" id="number1" placeholder="Enter the S&D's phone number" class = "box"/>
                <p>Confirm Phone Number: </p><input type = "text" name = "number2" id="number2" placeholder="Confirm S&D's phone number" class = "box"/>
                <br><br><input type = "submit" name = "submitted" value = "Submit" />
            </form>
            </center>
            </div>

<?php

		if(isset($_POST['submitted'])){

			$phone1 = mysqli_real_escape_string($db_con, $_POST['number1']);
			$phone2 = mysqli_real_escape_string($db_con, $_POST['number2']);

			print "Here: " .$phone1;
			$curl = curl_init();
            //$number = "+2348175917337";
            $from = "Inventory";
            $text = "External Shipment in another";

            $url = "http://ngn.rmlconnect.net:8080/bulksms/bulksms?username=BabbanGona&password=K6kRuXKS&type=5&dlr=0&destination=".urlencode($phone1)."&source=".urlencode($from)."&message=".urlencode($text)."";

            //$url = "https://www.example.com/file.php?phone=".urlencode($phone)."&message=".urlencode($message)."";
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($curl);

            //echo $result;

            curl_close($curl);
			
		}

  }

}

?>

<script>
function showtyped(){

    
    
}
</script>
