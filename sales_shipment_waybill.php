<?php

include("config.php");
//require(include/fpdf16/fpdf.php);
include("fpdf181/fpdf.php");
$waybill_id = $_GET['waybill'];


//Create a new FPDF Object
$pdf = new FPDF();

//set document properties
$pdf->SetAuthor('Iyasele Rehoboth');
$pdf->SetTitle('Babbangona Waybill Generator');


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
$pdf->Cell(90,10,'SALES SHIPMENT', 0,2,'C');
$pdf->Cell(90,10,'WAYBILL', 0,1,'C');


$pdf->SetFont('Helvetica', 'B', 8);
$pdf->SetY(53);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(50,3,'Lagos',0,2);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(50,3,'Plot 4B Block 113', 0, 2);
$pdf->Cell(50,3,'Professor Olabisi Adegoke Road,', 0, 2);
$pdf->Cell(50,3,'Ocean view estate, Lekki phase 1', 0, 2);
$pdf->Cell(50,3,'Lagos, Nigeria', 0, 1);

//echo $waybill_id;
$waybillsql = "SELECT * FROM user_waybill WHERE waybill_id = '$waybill_id' LIMIT 1";
$waybillexecute = mysqli_query($db_con, $waybillsql);
while($waybillresult = mysqli_fetch_array($waybillexecute)){

$imageWay = $waybillresult['waybill_id'];
$itemWay = $waybillresult['product_id'];
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
$pdf->Cell(50,3,"Waybill ID: ".$waybillresult['waybill_id'],0,2,'R');
$pdf->Cell(50,3,'SHIPMENT DATE: '.$waybillresult['date'],0,1,'R');

$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(50,3,'Team Member Making Request: '.$waybillresult['personnelName'],0,1,'L');


//Automatic code will be here.
$pdf->Cell(49,10,'',0,1);
//$pdf->Cell(8,8,'QTY ','LTR',0,'L',0);   // empty cell with left,top, and right borders
$pdf->Cell(28,8,'PRODUCT ID',1,0,'L',0);
$pdf->Cell(75,8,'DESCRIPTION',1,0,'L',0);
$pdf->Cell(45,8,'SHIP FROM',1,0,'L',0);
$pdf->Cell(45,8,'QUANTITY LOADED',1,1,'L',0);


$warehousesql = "SELECT * FROM warehouse_t WHERE warehouseid = '".$waybillresult['ship_from']."'";
$warehouserun = mysqli_query($db_con, $warehousesql);
$warehouseresult = $warehouserun->fetch_assoc();
if(!$warehouseresult){
echo("Error: Warehouse Can't be found...." .mysqli_error($db_con));
}

$pdf->SetFont('Helvetica', '');
$pdf->Cell(28,8,$waybillresult['product_id'],1,0,'L',0);
$pdf->Cell(75,8,$waybillresult['description'],1,0,'L',0);
$pdf->MultiCell(45,4,$waybillresult['ship_from']."   (".$warehouseresult['warehousename'].")",1,'C',false);
$pdf->SetXY(158,109);
$pdf->Cell(45,8,$waybillresult['quantity']." ".$waybillresult['unit'],1,1,'L',0);   // empty cell with left,bottom, and right borders


//Second Table
$pdf->Cell(49,10,'',0,1);
$pdf->Cell(49,10,'Transporters Name ','LTR',0,'L',0);   // empty cell with left,top, and right borders
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->Cell(49,10,'Drivers Phone Number',1,0,'L',0);
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->Cell(49,10,'','LR',1,'C',0);  // cell with left and right borders
$pdf->Cell(49,10,'Drivers Name',1,0,'L',0);
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->Cell(49,10,'Vehicles Registration',1,0,'L',0);
$pdf->Cell(49,10,'','LBR',1,'L',0);   // empty cell with left,bottom, and right borders
$pdf->Cell(49,10,'Drivers Signature',1,0,'L',0);
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->Cell(49,10,'',1,1,'L',0);


//Third Table

$pdf->Cell(49,5,'',0,1);
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(50,5,"Intended Location of Delivery: ".$waybillresult['intended_location'],0,1);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(49,5,'',0,1);
$pdf->Cell(98,10,'Loaded By General Services Supervisor ',1,0,'L',0);
$pdf->Cell(40,10,'',0,2,'C');


//$pdf->Image("http://apps.babbangona.com/bg_inventory/qr_generator.php?code=".urlencode($itemWay),$pdf->GetX(),$pdf->GetY(),40,0, "png");
//$pdf->Image("ItemCodes/".$itemWay.".png",$pdf->GetX(),$pdf->GetY(),40,0,'PNG');

$pdf->SetX(10);
//$pdf->Cell(49,10,'',0,1,'C',0);  // cell with left and right borders
$pdf->Cell(49,10,'Name',1,0,'L',0);
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->Cell(49,10,'','',1,'L',0);   // empty cell with left,bottom, and right borders
$pdf->Cell(49,10,'Date',1,0,'L',0);
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->Cell(49,10,'',0,1);
$pdf->Cell(49,10,'Signature',1,0,'L',0);
$pdf->Cell(49,10,'',1,1,'L',0);
$pdf->Cell(49,10,'',0,1);

$pdf->SetFont('Helvetica','B');
$pdf->Cell(49,5,'To be completed by consignee',0,1);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(49,5,'I hereby confirm that the goods were received in the condition stated above.',0,1);

//Last Table
//$pdf->Cell(45,8,'Vehicle Registration:',1,2,'L',0);
$pdf->Cell(49,10,'Name of Customers Representative: ','LTR',0,'L',0);   // empty cell with left,top, and right borders
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->Cell(49,10,'Name of Transporters Representative',1,0,'L',0);
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->Cell(49,10,'','LR',1,'C',0);  // cell with left and right borders
$pdf->Cell(49,10,'Date',1,0,'L',0);
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->Cell(49,10,'Date',1,0,'L',0);
$pdf->Cell(49,10,'','LBR',1,'L',0);   // empty cell with left,bottom, and right borders
$pdf->Cell(49,10,'Signature',1,0,'L',0);
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->Cell(49,10,'Signature',1,0,'L',0);
$pdf->Cell(49,10,'',1,1,'L',0);

$pdf->Cell(150,10,"Notes: ".$waybillresult['notes'],0,1,'L',0); //The notes part of the Sales Shipment.
}


//Output the document
$pdf->Output("Babbangona_".$waybill_id."_Waybill.pdf", 'I');

?>
