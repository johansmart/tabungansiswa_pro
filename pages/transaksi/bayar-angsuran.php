<section class="content-header">
    <h1>Bayar<small>Angsuran</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Bayar Angsuran</li>
    </ol>
</section>
<?php
	if (isset($_GET['no_pinjam']) AND ($_GET['angsuran_ke']) AND ($_GET['id_member']) AND ($_GET['jml_angsur'])) {
		$no_pinjam		= $_GET['no_pinjam'];
		$angsuran_ke	= $_GET['angsuran_ke'];
		$id_member		= $_GET['id_member'];
		$jml_angsur		= $_GET['jml_angsur'];	
	}
	else{
		die ("Error. No Number Selected! ");	
	}
	
	if ($_POST['save'] == "save") {
		$ket			=$_POST['ket'];
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
	$no_angsuran	= kdauto ("tb_angsuran","A-");
	$tgl_angsur		= date ("Y-m-d H:m:s");
	
	$bayar_angsuran = "INSERT INTO tb_angsuran (no_angsuran, no_pinjam, id_member, angsuran_ke, jml_angsur, tgl_angsur, ket) VALUES ('$no_angsuran', '$no_pinjam', '$id_member', '$angsuran_ke', '$jml_angsur', '$tgl_angsur','$ket')";
	$query = mysql_query ($bayar_angsuran);
	$update_tenor = mysql_query("UPDATE tb_pinjam SET sisa_tenor=sisa_tenor - 1 WHERE no_pinjam='$no_pinjam'");
	
	$select_status=mysql_query("SELECT * FROM tb_pinjam WHERE no_pinjam='$no_pinjam'");
	$status=mysql_fetch_array($select_status);
		$id_member	= $status['id_member'];
		$sisa_tenor	= $status['sisa_tenor'];
		$angsuran	= number_format($status['angsuran'],2,",",".");
		if ($sisa_tenor=="0"){
			$update_status = mysql_query("UPDATE tb_pinjam SET status='Lunas' WHERE no_pinjam='$no_pinjam'");
		}
		
	$select_member=mysql_query("SELECT * FROM tb_member WHERE id_member='$id_member'");
	$member=mysql_fetch_array($select_member);
		$nik	= $member['nik'];
		$nama	= $member['nama'];
			
		if($query){
		echo "
			<section class='invoice'>
				<div class='row'>
					<div class='col-xs-12 table-responsive'>
						<p>Pembayaran angsuran ke- <b>$angsuran_ke</b> untuk No. Pinjam <b>$no_pinjam</b> berhasil</p>
					</div>
				</div>
			</section>
			<section class='invoice'>
				<div class='row'>
					<div class='col-xs-12 table-responsive'>
						<table class='table table-striped'>
						<thead>
							<tr>
								<th>No. Pinjam</th>
								<th>NIK</th>
								<th>Nama</th>
								<th>Tanggal</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>$no_pinjam</td>
								<td>$nik</td>
								<td>$nama</td>
								<td>$tgl_angsur</td>
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
									<th>No. Angsuran</th>
									<th>: $no_angsuran</th>
								</tr>
								<tr>
									<th>Angsuran Ke</th>
									<th>: $angsuran_ke</th>
								</tr>
								<tr>
									<th>Jumlah #</th>
									<th>: IDR $angsuran</th>
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
						<a href='./pages/cetak/cetak-angsuran.php?no_angsuran=$no_angsuran' target='_blank' class='btn btn-warning pull-right'><i class='fa fa-print'></i> Print</a>
						<button type='button' onclick=location.href='home-admin.php?page=pre-bayar-angsuran' class='btn btn-primary pull-right' style='margin-right: 10px'>Back</button>
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