<?php
require('fpdf.php');

$nama_instansi = $_GET['p1'];
$no_antrian = $_GET['p2'];
$no_loket = $_GET['p3'];

$pdf = new FPDF('P','mm',array(80,85));
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('Helvetica','B',14);
$pdf->Cell(0,10,$nama_instansi,0,1,'C');
$pdf->Line(2,20.5,78,20.5);
$pdf->SetFont('Helvetica','B',22);
$pdf->Cell(0,18,'NOMOR ANTRIAN',0,1,'C');
$pdf->SetFont('Helvetica','B',50);
$pdf->Cell(0,10,substr($no_antrian,0,3),0,1,'C');
$pdf->SetFont('Helvetica','B',22);
$pdf->Cell(0,16,'LOKET '.$no_loket,0,1,'C');
$pdf->SetFont('Helvetica','',10);
$pdf->Cell(0,2,gmdate("d-m-Y H:i", time()+60*60*7),0,1,'C');
$pdf->Line(2,61,78,61);
$pdf->SetFont('Helvetica','',10);
$pdf->Cell(0,10,'Terima kasih atas kunjungannya',0,1,'C');
$pdf->Output($no_antrian.".pdf",'F');
$pdf->Output();
?>
