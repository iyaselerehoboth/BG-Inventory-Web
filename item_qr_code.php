<?php
include("config.php");
//require(include/fpdf16/fpdf.php);
include("fpdf181/fpdf.php");
include("phpqrcode/qrlib.php");

$item_name = ($_GET['itemName']);
$item_id = ($_GET['itemID']);

/*$item_name = "XXX";
$item_id = "YYY";*/

$QR = $item_name.",".$item_id;


QRcode::png($QR, "ItemCodes/".$item_id.".png");

?>