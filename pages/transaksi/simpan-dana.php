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
	$no_simpan		= kdauto ("tb_simpan","S-");
	$tgl_transaksi	= date ("Y-m-d H:m:s");
	
	if ($_POST['save'] == "save") {
	$id_member		=$_POST['id_member'];
	$jml_simpan		=$_POST['jml_simpan'];
	$jenis_simpan	=$_POST['jenis_simpan'];
	
		if (empty($_POST['id_member']) || empty($_POST['jml_simpan']) || empty($_POST['jenis_simpan'])) {
		echo "
		<div class='register-box'>
			<div class='register-logo'><b>Oops!</b> Data Tidak Lengkap.</div>
			<div class='box box-primary'>
				<div class='register-box-body'>
					<p>Harap periksa kembali dan pastikan data yang Anda masukan lengkap dan benar.</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-admin.php?page=form-simpan-dana' class='btn btn-block btn-warning'>Back</button>
						</div>
					</div>
				</div>
			</div>
		</div>";
		}
		
		else{
		$insert = "INSERT INTO tb_simpan (no_simpan, id_member, tgl_transaksi, jml_simpan, jenis_simpan) VALUES ('$no_simpan', '$id_member', '$tgl_transaksi', '$jml_simpan', '$jenis_simpan')";
		$query = mysql_query ($insert);
			
			if($_POST['jenis_simpan'] == "Pokok"){
				$updatePok=mysql_query("UPDATE tb_member SET pokok=pokok+$jml_simpan WHERE id_member='$id_member'");
			}
			else if($_POST['jenis_simpan'] == "Mudarabah"){
				$updateMud=mysql_query("UPDATE tb_member SET mudarabah=mudarabah+$jml_simpan WHERE id_member='$id_member'");
			}
			else if($_POST['jenis_simpan'] == "Qurban"){
				$updateQur=mysql_query("UPDATE tb_member SET qurban=qurban+$jml_simpan WHERE id_member='$id_member'");
			}
			else if($_POST['jenis_simpan'] == "Umrah"){
				$updateUmr=mysql_query("UPDATE tb_member SET umrah=umrah+$jml_simpan WHERE id_member='$id_member'");
			}
			else if($_POST['jenis_simpan'] == "Haji"){
				$updateHaj=mysql_query("UPDATE tb_member SET haji=haji+$jml_simpan WHERE id_member='$id_member'");
			}
			else {
				$updateIja=mysql_query("UPDATE tb_member SET ijah=ijah+$jml_simpan WHERE id_member='$id_member'");
			}
		
		if($query){
			$ambildata=mysql_query("SELECT * FROM tb_simpan WHERE no_simpan='$no_simpan'");
			$hasil=mysql_fetch_array ($ambildata);
				$id_member		= $hasil['id_member'];
				$tgl_transaksi	= $hasil['tgl_transaksi'];
				$jml_simpan		= number_format($hasil['jml_simpan'],2,',','.');
				$jns_simpan		= $hasil['jenis_simpan'];
				
			$qry=mysql_query("SELECT * FROM tb_member WHERE id_member='$id_member'");
			$view=mysql_fetch_array ($qry);
				$nik		= $view['nik'];
				$nama		= $view['nama'];
				$email		= $view['email'];
				$telp		= $view['telp'];
			
			echo "
				<section class='content-header'>
					<h1>Transaction No #<small>$no_simpan</small></h1>
					<ol class='breadcrumb'>
						<li><a href='home-admin.php'><i class='fa fa-dashboard'></i>Dashboard</a></li>
						<li class='active'>Print Transaction</li>
					</ol>
				</section>
				<div class='pad margin no-print'>
					<div class='callout callout-info' style='margin-bottom: 0;'>
						<h4><i class='fa fa-info'></i> Note:</h4>
						Catat dan simpan Nomor transaksi. Periksa kembali detail simpanan di bawah ini sebelum print.
					</div>
				</div>
				<section class='invoice'>
					<div class='row'>
						<div class='col-xs-12'>
							<h2 class='page-header'><i class='fa fa-globe'></i> Tabungan Siswa (OSIS SMK Al-Maftuh)<small class='pull-right'>Date Transaksi: $tgl_transaksi</small></h2>
						</div>
					</div>
					<div class='row invoice-info'>
						<div class='col-sm-4 invoice-col'>
							<u>Dari:</u>
							<address>
							<strong>Bank OSIS SMK Al-Maftuh (OSA)</strong><br>
							Alamat : Jl. Caringin Pasir Datar Km. 4<br>
							Phone : 08562050812 <br>
							Email : bankosa@almaftuh.or.id
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
							<b>Transaction No# $no_simpan</b><br>
							<b>Rekening :</b> $id_member<br>
						</div>
					</div>
					<div class='row'>
						<div class='col-xs-12 table-responsive'>
							<table class='table table-striped'>
							<thead>
								<tr>
									<th>Jumlah Simpan</th>
									<th>Jenis Simpan</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>$jml_simpan</td>
									<td>Simpanan $jns_simpan</td>
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
										<th style='width:50%'>Jumlah simpan:</th>
										<td>IDR $jml_simpan</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class='row no-print'>
						<div class='col-xs-12'>
							<a href='./pages/cetak/cetak-simpan-dana.php?no_simpan=$no_simpan' target='_blank' class='btn btn-warning pull-right'><i class='fa fa-print'></i> Print</a>
							<button type='button' onclick=location.href='home-admin.php?page=form-simpan-dana' class='btn btn-primary pull-right' style='margin-right: 10px'>Back</button>
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