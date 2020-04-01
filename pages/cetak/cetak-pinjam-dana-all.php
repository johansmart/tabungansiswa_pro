<?php
	session_start();
    include "../../dist/koneksi.php";
    require('../../plugins/fpdf17/fpdf.php');
				
	$select_pinjam="SELECT no_pinjam, id_member, tgl_transaksi, jml_pinjam, tenor, bunga_pinjam, angsuran, status FROM tb_pinjam";
	$query_p = mysql_query($select_pinjam);
	$data = array();
		while($row = mysql_fetch_assoc($query_p)){
			array_push($data, $row);
		}
		
	$Judul = "LAPORAN TRANSAKSI PINJAM DANA";
	$Header= array(
		array("label"=>"No. Pinjam", "length"=>40, "align"=>"L"),
		array("label"=>"ID Member", "length"=>30, "align"=>"L"),
		array("label"=>"Tanggal Transaksi", "length"=>45, "align"=>"L"),
		array("label"=>"Jumlah", "length"=>45, "align"=>"L"),
		array("label"=>"Tenor", "length"=>25, "align"=>"L"),
		array("label"=>"Bunga", "length"=>30, "align"=>"L"),
		array("label"=>"Angsuran", "length"=>35, "align"=>"L"),
		array("label"=>"Status", "length"=>25, "align"=>"L"),
	);
	
	$pdf = new FPDF();
	$pdf->AddPage('L','A4','C');
	//judul
	$pdf->SetFont('arial','B','14');
	$pdf->Cell(0, 15, $Judul, '0', 1, 'C');
	//header
	$pdf->SetFont('arial','b','11');
	$pdf->SetFillColor(190,190,0);
	$pdf->SetTextColor(255);
	$pdf->setDrawColor(128,0,0);
	foreach ($Header as $Kolom){
		$pdf->Cell($Kolom['length'], 9, $Kolom['label'], 2, '0', $Kolom['align'], true);
	}
	$pdf->Ln();
	//menampilkan data
	$pdf->SetFillColor(244,235,255);
	$pdf->SettextColor(0);
	$pdf->SetFont('arial','','10');
	$fill =false;
	foreach ($data as $Baris){
		$i= 0;
		foreach ($Baris as $Cell){
			$pdf->Cell ($Header[$i]['length'], 8, $Cell, 2, '0', $Kolom['align'], $fill);
			$i++;
		}
		$fill = !$fill;
		$pdf->Ln();
	}
	//output
	$pdf->Output();
?>