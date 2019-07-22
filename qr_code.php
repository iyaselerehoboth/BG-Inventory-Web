<?php
include("config.php");
//require(include/fpdf16/fpdf.php);
include("fpdf181/fpdf.php");
include("phpqrcode/qrlib.php");

$qr_id = ($_GET['qrwaybill_id']);
//$qr_id = 'WT0000000453-00455-43622.586';

$qrsql = "SELECT * FROM user_waybill WHERE waybill_id = '".$qr_id."'";
$qrexec = mysqli_query($db_con, $qrsql);
$qresult = $qrexec->fetch_assoc();

$qrwaybill = $qresult['waybill_id'];
$qritemid = $qresult['product_id'];
$qritemname = $qresult['description'];
$qrshipfrom = $qresult['ship_from'];
$qrstaffid = $qresult['destination'];
$qrintended = $qresult['intended_location'];
$qrhub = $qresult['hub'];
$qrquantity = $qresult['quantity'];
$fulldate = $qresult['date'];
$qrdate = explode(" ", $fulldate);

$totalqr = $qrwaybill.",".$qritemid.",".$qritemname.",".$qrshipfrom.",".$qrstaffid.",".$qrintended.",".$qrhub.",".$qrquantity.",".$qrdate[0];
//echo $totalqr;

QRcode::png($totalqr, "QRCodes/".$qr_id.".png");
//QRcode::png($totalqr);



?>
