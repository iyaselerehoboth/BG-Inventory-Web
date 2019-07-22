<?php 


include("config.php");
//require(include/fpdf16/fpdf.php);
include("fpdf181/fpdf.php");
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Times', '', 14);
$pdf->write(5, 'For a link to page 2 - Click ');
$pdf->SetFont('', 'U');
$pdf->SetTextColor(0, 0, 255);
$link_to_pg2 = $pdf->AddLink();
$pdf->write(5, 'here', $link_to_pg2);
$pdf->SetFont('');
//Second page
$pdf->AddPage();
$pdf->SetLink($link_to_pg2);
$pdf->Image('https://cdn.vox-cdn.com/thumbor/McsVhT6bkHw6U0tzOZnawPmDgOI=/0x0:2040x1360/920x613/filters:focal(443x747:769x1073):format(webp)/cdn.vox-cdn.com/uploads/chorus_image/image/59226439/jbareham_170504_1691_0004.0.0.jpg', 10, 10, 30, 0, '', 'http://www.php.net');
$pdf->ln(20);
$pdf->SetTextColor(1);
$pdf->Cell(0, 5, 'This is a link and a clickable image', 0, 1, 'L');
$pdf->SetFont('', 'U');
$pdf->SetTextColor(0, 0, 255);
$pdf->Write(5, 'www.oreilly.com', 'http://www.oreilly.com');
$pdf->Output();
?>