<?php 
    

 include "config.php";

 $to = 'rehoboth.iyasele@babbangona.com';
 $subject = 'BG Inventory Waybill';
 $headers = "From: adebayo.adeniran@babbangona.com \r\n";
 $headers .= "Reply-To: SD@babbangona.com \r\n";
 $headers .= "CC: rehobothi@yahoo.com\r\n";
 $headers .= "CC: rehoboth.iyasele@gmail.com\r\n";
 $headers .= "MIME-Version: 1.0\r\n";
 $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


$message = '<html>';
$message .= '<body>';
$message .=	'<link rel="stylesheet" type="text/css" href="email_style.css">';
$message .=	'<h2 align="center"> Babban Gona Inventory </h2>';
$message .=	'<img src="load_truck.jpg" alt="warehouse loading" class="avatar" width="650" height="300" align="center">';


$message .=	'<div class="transdetails" >';
$message .=	'<h4>Hi Team</h4>';
$message .=	'<h4>An Inventory request has been created by James Gordon </h4>';

$message .=	'<table>';
$message .= '<thead>';
$message .= '<tr>';
      $message .= '<th>Product Name</th>';
      $message .= '<th>Amount Requested</th>';
      $message .= '<th>Destination</th>';
      $message .= '</tr>';
    $message .= '</thead>';

    $message .= '<tbody>';
     
        $message .= '<tr>';
              $message .= '<td>Jj</td>';
              $message .= '<td>James Gordon</td>';
              $message .= '<td>Bane</td>';
        $message .= '</tr>';
    $message .= '</tbody>';
  	$message .= '</table>';
	$message .= '</div>';

	$message .= '<br><br><center>';
	$message .= '<div class="redirect">';
	$message .= '<a href="http://apps.babbangona.com/bg_inventory"> Click here to proceed to the Web portal </a>';
	$message .= '</div>';
	$message .= '</center>';

	$message .= '<br><br><br>';
	$message .= '<h5>';
		$message .= 'Regards,<br>';
		$message .= 'The Supply and Distribution Team.';
	$message .= '</h5>';


$message .= '</body>';	
$message .= '</html>';


if(mail($to, $subject, $message, $headers)) {
            echo "SUCCESS";
        } else {
            echo "ERROR";
        }      

?>