<?php

include("config.php");
//require(include/fpdf16/fpdf.php);
include("fpdf181/fpdf.php");
$myid = $_GET['id'];

//Create a new FPDF Object
$pdf = new FPDF();

//set document properties
$pdf->SetAuthor('Iyasele Rehoboth');
$pdf->SetTitle('BabbanGona Invoice Generator');


//set font for the entire document
$pdf->SetFont('Helvetica', 'B', 20);
$pdf->SetTextColor(50,60,100);

//set up a page
$pdf->AddPage('P');
$pdf->SetDisplayMode('real');

//display the BG Image
$pdf->Image('logo_main.jpeg',$pdf->GetX(),$pdf->GetY(),45,'PNG');

//Set x and y position for the main text, reduce font size and write content
$pdf->SetXY(10,40);
$pdf->SetFont('Helvetica', 'B', 8);
$pdf->SetTextColor(90,15,242);
//$pdf->SetFontSize(5);
$pdf->Cell(50,3,'Babban Gona Farmer Services',0,2);
$pdf->Cell(50,3,'Nigeria Limited',0,1);
//$pdf->SetTextColor(0,0,0);
$pdf->Cell(50,3,'TIN: 15639517-0001',0,1);
$pdf->SetX(-100);
$pdf->SetTextColor(113,111,117);
$pdf->SetFont('Helvetica', 'B', 22);
$pdf->Cell(90,10,'DELIVERY INVOICE', 0,2,'C');

/*//We will put the QR code here.
$combinedProduct = $viewrun['waybill_id'];
$combinedCustomer = $viewrun['product_id'];
$pdf->SetXY(80, 40);
$pdf->Image("QRCodes/".$imageWay.".png",$pdf->GetX(),$pdf->GetY(),40,0,'PNG');
//$pdf->SetY(70);*/


$pdf->SetFont('Helvetica', 'B', 8);
$pdf->SetY(53);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(50,3,'Lagos',0,2);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(50,3,'Plot 4B Block 113', 0, 2);
$pdf->Cell(50,3,'Professor Olabisi Adegoke Road,', 0, 2);
$pdf->Cell(50,3,'Ocean view estate, Lekki phase 1', 0, 2);
$pdf->Cell(50,3,'Lagos, Nigeria', 0, 1);


$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(20,5,'',0,1);
$pdf->Cell(50,3,'Kaduna',0,2);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(50,3,'Saulawa Village',0,2);
$pdf->Cell(50,3,'Ikara LGA',0,2);
$pdf->Cell(50,3,'Kaduna, Nigeria',0,1);
//$pdf->SetXY(-60,70);

$pdf->SetXY(10,100);

$sql = "SELECT * FROM delivery_invoice WHERE id = '" .$myid. "' LIMIT 1";
$sqlQuery = mysqli_query($db_con, $sql);


//Automatic code will be here.
//$pdf->Cell(49,25,'',0,1);//Empty Space
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(8,8,'S/N',1,0,'C',0);
$pdf->Cell(30,8,'Customer Name',1,0,'C',0);
$pdf->Cell(40,8,'Amount',1,0,'C',0);
$pdf->Cell(55,8,'Corresponding Waybill',1,0,'C',0);
$pdf->Cell(30,8,'Team Member',1,0,'C',0);
$pdf->Cell(25,8,'Date Delivered',1,1,'C');

while($viewagain = mysqli_fetch_assoc($sqlQuery)){
	$pdf->SetFont('Helvetica', '');
	$pdf->Cell(8,8,$viewagain['id'],1,0,'C',0);
	$pdf->Cell(30,8,$viewagain['customer_name'],1,0,'C',0);
	$pdf->Cell(40,8,$viewagain['delivered_amount'],1,0,'C',0);
	$pdf->Cell(55,8,$viewagain['waybill_id'],1,0,'C',0);
	$pdf->Cell(30,8,$viewagain['team_member_id'],1,0,'C',0);
	$pdf->Cell(25,8,$viewagain['date_delivered'],1,1,'C');
}


$pdf->SetY(130);
//Qr codes will be here.
$newSQL = "SELECT * FROM delivery_invoice WHERE id = '".$myid."'";
$anotherExec = mysqli_query($db_con, $newSQL);
while($waybills = mysqli_fetch_assoc($anotherExec)){

$customerID = $waybills['customer_id'];
$productID = $waybills['product_id'];
$pdf->SetX(5);
$pdf->Cell(55,8,'Item QR Code: '.$waybills['product_name'],0,1,'C');

$pdf->Image("http://apps.babbangona.com/bg_inventory/qr_generator.php?code=".urlencode($productID),$pdf->GetX(),$pdf->GetY(),40,0, "png");
//$pdf->Image("ItemCodes/" .$productID. ".png", $pdf->GetX(), $pdf->GetY(), 40,0,'PNG');

$pdf->SetXY(95, 130);
$pdf->Cell(55,8,"Customer QR Code: ".$waybills['customer_name'],0,1,'C');
$pdf->SetX(100);

$pdf->Image("http://apps.babbangona.com/bg_inventory/qr_generator.php?code=".urlencode($customerID),$pdf->GetX(),$pdf->GetY(),40,0, "png");
//$pdf->Image("CustomerCodes/" .$customerID. ".png", $pdf->GetX(), $pdf->GetY(), 40,0,'PNG');

}



$pdf->SetY(180);
$pdf->SetFont('Helvetica', '','6');
$pdf->Cell(30,4,'*The sale of this commodity is treated as exempt from the value added tax in accordance with the First Schedule of the Value Added Tax Act (1993)',0,1);

//Output the document
$pdf->Output('example1.pdf', 'I');

?>
