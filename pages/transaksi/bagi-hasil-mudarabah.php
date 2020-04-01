<?php
	if (isset($_GET['id_member']) AND ($_GET['jml_bagihasil'])) {
		$id_member		= $_GET['id_member'];
		$jml_bagihasil	= $_GET['jml_bagihasil'];
	}
	else{
		die ("Error. No ID Selected! ");	
	}
	
	include "dist/koneksi.php";
		//fungsi kode otomatis
		function kdauto($tabel, $inisial){
		$struktur   = mysql_query("SELECT * FROM $tabel");
		$field      = mysql_field_name($struktur,0);
		$panjang    = mysql_field_len($struktur,0);
		$qry  = mysql_query("SELECT max(".$field.") FROM ".$tabel);
		$row  = mysql_fetch_array($qry);
		if ($row[0]=="") {
		$angka=0;
		}
		else {
		$angka= substr($row[0], strlen($inisial));
		}
		$angka++;
		$angka      =strval($angka);
		$tmp  ="";
		for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";
		}
		return $inisial.$tmp.$angka;
		}
	$no_transaksi	= kdauto ("tb_bagihasil","BH-");
	$tgl_transaksi	= date ("Y-m-d H:m:s");
	
	$ceksaldo=mysql_query("SELECT * FROM tb_member WHERE id_member='$id_member'");
	$saldo=mysql_fetch_array($ceksaldo);
		$mudarabah	=$saldo['mudarabah'];
		
		if($mudarabah < $jml_bagihasil) {
		echo "
			<div class='register-box'>
				<div class='register-logo'><b>Oops!</b> Saldo Deficit</div>
				<div class='box box-primary'>
					<div class='register-box-body'>
						<p>Harap periksa kembali dan pastikan Saldo Mudarabah masih tersedia.</p>
						<div class='row'>
							<div class='col-xs-8'></div>
							<div class='col-xs-4'>
								<button type='button' onclick=location.href='home-admin.php?page=pre-bagi-hasil-mudarabah' class='btn btn-block btn-warning'>Back</button>
							</div>
						</div>
					</div>
				</div>
			</div>";
		}
		else{
		$insert = "INSERT INTO tb_bagihasil (no_transaksi, id_member, tgl_transaksi, jml_bagihasil, jns_bagihasil) VALUES ('$no_transaksi', '$id_member', '$tgl_transaksi', '$jml_bagihasil', 'Mudarabah')";
		$query = mysql_query ($insert);
		$update_saldo = mysql_query("UPDATE tb_member SET mudarabah=mudarabah - $jml_bagihasil WHERE id_member='$id_member'");
		
		if($query){
			$ambildata=mysql_query("SELECT * FROM tb_bagihasil WHERE no_transaksi='$no_transaksi'");
			$hasil=mysql_fetch_array ($ambildata);
				$id_member		= $hasil['id_member'];
				$tgl_transaksi	= $hasil['tgl_transaksi'];
				$jml_bagihasil		= number_format($hasil['jml_bagihasil'],2,',','.');
				$jns_bagihasil		= $hasil['jns_bagihasil'];
				
			$qry=mysql_query("SELECT * FROM tb_member WHERE id_member='$id_member'");
			$view=mysql_fetch_array ($qry);
				$nik		= $view['nik'];
				$nama		= $view['nama'];
				$email		= $view['email'];
				$telp		= $view['telp'];
			
			echo "
				<section class='content-header'>
					<h1>Transaction No #<small>$no_transaksi</small></h1>
					<ol class='breadcrumb'>
						<li><a href='home-admin.php'><i class='fa fa-dashboard'></i>Dashboard</a></li>
						<li class='active'>Print Transaction</li>
					</ol>
				</section>
				<div class='pad margin no-print'>
					<div class='callout callout-info' style='margin-bottom: 0;'>
						<h4><i class='fa fa-info'></i> Note:</h4>
						Catat dan simpan Nomor transaksi bagi hasil. Periksa kembali detail bagi hasil di bawah ini sebelum print.
					</div>
				</div>
				<section class='invoice'>
					<div class='row'>
						<div class='col-xs-12'>
							<h2 class='page-header'><i class='fa fa-globe'></i> Koperasi KSP.<small class='pull-right'>Date Transaksi: $tgl_transaksi</small></h2>
						</div>
					</div>
					<div class='row invoice-info'>
						<div class='col-sm-4 invoice-col'>
							<u>Koperasi:</u>
							<address>
							<strong>Koperasi Simpan Pinjam KSP</strong><br>
							Alamat<br>
							Phone: <br>
							Email: 
							</address>
						</div>
						<div class='col-sm-4 invoice-col'>
							<u>To:</u>
							<address>
							<strong>$nama</strong><br>
							NIK: $nik<br>
							Phone: $telp<br>
							Email: $email
							</address>
						</div>
						<div class='col-sm-4 invoice-col'>
							<b>Transaction No# $no_transaksi</b><br>
							<b>Member ID:</b> $id_member<br>
						</div>
					</div><br />
					<div class='row'>
						<div class='col-xs-12 table-responsive'>
							<table class='table table-striped'>
							<thead>
								<tr>
									<th>Jumlah Bagi Hasil</th>
									<th>Jenis Bagi Hasil</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>IDR $jml_bagihasil</td>
									<td>Simpanan $jns_bagihasil</td>
								</tr>
							</tbody>
							</table>
						</div>
					</div>
					<div class='row'>
						<div class='col-xs-6'></div>
						<div class='col-xs-6'>
							<div class='table-responsive'>
								<table class='table'>
									<tr>
										<th style='width:50%'>Jumlah Bagi Hasil:</th>
										<td>IDR $jml_bagihasil</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class='row no-print'>
						<div class='col-xs-12'>
							<a href='./pages/cetak/cetak-bagi-hasil-mudarabah.php?no_transaksi=$no_transaksi' target='_blank' class='btn btn-warning pull-right'><i class='fa fa-print'></i> Print</a>
							<button type='button' onclick=location.href='home-admin.php?page=pre-bagi-hasil-mudarabah' class='btn btn-primary pull-right' style='margin-right: 10px'>Back</button>
						</div>
					</div>
				</section>
				<div class='clearfix'></div>";
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
?>