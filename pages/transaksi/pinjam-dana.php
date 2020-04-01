<?php
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
	$no_pinjam		= kdauto ("tb_pinjam","P-");
	$tgl_transaksi	= date ("Y-m-d H:m:s");
	
	if ($_POST['save'] == "save") {
	$id_member		=$_POST['id_member'];
	$jml_pinjam		=$_POST['jml_pinjam'];
	$bunga_pinjam	=$_POST['bunga_pinjam'];
	$tenor			=$_POST['tenor'];
	$biaya_adm		=$_POST['biaya_adm'];
	$ket			=$_POST['ket'];
	
	if ($_POST['tenor'] == "6"){
		$bunga	= ($bunga_pinjam / 100) * 0.5;
		$nilai_bunga	= $jml_pinjam * $bunga;
	}
	else if ($_POST['tenor'] == "12"){
		$bunga	= ($bunga_pinjam / 100) * 1;
		$nilai_bunga	= $jml_pinjam * $bunga;
	}
	else if($_POST['tenor'] == "18"){
		$bunga	= ($bunga_pinjam / 100) * 1.5;
		$nilai_bunga	= $jml_pinjam * $bunga;
	}
	else if($_POST['tenor'] == "24"){
		$bunga	= ($bunga_pinjam / 100) * 2;
		$nilai_bunga	= $jml_pinjam * $bunga;
	}
	else if($_POST['tenor'] == "36"){
		$bunga	= ($bunga_pinjam / 100) * 3;
		$nilai_bunga	= $jml_pinjam * $bunga;
	}
	else {
		$bunga	= ($bunga_pinjam / 100) * 4;
		$nilai_bunga	= $jml_pinjam * $bunga;
	}
	$total_pinjam	= $jml_pinjam + $nilai_bunga;
	
	$cekstatuspinjam=mysql_query("SELECT status FROM tb_pinjam WHERE id_member='$_POST[id_member]'");
	$statuspinjam=mysql_fetch_array ($cekstatuspinjam);
		$status		= $statuspinjam['status'];
	
		if (empty($_POST['id_member']) || empty($_POST['jml_pinjam']) || empty($_POST['bunga_pinjam']) || empty($_POST['tenor']) || empty($_POST['biaya_adm'])) {
		echo "
		<div class='register-box'>
			<div class='register-logo'><b>Oops!</b> Data Tidak Lengkap.</div>
			<div class='box box-primary'>
				<div class='register-box-body'>
					<p>Harap periksa kembali dan pastikan data yang Anda masukan lengkap dan benar.</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-admin.php?page=form-pinjam-dana' class='btn btn-block btn-warning'>Back</button>
						</div>
					</div>
				</div>
			</div>
		</div>";
		}
		
		else if($status == "Open") {
		echo "
		<div class='register-box'>
			<div class='register-logo'><b>Oops!</b> Pinjaman Belum Lunas.</div>
			<div class='box box-primary'>
				<div class='register-box-body'>
					<p>Harap periksa kembali data pinjaman member bersangkutan. Berdasarkan data, pinjaman sebelumnya belum lunas</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-admin.php?page=form-pinjam-dana' class='btn btn-block btn-warning'>Back</button>
						</div>
					</div>
				</div>
			</div>
		</div>";
		}
		
		else{
		$angsuran	= $total_pinjam / $tenor;
		$insert = "INSERT INTO tb_pinjam (no_pinjam, id_member, tgl_transaksi, jml_pinjam, tenor, bunga_pinjam, total_pinjam, angsuran, biaya_adm, sisa_tenor, status, ket) VALUES ('$no_pinjam', '$id_member', '$tgl_transaksi', '$jml_pinjam', '$tenor', '$bunga_pinjam', '$total_pinjam', '$angsuran', '$biaya_adm', '$tenor', 'Open', '$ket')";
		$query = mysql_query ($insert);
		
		if($query){
			$ambildata=mysql_query("SELECT * FROM tb_pinjam WHERE no_pinjam='$no_pinjam'");
			$hasil=mysql_fetch_array ($ambildata);
				$id_member		= $hasil['id_member'];
				$tgl_transaksi	= $hasil['tgl_transaksi'];
				$jml_pinjam		= number_format($hasil['jml_pinjam'],2,',','.');
				$tenor			= $hasil['tenor'];
				$bunga_pinjam	= $hasil['bunga_pinjam'];
				$total_pinjam	= number_format($hasil['total_pinjam'],2,',','.');
				$angsuran		= number_format($hasil['angsuran'],2,',','.');
				$biaya_adm		= number_format($hasil['biaya_adm'],2,',','.');
				$ket			= $hasil['ket'];
				
			$qry=mysql_query("SELECT * FROM tb_member WHERE id_member='$id_member'");
			$view=mysql_fetch_array ($qry);
				$nik		= $view['nik'];
				$nama		= $view['nama'];
				$email		= $view['email'];
				$telp		= $view['telp'];
			
			echo "
				<section class='content-header'>
					<h1>Transaction No #<small>$no_pinjam</small></h1>
					<ol class='breadcrumb'>
						<li><a href='home-admin.php'><i class='fa fa-dashboard'></i>Dashboard</a></li>
						<li class='active'>Print Transaction</li>
					</ol>
				</section>
				<div class='pad margin no-print'>
					<div class='callout callout-info' style='margin-bottom: 0;'>
						<h4><i class='fa fa-info'></i> Note:</h4>
						Catat dan simpan Nomor transaksi. Periksa kembali detail pinjaman di bawah ini sebelum print.
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
							<b>Transaction No# $no_pinjam</b><br>
							<b>Member ID:</b> $id_member<br>
						</div>
					</div>
					<div class='row'>
						<div class='col-xs-12 table-responsive'>
							<table class='table table-striped'>
							<thead>
								<tr>
									<th>Jumlah Pinjam</th>
									<th>Tenor</th>
									<th>Bunga Per Tahun</th>
									<th>Total #</th>
									<th>Angsuran</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>$jml_pinjam</td>
									<td>$tenor Bulan</td>
									<td>$bunga_pinjam %</td>
									<td>$total_pinjam</td>
									<td>$angsuran</td>
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
										<th style='width:50%'>Jumlah Pinjam:</th>
										<td>IDR $jml_pinjam</td>
									</tr>
									<tr>
										<th>Administrasi</th>
										<td>IDR $biaya_adm</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class='row'>
						<div class='col-xs-12'>
							<p><b>Keterangan:</b></p>
							<span class='description'>$ket</span>
						</div>
					</div><br />
					<div class='row no-print'>
						<div class='col-xs-12'>
							<a href='./pages/cetak/cetak-pinjam-dana.php?no_pinjam=$no_pinjam' target='_blank' class='btn btn-warning pull-right'><i class='fa fa-print'></i> Print</a>
							<button type='button' onclick=location.href='home-admin.php?page=form-pinjam-dana' class='btn btn-primary pull-right' style='margin-right: 10px'>Back</button>
						</div>
					</div>
				</section>
				<div class='clearfix'></div>";
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>