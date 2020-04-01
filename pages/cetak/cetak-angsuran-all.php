<?php
	session_start();
    include "../../dist/koneksi.php";
    require('../../plugins/fpdf17/fpdf.php');
				
	$select_angsuran="SELECT no_angsuran, no_pinjam, angsuran_ke, jml_angsur, tgl_angsur FROM tb_angsuran";
	$query_a = mysql_query($select_angsuran);
	$data = array();
		while($row = mysql_fetch_assoc($query_a)){
			array_push($data, $row);
		}
		
	$Judul = "LAPORAN TRANSAKSI ANGSURAN";
	$Header= array(
		array("label"=>"No. Angsuran", "length"=>45, "align"=>"L"),
		array("label"=>"No. Pinjam", "length"=>35, "align"=>"L"),
		array("label"=>"Angsuran Ke #", "length"=>30, "align"=>"L"),
		array("label"=>"Jumlah #", "length"=>40, "align"=>"L"),
		array("label"=>"Tanggal", "length"=>40, "align"=>"L"),
	);
	
	$pdf = new FPDF();
	$pdf->AddPage('P','A4','C');
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