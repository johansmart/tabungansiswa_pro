<?php 
session_start();
    include "../../dist/koneksi.php";
    require('../../plugins/fpdf17/fpdf.php');
	if (isset($_GET['no_withdraw']) AND ($_GET['no_withdraw'])) {
		$no_withdraw 	= $_GET['no_withdraw'];
	}
	else {
		die ("Error. No Number Selected! ");	
	}
	
	$select_with=mysql_query("SELECT * FROM tb_withdraw WHERE no_withdraw='$no_withdraw'");
	$withdraw=mysql_fetch_array($select_with);		
		$id_member		= $withdraw['id_member'];
		$jml_withdraw	= $withdraw['jml_withdraw'];
		$jns_withdraw	= $withdraw['jns_withdraw'];
		$tgl_withdraw	= $withdraw['tgl_withdraw'];
		
	$select_mem=mysql_query("SELECT * FROM tb_member WHERE id_member='$id_member'");
	$member=mysql_fetch_array ($select_mem);
		$nik		= $member['nik'];
		$nama		= $member['nama'];
		$telp		= $member['telp'];
	
	class PDF extends FPDF{
		function Header(){
			$this->Image('../../dist/img/print.png',10,10,20);
			$this->SetFont('Arial','B',12);
			$this->Ln(1);
		}
		function Footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,0,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
		function ChapterTitle($num, $label){
			$this->SetFont('Arial','B',11);
			$this->SetFillColor(200,220,255);
			$this->Cell(0,6,"$num $label",0,1,'L',true);
			$this->Ln(0);
		}
		function ChapterTitle2($num, $label){
			$this->SetFont('Arial','B',11);
			$this->SetFillColor(249,249,249);
			$this->Cell(0,6,"$num $label",0,1,'L',true);
			$this->Ln(0);
		}
	}

	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','',11);
	$pdf->SetTextColor(32);
	$pdf->Cell(0,5,'To:',0,1,'R');
	$pdf->Cell(0,5,$nama,0,1,'R');
	$pdf->Cell(0,5,'Tel: '.$telp,0,1,'R');
	$pdf->Cell(0,5,'NIK: '.$nik,0,1,'R');
	
	$pdf->Ln(5);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(0,5,'Date Withdraw  : '.$tgl_withdraw,0,1,'L');
	$pdf->Cell(0,5,'Date Print          : '.date('d-m-Y'),0,1,'L');
	
	$pdf->SetFont('Times','',11);
	$pdf->Cell(0,5,'',0,1,'R');
	$pdf->SetFillColor(200,220,255);
	$pdf->ChapterTitle('No. Withdraw   #',$no_withdraw);
	$pdf->ChapterTitle2('ID Member        #',$id_member);
	
	$pdf->SetFont('Times','B',11);
	$pdf->Cell(0,15,'',0,1,'R');
	$pdf->SetFillColor(224,235,255);
	$pdf->SetDrawColor(192,192,192);
	$pdf->Cell(70,7,'Jumlah Withdraw',1,0,'L');
	$pdf->Cell(70,7,'Jenis Simpanan',1,0,'L');
	$pdf->Cell(50,7,'Tanggal',1,1,'L');
	
	$pdf->SetFont('Times','',11);
	$pdf->Cell(70,7,'IDR '.number_format($jml_withdraw,2,",","."),1,0,'L',0);
	$pdf->Cell(70,7,$jns_withdraw,1,0,'L',0);
	$pdf->Cell(50,7,$tgl_withdraw,1,1,'L',0);
	
	$pdf->Ln(10);
	$pdf->SetFont('Times','',11);
	$pdf->Cell(0,0,'',0,1,'R');
	$pdf->Cell(150,7,'No. Withdraw :',0,0,'R',0);
	$pdf->Cell(40,7,$no_withdraw,0,1,'R',0);
	
	$pdf->Cell(150,7,'Jumlah Terima:',0,0,'R',0);
	$pdf->Cell(40,7,'IDR '.number_format($jml_withdraw,2,",","."),0,1,'R',0);
	
	$pdf->Ln(5);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(0,5,'Note:',0,1,'L');
	$pdf->SetFont('Times','',10);
	$pdf->Cell(0,5,'',0,1,'L');
	
	$pdf->Output();
?>