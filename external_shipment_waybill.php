<?php

include("config.php");
//require(include/fpdf16/fpdf.php);
include("fpdf181/fpdf.php");
$waybill_id = $_GET['waybill'];

//Create a new FPDF Object
$pdf = new FPDF();

//set document properties
$pdf->SetAuthor('Iyasele Rehoboth');
$pdf->SetTitle('FPDF Tutorial');


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
$pdf->Cell(90,10,'EXTERNAL SHIPMENT', 0,2,'C');
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
$viewsql = "SELECT * FROM user_waybill WHERE waybill_id = '$waybill_id' LIMIT 1";
$viewexecute = mysqli_query($db_con, $viewsql);
while($viewrun = mysqli_fetch_array($viewexecute)){
    
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
$pdf->Cell(50,3,"Waybill ID: ".$viewrun['waybill_id'],0,2,'R');
$pdf->Cell(50,3,'SHIPMENT DATE: '.$viewrun['date'],0,1,'R');

$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(50,3,'REQUESTED OUT BY: '.$viewrun['personnelName'],0,1,'L');
}

//Automatic code will be here.
$pdf->Cell(49,10,'',0,1);
//$pdf->Cell(8,8,'QTY ','LTR',0,'L',0);   // empty cell with left,top, and right borders
$pdf->Cell(28,8,'PRODUCT ID',1,0,'L',0);
$pdf->Cell(40,8,'DESCRIPTION',1,0,'L',0);
$pdf->Cell(40,8,'SHIP FROM',1,0,'L',0);
$pdf->Cell(41,8,'DESTINATION',1,0,'L',0);
$pdf->Cell(45,8,'QUANTITY LOADED',1,1,'L',0);

$anothersql = "SELECT quantity,product_id,description,ship_from,destination,unit FROM user_waybill WHERE waybill_id = '$waybill_id'";
$anotherexe = mysqli_query($db_con, $anothersql);
if(!$anotherexe){
	die(mysqli_error($db_con));
}
while($anotherRun = mysqli_fetch_array($anotherexe)){
	$warehouseSQL = "SELECT * FROM warehouse_t WHERE warehouseid = '".$anotherRun['ship_from']."'";
	$warehouseRUN = mysqli_query($db_con, $warehouseSQL);
	$warehouseEXEC = $warehouseRUN->fetch_assoc();	
	if(!$warehouseEXEC){
	echo("Error: Warehouse Can't be found...." .mysqli_error($db_con));
	}

    $pdf->SetFont('Helvetica', '');
    $pdf->Cell(28,8,$anotherRun['product_id'],1,0,'L',0);
    $pdf->Cell(40,8,$anotherRun['description'],1,0,'L',0);
    $pdf->MultiCell(40,4,$anotherRun['ship_from']."   (".$warehouseEXEC['warehousename'].")",1,'C',false);
    $pdf->SetXY(118,109);
    $pdf->Cell(41,8,$anotherRun['destination'],1,0,'L',0);
    $pdf->Cell(45,8,$anotherRun['quantity']." ".$anotherRun['unit'],1,1,'L',0);   // empty cell with left,bottom, and right borders
}

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

$secondSql = "SELECT * FROM user_waybill WHERE waybill_id = '".$waybill_id."'";
$anotherAgain = mysqli_query($db_con, $secondSql);
while($shipFrom = mysqli_fetch_array($anotherAgain)){

//Third Table

$pdf->Cell(49,5,'',0,1);
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(50,5,"Intended Location of Delivery: ".$shipFrom['intended_location'],0,1);
$pdf->SetFont('Helvetica', '');
}
$pdf->Cell(49,5,'',0,1);
$pdf->Cell(98,10,'Loaded By General Services Supervisor ',1,0,'L',0); 
$pdf->Cell(40,10,'Item QR Code ',0,2,'C'); 

//$pdf->Image("http://apps.babbangona.com/bg_inventory/qr_generator.php?code=".urlencode($itemWay),$pdf->GetX(),$pdf->GetY(),40,0, "png");
$pdf->Image("ItemCodes/".$itemWay.".png",$pdf->GetX(),$pdf->GetY(),40,0,'PNG');

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



// $pdf->Cell(45,8,'',0,2);
// $pdf->Cell(45,8,'Transporters Name: ',0,0,0);   // empty cell with left,top, and right borders 


// $pdf = new PDF();
// // Column headings
// $pdf->addPage();
// $pdf->setAutoPageBreak(true);

// $pdf->setFont('Times','B',14);
// $pdf->text(50,8,'FORMULIR PERMINTAAN KENDARAAN');

// $pdf->setFont('Times','B',6);
// $pdf->FancyTable($header,$data);


//Output the document
$pdf->Output("Babbangona_".$waybill_id."_Waybill.pdf", 'I');

?>
