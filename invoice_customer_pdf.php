<?php

include("config.php");
//require(include/fpdf16/fpdf.php);
include("fpdf181/fpdf.php");
$waybill_id = $_GET['waybill'];
$viewsql = "SELECT * FROM user_invoice WHERE waybillNo = '".$waybill_id."'";
$viewexecute = mysqli_query($db_con, $viewsql);
$viewrun = $viewexecute->fetch_assoc();
if(!$viewrun){
	echo("Error:" .mysqli_error($db_con));
}

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
$pdf->Image('logo_main.jpeg',$pdf->GetX(),$pdf->GetY(),45);

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
$pdf->Cell(90,10,'INVOICE', 0,2,'C');
//$pdf->Cell(90,10,'WAYBILL', 0,1,'C');


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
$pdf->SetXY(-60,70);

$pdf->Cell(50,3,'INVOICE: '.$viewrun['invoiceNo'],0,2,'R',0);
$pdf->Cell(50,3,'DATE: '.$viewrun['invoice_date'],0,2,'R',0);



$pdf->SetXY(10,85);
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(5,7,'TO:',0,0,'L');
$pdf->SetX(-20);
$pdf->Cell(5,7,'FOR:',0,0,'R');
$pdf->SetFont('Helvetica', '', 7);
$pdf->SetXY(10,92);
$pdf->MultiCell(50,4,$viewrun['to_details'],0,'L',false);
$pdf->SetXY(-60,92);
$pdf->MultiCell(50,4,$viewrun['for_details'],0,'R',false);


$pdf->SetXY(10,110);

//Automatic code will be here.
//$pdf->Cell(49,25,'',0,1);//Empty Space
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(8,8,'S/N',1,0,'C',0);
$pdf->Cell(25,8,'Batch Code',1,0,'C',0);
$pdf->Cell(25,8,'Product ID',1,0,'C',0);
$pdf->Cell(30,8,'Description',1,0,'C',0);
$pdf->Cell(25,8,'Waybill No',1,0,'C',0);
$pdf->MultiCell(25,4,'Quantity Delivered(Kg)',1,'C',false);
$pdf->SetXY(148,110);
$pdf->Cell(25,8,'Price per KG',1,0,'C');
$pdf->Cell(25,8,'Amount',1,1,'C',0);

$deduct = ($viewrun['deductions']);
//echo $deduct;
$other  = ($viewrun['other_deductions']);
$amo = ($viewrun['Amount']);

if(($viewrun['deductions'] == "0.00") && ($viewrun['other_deductions'] == "0.00")){
	$final_balance = ($viewrun['Amount']);
}else if(($viewrun['deductions']) != "0.00" && ($viewrun['other_deductions']) == "0.00"){
	$final_balance = ($amo - $deduct);
}else if(($viewrun['deductions']) == "0.00" && ($viewrun['other_deductions']) != "0.00"){
	$final_balance = ($amo - $other);
}else if(($viewrun['deductions'] != "0.00") && ($viewrun['other_deductions'] != "0.00")){
	$final_balance = ($amo - $deduct - $other);
}

$first_balance = $amo - $deduct;

$pdf->SetFont('Helvetica', '');
$pdf->SetFontSize('8');
$pdf->Cell(8,10,'1',1,0,'C',0);
$pdf->Cell(25,10,$viewrun['batchCode'],1,0,'C',0);
$pdf->Cell(25,10,$viewrun['productID'],1,0,'C',0);
$pdf->MultiCell(30,5,$viewrun['description'],1,'C',false);
$pdf->SetXY(98,118);
$pdf->MultiCell(25,5,$viewrun['waybillNo'],1,'C',false);
$pdf->SetXY(123,118);
$pdf->Cell(25,10,$viewrun['QtyDelivered'],1,0,'C',0);
$pdf->Cell(25,10,$viewrun['pricePerItem'],1,2,'C',0);
$pdf->Cell(25,10,'Deductions:',1,2,'C',0);
$pdf->Cell(25,10,'Amount Payable:',1,2,'C',0);
$pdf->Cell(25,10,'Other Deductions:',1,2,'C',0);
$pdf->Cell(25,10,'Balance Payment',1,0,'C',0);
$pdf->SetXY(-37,118);
$pdf->Cell(25,10,$viewrun['Amount'],1,2,'C',0);
$pdf->MultiCell(25,5,$viewrun['deductions']."  ".$viewrun['deductions_type'],1,'C',false);
$pdf->SetXY(-37,138);
$pdf->Cell(25,10,$first_balance,1,2,'C',0);
$pdf->Cell(25,10,$viewrun['other_deductions'],1,2,'C',0);
$pdf->Cell(25,10,$final_balance,1,1,'C',0);




$pdf->SetY(170);
$pdf->SetFontSize(8);
$pdf->Cell(80,4,'All fees are exclusive of Expenses, VAT and any other charges.',0,1);
$pdf->Cell(80,4,'All payments shall be paid within '.$viewrun['number_of_days'].' days of date of this invoice',0,1);
$pdf->Cell(80,4,'All late payments will be assessed at 0.02% daily interest on Amount Invoiced',0,1);
$pdf->Cell(55,4,'Cheque(s) should be written in favor of:',0,2);
$pdf->SetFont('Helvetica','B');
$pdf->Cell(60,4,'Babban Gona Farmer Services Ltd.',0,2);
$pdf->Cell(10,5,'',0,2);  //Empty cell to give space between BG Name and the Wire transfer part.
$pdf->SetFont('Helvetica', '');
$pdf->Cell(70,4,'Wire Transfer all payments into the following account:',0,2);


//Account Details Line 1
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(20,4,'Bank Name:',0,0);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(20,4,'FCMB',0,1);


//Account Details Line 2
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(22,4,'Bank Address:',0,0);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(20,4,'Primrose Towers, 17A Tinubu Street, Lagos',0,1);


//Account Details Line 3
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(20,4,'SWIFT Code:',0,0);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(20,4,'FCMBNGLA',0,1);

//Account Details Line 4
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(22,4,'SORT CODE:',0,0);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(20,4,'214150018',0,1);


//Account Details Line 5
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(22,4,'Account Name:',0,0);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(20,4,'Babban Gona Farmer Services Ltd.',0,1);


//Account Details Line 6
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(25,4,'Account Number:',0,0);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(20,4,'2386305093',0,1);

$pdf->SetY(230);
$pdf->SetFont('Helvetica', 'B');
$pdf->Cell(30,4,'For questions contact:', 0,1);
$pdf->SetFont('Helvetica', '');
$pdf->Cell(30,4,'Segun Babatunde',0,1);
$pdf->Cell(30,4,'+234-708-994-5213',0,1);
$pdf->Cell(30,4,'segun.babatunde@doreopartners.com',0,1);


$pdf->SetY(250);
$pdf->SetFont('Helvetica', '','6');
$pdf->Cell(30,4,'*The sale of this commodity is treated as exempt from the value added tax in accordance with the First Schedule of the Value Added Tax Act (1993)',0,1);

//Output the document
$pdf->Output('example1.pdf', 'I');

?>
