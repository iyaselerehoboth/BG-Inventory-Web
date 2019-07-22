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
$pdf->Cell(110,10,'DELIVERY WAYBILL', 0,1,'C');
//$pdf->Cell(90,10,'WAYBILL', 0,1,'C');


$pdf->SetFont('Helvetica', 'B', 8);
$pdf->SetY(50);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(50,3,'Kaduna',0,2);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(50,3,'Saulawa, Ikara District', 0, 2);
$pdf->Cell(50,3,'Kaduna, Nigeria', 0, 1);

//echo $waybill_id;
$waybillsql = "SELECT * FROM user_waybill WHERE waybill_id = '$waybill_id' LIMIT 1";
$waybillexecute = mysqli_query($db_con, $waybillsql);
while($waybillresult = mysqli_fetch_array($waybillexecute)){

$waybillQR = $waybillresult['waybill_id'];
$itemWay = $waybillresult['product_id'];
$pdf->SetXY(80, 40);


//$pdf->Image("http://apps.babbangona.com/bg_inventory/qr_generator.php?code=".urlencode($imageWay),$pdf->GetX(),$pdf->GetY(),40,0, "png");
$pdf->Image("QRCodes/".$waybillQR.".png",$pdf->GetX(),$pdf->GetY(),40,0,'PNG');
//$pdf->SetY(70);
$pdf->SetY(63);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(50,3,'DELIVERY ADDRESS',0,2);
$pdf->Cell(50,3,'Nestle Nigeria Plc.',0,2);
$pdf->Cell(50,3,'Km 7, Ota, Idi-Iroko Road',0,2);
$pdf->Cell(50,3,'Ota, Ogun State',0,1);

$pdf->SetY(78);
$pdf->Cell(50,3,'Oyebanji Awoniyi - 0802-863-9659',0,2);
$pdf->Cell(50,3,'Purchase order: 4548871487',0,2);
$pdf->Cell(50,3,'Vendor Number: 101117300',0,2);
$pdf->Cell(50,3,'Nestle Material Number: 41192510',0,2);
$pdf->Cell(50,3,'Vendor Site City: Zaria, Kaduna',0,0);

$pdf->SetXY(140,91);
$pdf->Cell(50,3,"Waybill ID: ".$waybillresult['waybill_id'],0,2,'L');
$pdf->Cell(50,3,'SHIPMENT DATE: '.$waybillresult['date'],0,2,'L');
$pdf->Cell(50,3,'CALL UP DATE: ',0,2,'L');



//Automatic code will be here.
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(60,4,'To be completed at the point of receiving',0,1,'BR');
$pdf->SetXY(5,109);
$pdf->Cell(20,12,'BATCH CODE ',1,0,'C',0);   // empty cell with left,top, and right borders
$pdf->Cell(20,12,'PRODUCT ID',1,0,'C',0);
$pdf->Cell(29,12,'DESCRIPTION',1,0,'C',0);
$pdf->Cell(28,12,'QUANTITY LOADED',1,0,'C',0);
$pdf->Cell(27,12,'UNIT OF MEASURE',1,0,'C',0);
$pdf->Cell(29,12,'QUANTITY RECEIVED',1,0,'C',0);
$pdf->Cell(27,12,'UNIT OF MEASURE',1,0,'C',0);
$pdf->Cell(20,12,'COMMENTS',1,1,'C',0);

$pdf->SetX(5);
$pdf->SetFont('Helvetica', '', 7.5);
$pdf->MultiCell(20,6,$waybillresult['batch_code'],1,'C',false);  // cell with left and right borders
$pdf->SetXY(25,121);
$pdf->Cell(20,12,$waybillresult['product_id'],1,0,'C',0);
$pdf->MultiCell(29,6,$waybillresult['description'],1,'C',false);
$pdf->SetXY(74,121);
$pdf->Cell(28,12,$waybillresult['quantity']." ".$waybillresult['unit'],1,0,'C',0);
$pdf->Cell(27,12,$waybillresult['unit_of_measure'],1,0,'C',0);
$pdf->Cell(29,12,'',1,0,'C',0);
$pdf->Cell(27,12,'',1,0,'C',0);
$pdf->Cell(20,12,'',1,1,'C',0);



//Second Table
$pdf->Cell(49,10,'',0,1);
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(49,10,'Transporters Name ',1,0,'L',0);   // empty cell with left,top, and right borders
$pdf->SetFont('Helvetica', '');
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(49,10,'Drivers Phone Number',1,0,'L',0);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->Cell(49,10,'','LR',1,'C',0);  // cell with left and right borders
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(49,10,'Drivers Name',1,0,'L',0);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(49,10,'Vehicles Registration',1,0,'L',0);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(49,10,'','LBR',1,'L',0);   // empty cell with left,bottom, and right borders
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(49,10,'Drivers Signature',1,0,'L',0);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(49,10,'Ship From',1,0,'L',0);
$pdf->SetFont('Helvetica', '');

$warehousesql = "SELECT * FROM warehouse_t WHERE warehouseid = '".$waybillresult['ship_from']."'";
$warehouserun = mysqli_query($db_con, $warehousesql);
$warehouseresult = $warehouserun->fetch_assoc();
if(!$warehouseresult){
    echo("Error: Warehouse Can't be found...." .mysqli_error($db_con));
}

$pdf->MultiCell(49,5,$waybillresult['ship_from']."   (".$warehouseresult['warehousename'].")",1,'C',false);
//$pdf->MultiCell(40,4,$anotherRun['ship_from']."   (".$warehouseEXEC['warehousename'].")",1,'C',false);
$pdf->SetXY(123,170);



//Third Table

$pdf->Cell(49,5,'',0,1);
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(50,5,"Intended Location of Delivery: ".$waybillresult['intended_location'],0,1);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(49,2,'',0,1);
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(98,10,'Loaded By General Services Supervisor ',1,0,'L',0);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(40,10,'',0,1,'C');

//$pdf->Image("http://apps.babbangona.com/bg_inventory/qr_generator.php?code=".urlencode($itemWay),$pdf->GetX(),$pdf->GetY(),40,0, "png");
//$pdf->Image("ItemCodes/".$itemWay.".png",$pdf->GetX(),$pdf->GetY(),40,0,'PNG');
//$pdf->SetXY(10,200);
//$pdf->Cell(49,10,'','L',1,'C',0);  // cell with left and right borders
$pdf->SetFont('Helvetica','B');
$pdf->Cell(49,10,'Name',1,0,'L',0);
$pdf->SetFont('Helvetica','');
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->Cell(49,10,'','',1,'L',0);   // empty cell with left,bottom, and right borders
$pdf->SetFont('Helvetica','B');
$pdf->Cell(49,10,'Date',1,0,'L',0);
$pdf->SetFont('Helvetica','');
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->Cell(49,10,'',0,1);
$pdf->SetFont('Helvetica','B');
$pdf->Cell(49,10,'Signature',1,0,'L',0);
$pdf->SetFont('Helvetica','');
$pdf->Cell(49,10,'',1,1,'L',0);
$pdf->Cell(49,10,'',0,1);

$pdf->SetFont('Helvetica','B');
$pdf->Cell(49,5,'To be completed by consignee',0,1);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(49,5,'I hereby confirm that the goods were received in the condition stated above.',0,1);

//Last Table
//$pdf->Cell(45,8,'Vehicle Registration:',1,2,'L',0);
$pdf->SetFont('Helvetica','B');
$pdf->Cell(49,10,'Name of Customers Representative: ','LTR',0,'L',0);   // empty cell with left,top, and right borders
$pdf->SetFont('Helvetica','');
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->SetFont('Helvetica','B');
$pdf->Cell(49,10,'Name of Transporters Representative',1,0,'L',0);
$pdf->SetFont('Helvetica','');
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->Cell(49,10,'','LR',1,'C',0);  // cell with left and right borders
$pdf->SetFont('Helvetica','B');
$pdf->Cell(49,10,'Date',1,0,'L',0);
$pdf->SetFont('Helvetica','');
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->SetFont('Helvetica','B');
$pdf->Cell(49,10,'Date',1,0,'L',0);
$pdf->SetFont('Helvetica','');
$pdf->Cell(49,10,'','LBR',1,'L',0);   // empty cell with left,bottom, and right borders
$pdf->SetFont('Helvetica','B');
$pdf->Cell(49,10,'Signature',1,0,'L',0);
$pdf->SetFont('Helvetica','');
$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->SetFont('Helvetica','B');
$pdf->Cell(49,10,'Signature',1,0,'L',0);
$pdf->SetFont('Helvetica','');
$pdf->Cell(49,10,'',1,1,'L',0);
}


//Output the document
$pdf->Output("Babbangona_".$waybill_id."_Waybill.pdf", 'I');

?>
