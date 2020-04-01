<?php 
session_start();
    include "../../dist/koneksi.php";
    require('../../plugins/fpdf17/fpdf.php');
	if (isset($_GET['no_simpan']) AND ($_GET['no_simpan'])) {
		$no_simpan 	= $_GET['no_simpan'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	$query=mysql_query("SELECT * FROM tb_simpan WHERE no_simpan='$no_simpan'");
	$simpan=mysql_fetch_array($query);		
		$id_member		= $simpan['id_member'];
		$tgl_transaksi	= $simpan['tgl_transaksi'];
		$jml_simpan		= $simpan['jml_simpan'];
		$jns_simpan		= $simpan['jenis_simpan'];
		
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
	$pdf->Cell(0,5,'Date Order  : '.$tgl_transaksi,0,1,'L');
	$pdf->Cell(0,5,'Date Print   : '.date('d-m-Y'),0,1,'L');
	
	$pdf->SetFont('Times','',11);
	$pdf->Cell(0,5,'',0,1,'R');
	$pdf->SetFillColor(200,220,255);
	$pdf->ChapterTitle('No. Simpan   #',$no_simpan);
	$pdf->ChapterTitle2('ID Member     #',$id_member);
	
	$pdf->SetFont('Times','B',11);
	$pdf->Cell(0,15,'',0,1,'R');
	$pdf->SetFillColor(224,235,255);
	$pdf->SetDrawColor(192,192,192);
	$pdf->Cell(80,7,'Jumlah Simpanan',1,0,'L');
	$pdf->Cell(110,7,'Jenis Simpanan',1,1,'L');
	
	$pdf->SetFont('Times','',11);
	$pdf->Cell(80,7,number_format($jml_simpan,0,",","."),1,0,'L',0);
	$pdf->Cell(110,7,'Simpanan '.$jns_simpan,1,1,'L',0);
	
	$pdf->Ln(10);
	$pdf->SetFont('Times','',11);
	$pdf->Cell(0,0,'',0,1,'R');
	$pdf->Cell(150,7,'Jumlah Simpan :',0,0,'R',0);
	$pdf->Cell(40,7,'IDR '.number_format($jml_simpan,2,",","."),0,1,'R',0);
	
	$pdf->Ln(5);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(0,5,'Note:',0,1,'L');
	$pdf->SetFont('Times','',10);
	$pdf->Cell(0,5,'',0,1,'L');
	
	$pdf->Output();
?>