<?php

include("config.php");
//require(include/fpdf16/fpdf.php);
include("fpdf181/fpdf.php");
$waybill_id = ($_GET['waybill']);


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

//display the BG Image
$pdf->Image('logo_main.jpeg',$pdf->GetX(),$pdf->GetY(),45);

//Set x and y position for the main text, reduce font size and write content
$pdf->SetXY(10,40);
$pdf->SetFont('Helvetica', 'B', 8);
$pdf->SetTextColor(135,206,250);
//$pdf->SetFontSize(5);
$pdf->Cell(50,3,'Babban Gona Farmer Services',0,2);
$pdf->Cell(50,3,'Nigeria Limited',0,1);

$pdf->SetX(-100);
$pdf->SetFont('Helvetica', 'B', 18);
$pdf->Cell(110,10,'INVENTORY UNIT', 0,2,'C');
$pdf->Cell(110,10,'CONVERSION ORDER', 0,1,'C');


$pdf->SetFont('Helvetica', 'B', 8);
$pdf->SetY(53);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(50,3,'Lagos',0,2);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(50,3,'Plot 4B Block 113', 0, 2);
$pdf->Cell(50,3,'Professor Olabisi Adegoke Road,', 0, 2);
$pdf->Cell(50,3,'Ocean view estate, Lekki phase 1', 0, 2);
$pdf->Cell(50,3,'Lagos, Nigeria', 0, 1);

//qr_code.php?qrwaybill_id=1146850
//echo $waybill_id;
$viewsql = "SELECT *  FROM conversion_waybill WHERE waybill_id = '$waybill_id' LIMIT 1";
$viewexecute = mysqli_query($db_con, $viewsql);
while($viewrun = mysqli_fetch_array($viewexecute)){

//We will put the QR code here.
//"example_003_simple_png_output_param.php?id='.$ourParamId.'"
$imageWay = $viewrun['waybill_id'];
$itemWay = $viewrun['product_id'];
$pdf->SetXY(80, 40);

//$pdf->Image("http://apps.babbangona.com/bg_inventory/qr_generator.php?code=".urlencode($imageWay),$pdf->GetX(),$pdf->GetY(),40,0, "png");
$pdf->Image("QRCodes/".$imageWay.".png",$pdf->GetX(),$pdf->GetY(),40,0,'PNG');
$pdf->SetY(70);
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(50,3,'Kaduna',0,2);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(50,3,'Saulawa Village',0,2);
$pdf->Cell(50,3,'Ikara LGA',0,2);
$pdf->Cell(50,3,'Kaduna, Nigeria',0,1);

$pdf->SetX(-70);
//$pdf->Image("qr_code.php?qrwaybill_id = ".$waybill_id,$pdf->GetX(),$pdf->GetY(),50,0,'PNG');
$pdf->Cell(50,3,"Waybill ID: ".$viewrun['waybill_id'],0,2,'C');
$pdf->Cell(40,3,'RELEASE DATE: '.$viewrun['date'],0,1,'C');

$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(50,3,'Team Member Making Request: '.$viewrun['personnelName'],0,1,'L');
}

//Automatic code will be here.
//$pdf->Cell(49,10,'',0,1);
$pdf->SetX(5);
$pdf->SetFont('Helvetica', 'B', 6);
$pdf->Cell(18,8,'PRODUCT ID',1,0,'C');
$pdf->Cell(35,8,'DESCRIPTION',1,0,'C');
$pdf->Cell(26,8,'QUANTITY TO CONVERT',1,0,'C');
$pdf->Cell(32,8,'ORIGINAL UNIT OF MEASURE',1,0,'C');
$pdf->Cell(38,8,'CONVERSION UNIT OF MEASURE',1,0,'C');
$pdf->Cell(20,8,'OUT',1,0,'C');
$pdf->Cell(30,8,'PURPOSE',1,1,'C');


$anothersql = "SELECT * FROM conversion_waybill WHERE waybill_id = '$waybill_id'";
$anotherexe = mysqli_query($db_con, $anothersql);
if(!$anotherexe){
	die(mysqli_error($db_con));
}
while($anotherRun = mysqli_fetch_array($anotherexe)){
	$pdf->SetFont('Helvetica', '', 6);
//$pdf->Cell(20,8,'',1,1,'C');  // cell with left and right borders
$pdf->SetX(5);
//$pdf->Cell(8,8,$anotherRun['quantity'],1,0,'C');
$pdf->Cell(18,8,$anotherRun['product_id'],1,0,'C');
$pdf->Cell(35,8,$anotherRun['description'],1,0,'C');
$pdf->Cell(26,8,$anotherRun['quantityToConvert'],1,0,'C');
$pdf->Cell(32,8,$anotherRun['originalUnitOfMeasure'],1,0,'C');
$pdf->Cell(38,8,$anotherRun['conversionUnitOfMeasure'],1,0,'C');
$pdf->Cell(20,8,$anotherRun['destination'],1,0,'C');
$pdf->Cell(30,8,$anotherRun['purposeForConversion'],1,0,'C');
}


$pdf->Cell(49,10,'',0,1);
$pdf->SetFont('Helvetica','B');
$pdf->Cell(49,5,'To be completed by consignee',0,1);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(49,5,'I hereby confirm that the goods were received in the condition stated above.',0,1);
    

//Second Table
$pdf->Cell(60,10,'Team Member(s) in Charge of Exercise: ',1,0,'L',0);
$pdf->Cell(130,10,'',1,1,'L',0);
$pdf->Cell(60,10,'New Location:',1,0,'L',0);
$pdf->Cell(130,10,'',1,1,'L',0);//Empty Box after the new location


$pdf->SetFont('Helvetica', 'B', '6');
$firstY = $pdf->GetY();
$pdf->Cell(60,20,'',1,0,'L',0);
$pdf->SetXY(35,$firstY);
$pdf->Cell(10,10,'CONVERTED QTY:',0,2,'C');
$pdf->SetX(25);
$pdf->Cell(30,10,'',1,1,'C');
$pdf->SetXY(70, $firstY);

$pdf->Cell(65,20,'',1,0,'L',0);
$pdf->SetXY(100, $firstY);
$pdf->Cell(10,10,'CONVERSION LOSS/GAIN QTY1:',0,2,'C');
$pdf->SetX(90);
$pdf->Cell(25,10,'',1,0,'C');
$pdf->SetFont('Helvetica', 'B', '8');
$boxX = $pdf->GetX();
$pdf->Cell(10,5,'Gain',0,0,'L');
$pdf->Cell(5,3,'',1,1,'C');
$pdf->SetX($boxX);
$pdf->Cell(5,3,'',0,2,'C');
$pdf->Cell(10,5,'Loss',0,0,'L');
$pdf->Cell(5,3,'',1,0,'C');
$pdf->SetXY(135, $firstY);

$pdf->SetFont('Helvetica', 'B', '6');
$pdf->Cell(65,20,'',1,1,'L',0);
$pdf->SetXY(164, $firstY);
$pdf->Cell(10,10,'WASTE/CHAFF QTY&KG:',0,2,'C');
$pdf->SetX(154);
$pdf->Cell(30,10,'',1,1,'C');
$pdf->SetXY(5, 180);


//Third Table
$pdf->SetFont('Helvetica', '', '8');
$pdf->Cell(49,10,'',0,1);
$pdf->Cell(98,10,'Checked and Approved by S&D Supervisor',1,0,'L',0); 
$pdf->Cell(40,10,'Item QR Code ',0,2,'C'); 

//$pdf->Image("http://apps.babbangona.com/bg_inventory/qr_generator.php?code=".urlencode($itemWay),$pdf->GetX(),$pdf->GetY(),40,0, "png");
$pdf->Image("ItemCodes/".$itemWay.".png",$pdf->GetX(),$pdf->GetY(),40,0,'PNG');
$pdf->SetX(10);
$pdf->Cell(30,10,'Name:',1,0,'L',0);
$pdf->Cell(68,10,'',1,1,'L',0);
$pdf->Cell(30,10,'Date:',1,0,'L',0);
$pdf->Cell(68,10,'',1,1,'L',0);
$pdf->Cell(30,10,'Signature:',1,0,'L',0);
$pdf->Cell(68,10,'',1,1,'L',0);


//Output the document
$pdf->Output("Babbangona_".$waybill_id."_Waybill.pdf", 'I');

?>
