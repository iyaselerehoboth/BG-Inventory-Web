<?php

	include("config.php");
    session_start();

	$waybill_id = ($_GET['waybill']);
	$sort_sql = "SELECT * FROM user_waybill WHERE waybill_id = '$waybill_id' LIMIT 1";
	$sort_run = mysqli_query($db_con, $sort_sql);
	if(!$sort_run){
		die("Error: " .mysqli_error());
	}

	while($sort_row = mysqli_fetch_array($sort_run)){

	$transaction = $sort_row['transaction_type'];

		switch($transaction){

			case "Trans-Shipment":
				header("Location: newpdf.php?waybill=$waybill_id"); /* Redirect browser */
				exit();
			break;

			case "Sales Shipment":
			header("Location: sales_shipment_waybill.php?waybill=$waybill_id"); /* Redirect browser */
				exit();
			break;


			case "Shipment to Nestle":
				header("Location: nestle_delivery_waybill.php?waybill=$waybill_id"); /* Redirect browser */
				exit();
			break;


			case "Shipment to Vendors":
			header("Location: external_shipment_waybill.php?waybill=$waybill_id"); /* Redirect browser */
				exit();
			break;


			case "Shipment to Customers":
				header("Location: real_delivery_waybill.php?waybill=$waybill_id"); /* Redirect browser */
				exit();
			break;

			default:
			header("Location: approved_waybill.php");
			exit();

		}	
	}

?>