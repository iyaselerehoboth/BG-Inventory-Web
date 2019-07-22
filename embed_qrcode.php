<?php
include("fpdf181/fpdf.php");

//Create a new FPDF Object
$pdf = new FPDF();

//set document properties
$pdf->SetAuthor('Iyasele Rehoboth');
$pdf->SetTitle('BabbanGona Waybill Generator');


//set font for the entire document
$pdf->SetFont('Helvetica', 'B', 20);
$pdf->SetTextColor(50,60,100);

//set up a page
$pdf->AddPage('P');
$pdf->SetDisplayMode('real');

$value = 'Nike Training Club';

$pdf->Image("http://apps.babbangona.com/bg_inventory/qr_generator.php?code=".urlencode($value),$pdf->GetX(),$pdf->GetY(),45, "png");

$pdf->SetXY(10,60);
$pdf->Image("http://apps.babbangona.com/bg_inventory/qr_generator.php?code=Nike_Training_Club",$pdf->GetX(),$pdf->GetY(),30,30, "png");


$pdf->Output();
?>