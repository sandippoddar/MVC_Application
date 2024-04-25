<?php

require_once __dir__.'/../vendor/autoload.php';
require_once __dir__.'/../Model/login_signup.php';
require_once __dir__.'/../Controller/pdfEmail.php';
session_start();
use Fpdf\Fpdf;

$userEmail = $_SESSION['userEmail'];
$queryOb = new LoginSignup();
$email = new pdfEmail();
$fileVersion = rand(100000,999999);
$result = $queryOb->fetchCart($userEmail);
$pdf = new Fpdf();
$pdf -> AddPage();
$pdf -> SetFont('Arial', 'B', 16);
$pdf -> Cell(0, 20, "User Receipt", 1, 1, 'C');

$pdf->Cell(70,20,'Product Name',1,0,'C');
$pdf->Cell(70,20,'Product Details',1,0,'C');
$pdf->Cell(0,20,'Product Price',1,1,'C');
foreach ($result as $row) {
  $pdf->Cell(70,20,$row['Product_name'],1,0,'C');
  $pdf->Cell(70,20,$row['caption'],1,0,'C');
  $pdf->Cell(0,20,$row['price'],1,1,'C');
}
$pdf->Output('F','../Uploads/Invoice'.$fileVersion.'.pdf');

$email->sendPdf($userEmail,$fileVersion);
