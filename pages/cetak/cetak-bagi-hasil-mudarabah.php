<?php 
session_start();
    include "../../dist/koneksi.php";
    require('../../plugins/fpdf17/fpdf.php');
	if (isset($_GET['no_transaksi'])) {
		$no_transaksi 	= $_GET['no_transaksi'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	$query=mysql_query("SELECT * FROM tb_bagihasil WHERE no_transaksi='$no_transaksi'");
	$bagi=mysql_fetch_array($query);		
		$id_member		= $bagi['id_member'];
		$tgl_transaksi	= $bagi['tgl_transaksi'];
		$jml_bagihasil	= $bagi['jml_bagihasil'];
		$jns_bagihasil	= $bagi['jns_bagihasil'];
		
	$qry=mysql_query("SELECT * FROM tb_member WHERE id_member='$id_member'");
	$member=mysql_fetch_array ($qry);
		$nik		= $member['nik'];
		$nama		= $member['nama'];
		$email		= $member['email'];
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
	$pdf->Cell(0,5,'Email: '.$email,0,1,'R');
	
	$pdf->Ln(5);
	$pdf->SetFont('Times','',10);
	$pdf->Cell(0,5,'Date Transaksi  : '.$tgl_transaksi,0,1,'L');
	$pdf->Cell(0,5,'Date Print          : '.date('d-m-Y'),0,1,'L');
	
	$pdf->SetFont('Times','',11);
	$pdf->Cell(0,5,'',0,1,'R');
	$pdf->SetFillColor(200,220,255);
	$pdf->ChapterTitle('No. Bagi Hasil   #',$no_transaksi);
	$pdf->ChapterTitle2('ID Member         #',$id_member);
	
	$pdf->SetFont('Times','B',11);
	$pdf->Cell(0,15,'',0,1,'R');
	$pdf->SetFillColor(224,235,255);
	$pdf->SetDrawColor(192,192,192);
	$pdf->Cell(80,7,'Jumlah Bagi Hasil',1,0,'L');
	$pdf->Cell(110,7,'Jenis Bagi Hasil',1,1,'L');
	
	$pdf->SetFont('Times','',11);
	$pdf->Cell(80,7,number_format($jml_bagihasil,0,",","."),1,0,'L',0);
	$pdf->Cell(110,7,$jns_bagihasil,1,1,'L',0);
	
	$pdf->Ln(10);
	$pdf->SetFont('Times','',11);
	$pdf->Cell(0,0,'',0,1,'R');
	$pdf->Cell(150,7,'Jumlah Bagi Hasil :',0,0,'R',0);
	$pdf->Cell(40,7,'IDR '.number_format($jml_bagihasil,2,",","."),0,1,'R',0);
	
	$pdf->Ln(5);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(0,5,'Note:',0,1,'L');
	$pdf->SetFont('Times','',10);
	$pdf->Cell(0,5,'',0,1,'L');
	
	$pdf->Output();
?>