<?php
include("config.php");
//require(include/fpdf16/fpdf.php);
include("fpdf181/fpdf.php");
include("phpqrcode/qrlib.php");

$mycustomerName = ($_GET['customerName']);
$mycustomerID = ($_GET['customerID']);

$CustomerQR = $mycustomerName.",".$mycustomerID;

QRcode::png($CustomerQR, "CustomerCodes/".$mycustomerID.".png");


?>