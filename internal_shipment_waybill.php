<?php

include("config.php");
//require(include/fpdf16/fpdf.php);
include("fpdf181/fpdf.php");


//Create a new FPDF Object
$pdf = new FPDF();

//set document properties
$pdf->SetAuthor('Iyasele Rehoboth');
$pdf->SetTitle('FPDF Tutorial');


// //Time to display table on PDF
// $result = mysqli_query("SELECT transactionID, item, region, destination FROM web_transaction", $db_con);

// $column_trans = "";
// $column_item = "";
// $column_region = "";
// $column_dest = "";

// while($row = mysqli_fetch_array($result)){

// 	$trans = $row["transactionID"];
// 	$item = $row["item"];
// 	$region = $row['region'];
// 	$destination = $row['destination'];


// 	$column_trans = $column_trans.$trans."\n";
// 	$column_item = $column_item.$item."\n";
// 	$column_region = $column_region.$item."\n";
// 	$column_dest = $column_dest.$destination."\n";
// }
// mysql_close();



//set font for the entire document
$pdf->SetFont('Helvetica', 'B', 20);
$pdf->SetTextColor(50,60,100);

//set up a page
$pdf->AddPage('P');
$pdf->SetDisplayMode('real');

// //display the title with a border around it
// $pdf->SetXY(50,20);
// $pdf->SetDrawColor(50,60,100);
// $pdf->Cell(100,10,'FPDF Tutorial Test',1,0,'C',0);


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
$pdf->Cell(90,10,'INTERNAL SHIPMENT', 0,2,'C');
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

$waybill_id = $_GET['waybill'];
//echo $waybill_id;
$viewsql = "SELECT * FROM user_waybill WHERE waybill_id = '$waybill_id'";
$viewexecute = mysqli_query($db_con, $viewsql);
while($viewrun = mysqli_fetch_array($viewexecute)){
    
$pdf->SetY(70);
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(50,3,'Kaduna',0,2);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(50,3,'Saulawa Village',0,2);
$pdf->Cell(50,3,'Ikara LGA',0,2);
$pdf->Cell(50,3,'Kaduna, Nigeria',0,1);

$pdf->SetX(-70);
$pdf->Cell(50,3,'WAYBILL ID: '.$viewrun['waybill_id'],0,2,'C');
$pdf->Cell(50,3,'SHIPMENT DATE: '.$viewrun['date'],0,1,'C');

$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(50,3,'REQUESTED OUT BY: Joshua Andrew',0,1,'L');


//Automatic code will be here.
$pdf->Cell(49,10,'',0,1);
//$pdf->Cell(8,8,'QTY ','LTR',0,'L',0);   // empty cell with left,top, and right borders
$pdf->Cell(28,8,'PRODUCT ID',1,0,'L',0);
$pdf->Cell(40,8,'DESCRIPTION',1,0,'L',0);
$pdf->Cell(40,8,'SHIP FROM',1,0,'L',0);
$pdf->Cell(41,8,'DESTINATION',1,0,'L',0);
$pdf->Cell(39,8,'QUANTITY LOADED',1,0,'L',0);



    $pdf->Cell(20,8,'','L',1,'C',0);  // cell with left and right borders
    //$pdf->Cell(8,8,'',1,0,'L',0);
    $pdf->Cell(28,8,'',1,0,'L',0);
    $pdf->Cell(40,8,'',1,0,'L',0);
    $pdf->Cell(40,8,'',1,0,'L',0);
    $pdf->Cell(41,8,'',1,0,'L',0);
    $pdf->Cell(39,8,'','LBR',1,'L',0);   // empty cell with left,bottom, and right borders
}


// $pdf->Cell(49,10,'Drivers Signature:',1,0,'L',0);
// $pdf->Cell(49,10,'',1,0,'L',0);
// $pdf->Cell(49,10,'',1,0,'L',0);
//$pdf->Cell(49,10,'',1,1,'L',0);


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

$pdf->Cell(49,10,'',0,1);
$pdf->Cell(98,10,'Loaded By General Services Supervisor ','LT',0,'L',0);   // empty cell with left and top borders
//$pdf->Cell(49,10,'',1,0,'L',0);
//$pdf->Cell(49,10,'',1,0,'L',0);
$pdf->Cell(49,10,'','L',1,'C',0);  // cell with left and right borders
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
$pdf->Output('example1.pdf', 'I');

?>
