<section class="content-header">
    <h1>Withdraw<small>Simpanan</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Withdraw Simpanan</li>
    </ol>
</section>
<?php
	if (isset($_GET['id_member'])) {
		$id_member	= $_GET['id_member'];
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
	$no_withdraw	= kdauto ("tb_withdraw","W-");
	$tgl_withdraw		= date ("Y-m-d H:m:s");
	
	if ($_POST['save'] == "save") {
		$jns_withdraw	=$_POST['jns_withdraw'];
		$jml_withdraw	=$_POST['jml_withdraw'];
		
		if (empty($_POST['jns_withdraw']) || empty($_POST['jml_withdraw'])){
			echo "
			<div class='register-box'>
				<div class='register-logo'><b>Oops!</b> Empty Data.</div>
				<div class='box box-primary'>
					<div class='register-box-body'>
						<p>Masukan Jumlah dan Jenis Withdraw. Data tersebut Tidak Boleh Kosong.</p>
						<div class='row'>
							<div class='col-xs-8'></div>
							<div class='col-xs-4'>
								<div class='box-body box-profile'>
									<a class='btn btn-block btn-warning' href='home-admin.php?page=pre-withdraw-simpanan'>Back</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>";
		}
		
		$cek_simpanan	= mysql_query("SELECT * FROM tb_member WHERE id_member='$id_member'");
		$simpanan=mysql_fetch_array($cek_simpanan);
			$pok		=$simpanan['pokok'];
			$pokok		= number_format($simpanan['pokok'],2,',','.');
			$mud		=$simpanan['mudarabah'];
			$mudarabah	= number_format($simpanan['mudarabah'],2,',','.');
			$qur		=$simpanan['qurban'];
			$qurban		= number_format($simpanan['qurban'],2,',','.');
			$umr		=$simpanan['umrah'];
			$umrah		= number_format($simpanan['umrah'],2,',','.');
			$haj		=$simpanan['haji'];
			$haji		= number_format($simpanan['haji'],2,',','.');
			$ija		=$simpanan['ijah'];
			$ijah		= number_format($simpanan['ijah'],2,',','.');
		
		if ($_POST['jns_withdraw'] == "Pokok"){
			if ($pok < $_POST['jml_withdraw']) {
				echo "
				<div class='register-box'>
					<div class='register-logo'><b>Oops!</b> Saldo Deficit.</div>
					<div class='box box-primary'>
						<div class='register-box-body'>
							<p>Jumlah Saldo Tidak Mencukupi untuk Transaksi Withdraw ini. Jumlah saldo = IDR $pokok</p>
							<div class='row'>
								<div class='col-xs-8'></div>
								<div class='col-xs-4'>
									<div class='box-body box-profile'>
										<a class='btn btn-block btn-warning' href='home-admin.php?page=pre-withdraw-simpanan'>Back</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>";
			}
			else {
				$insert_pokok = mysql_query("INSERT INTO tb_withdraw (no_withdraw, id_member, jml_withdraw, jns_withdraw, tgl_withdraw) VALUES ('$no_withdraw', '$id_member', '$jml_withdraw', '$jns_withdraw', '$tgl_withdraw')");
				$update_pokok = mysql_query("UPDATE tb_member SET pokok=pokok - $jml_withdraw WHERE id_member='$id_member'");
				
				if ($insert_pokok) {
					$select_wp	= mysql_query("SELECT * FROM tb_withdraw WHERE no_withdraw='$no_withdraw'");
					$with_p=mysql_fetch_array($select_wp);
						$no		= $with_p['no_withdraw'];
						$id		= $with_p['id_member'];
						$jml	= number_format($with_p['jml_withdraw'],2,',','.');
						$jns	= $with_p['jns_withdraw'];
						$tgl	= $with_p['tgl_withdraw'];
					echo "
					<section class='invoice'>
						<div class='row'>
							<div class='col-xs-12 table-responsive'>
								<p>Withdraw simpanan pokok sebesar <b>IDR $jml</b> telah berhasil</p>
							</div>
						</div>
					</section>
					<section class='invoice'>
						<div class='row'>
							<div class='col-xs-12 table-responsive'>
								<table class='table table-striped'>
								<thead>
									<tr>
										<th>No. Withdraw</th>
										<th>ID</th>
										<th>Jumlah #</th>
										<th>Jenis</th>
										<th>Tanggal</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>$no</td>
										<td>$id</td>
										<td>$jml</td>
										<td>$jns</td>
										<td>$tgl</td>
									</tr>
								</tbody>
								</table>
							</div>
						</div>
						<div class='row no-print'>
							<div class='col-xs-12'>
								<a href='./pages/cetak/cetak-withdraw.php?no_withdraw=$no' target='_blank' class='btn btn-warning pull-right'><i class='fa fa-print'></i> Print</a>
								<button type='button' onclick=location.href='home-admin.php?page=pre-withdraw-simpanan' class='btn btn-primary pull-right' style='margin-right: 10px'>Back</button>
							</div>
						</div>
					</section>
					<div class='clearfix'></div>";
				}
			}
		}
		else if ($_POST['jns_withdraw'] == "Mudarabah"){
			if ($mud < $_POST['jml_withdraw']) {
				echo "
				<div class='register-box'>
					<div class='register-logo'><b>Oops!</b> Saldo Deficit.</div>
					<div class='box box-primary'>
						<div class='register-box-body'>
							<p>Jumlah Saldo Tidak Mencukupi untuk Transaksi Withdraw ini. Jumlah saldo = IDR $mudarabah</p>
							<div class='row'>
								<div class='col-xs-8'></div>
								<div class='col-xs-4'>
									<div class='box-body box-profile'>
										<a class='btn btn-block btn-warning' href='home-admin.php?page=pre-withdraw-simpanan'>Back</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>";
			}
			else {
				$insert_mud = mysql_query("INSERT INTO tb_withdraw (no_withdraw, id_member, jml_withdraw, jns_withdraw, tgl_withdraw) VALUES ('$no_withdraw', '$id_member', '$jml_withdraw', '$jns_withdraw', '$tgl_withdraw')");
				$update_mud = mysql_query("UPDATE tb_member SET mudarabah=mudarabah - $jml_withdraw WHERE id_member='$id_member'");
				
				if ($insert_mud) {
					$select_mud	= mysql_query("SELECT * FROM tb_withdraw WHERE no_withdraw='$no_withdraw'");
					$with_mud=mysql_fetch_array($select_mud);
						$no		= $with_mud['no_withdraw'];
						$id		= $with_mud['id_member'];
						$jml	= number_format($with_mud['jml_withdraw'],2,',','.');
						$jns	= $with_mud['jns_withdraw'];
						$tgl	= $with_mud['tgl_withdraw'];
					echo "
					<section class='invoice'>
						<div class='row'>
							<div class='col-xs-12 table-responsive'>
								<p>Withdraw simpanan Mudarabah sebesar <b>IDR $jml</b> telah berhasil</p>
							</div>
						</div>
					</section>
					<section class='invoice'>
						<div class='row'>
							<div class='col-xs-12 table-responsive'>
								<table class='table table-striped'>
								<thead>
									<tr>
										<th>No. Withdraw</th>
										<th>ID</th>
										<th>Jumlah #</th>
										<th>Jenis</th>
										<th>Tanggal</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>$no</td>
										<td>$id</td>
										<td>$jml</td>
										<td>$jns</td>
										<td>$tgl</td>
									</tr>
								</tbody>
								</table>
							</div>
						</div>
						<div class='row no-print'>
							<div class='col-xs-12'>
								<a href='./pages/cetak/cetak-withdraw.php?no_withdraw=$no' target='_blank' class='btn btn-warning pull-right'><i class='fa fa-print'></i> Print</a>
								<button type='button' onclick=location.href='home-admin.php?page=pre-withdraw-simpanan' class='btn btn-primary pull-right' style='margin-right: 10px'>Back</button>
							</div>
						</div>
					</section>
					<div class='clearfix'></div>";
				}
			}
		}
		else if ($_POST['jns_withdraw'] == "Qurban"){
			if ($qur < $_POST['jml_withdraw']) {
				echo "
				<div class='register-box'>
					<div class='register-logo'><b>Oops!</b> Saldo Deficit.</div>
					<div class='box box-primary'>
						<div class='register-box-body'>
							<p>Jumlah Saldo Tidak Mencukupi untuk Transaksi Withdraw ini. Jumlah saldo = IDR $qurban</p>
							<div class='row'>
								<div class='col-xs-8'></div>
								<div class='col-xs-4'>
									<div class='box-body box-profile'>
										<a class='btn btn-block btn-warning' href='home-admin.php?page=pre-withdraw-simpanan'>Back</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>";
			}
			else {
				$insert_qur = mysql_query("INSERT INTO tb_withdraw (no_withdraw, id_member, jml_withdraw, jns_withdraw, tgl_withdraw) VALUES ('$no_withdraw', '$id_member', '$jml_withdraw', '$jns_withdraw', '$tgl_withdraw')");
				$update_qur = mysql_query("UPDATE tb_member SET qurban=qurban - $jml_withdraw WHERE id_member='$id_member'");
				
				if ($insert_qur) {
					$select_qur	= mysql_query("SELECT * FROM tb_withdraw WHERE no_withdraw='$no_withdraw'");
					$with_qur=mysql_fetch_array($select_qur);
						$no		= $with_qur['no_withdraw'];
						$id		= $with_qur['id_member'];
						$jml	= number_format($with_qur['jml_withdraw'],2,',','.');
						$jns	= $with_qur['jns_withdraw'];
						$tgl	= $with_qur['tgl_withdraw'];
					echo "
					<section class='invoice'>
						<div class='row'>
							<div class='col-xs-12 table-responsive'>
								<p>Withdraw simpanan Qurban sebesar <b>IDR $jml</b> telah berhasil</p>
							</div>
						</div>
					</section>
					<section class='invoice'>
						<div class='row'>
							<div class='col-xs-12 table-responsive'>
								<table class='table table-striped'>
								<thead>
									<tr>
										<th>No. Withdraw</th>
										<th>ID</th>
										<th>Jumlah #</th>
										<th>Jenis</th>
										<th>Tanggal</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>$no</td>
										<td>$id</td>
										<td>$jml</td>
										<td>$jns</td>
										<td>$tgl</td>
									</tr>
								</tbody>
								</table>
							</div>
						</div>
						<div class='row no-print'>
							<div class='col-xs-12'>
								<a href='./pages/cetak/cetak-withdraw.php?no_withdraw=$no' target='_blank' class='btn btn-warning pull-right'><i class='fa fa-print'></i> Print</a>
								<button type='button' onclick=location.href='home-admin.php?page=pre-withdraw-simpanan' class='btn btn-primary pull-right' style='margin-right: 10px'>Back</button>
							</div>
						</div>
					</section>
					<div class='clearfix'></div>";
				}
			}
		}
		else if ($_POST['jns_withdraw'] == "Umrah"){
			if ($umr < $_POST['jml_withdraw']) {
				echo "
				<div class='register-box'>
					<div class='register-logo'><b>Oops!</b> Saldo Deficit.</div>
					<div class='box box-primary'>
						<div class='register-box-body'>
							<p>Jumlah Saldo Tidak Mencukupi untuk Transaksi Withdraw ini. Jumlah saldo = IDR $umrah</p>
							<div class='row'>
								<div class='col-xs-8'></div>
								<div class='col-xs-4'>
									<div class='box-body box-profile'>
										<a class='btn btn-block btn-warning' href='home-admin.php?page=pre-withdraw-simpanan'>Back</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>";
			}
			else {
				$insert_umr = mysql_query("INSERT INTO tb_withdraw (no_withdraw, id_member, jml_withdraw, jns_withdraw, tgl_withdraw) VALUES ('$no_withdraw', '$id_member', '$jml_withdraw', '$jns_withdraw', '$tgl_withdraw')");
				$update_umr = mysql_query("UPDATE tb_member SET umrah=umrah - $jml_withdraw WHERE id_member='$id_member'");
				
				if ($insert_umr) {
					$select_umr	= mysql_query("SELECT * FROM tb_withdraw WHERE no_withdraw='$no_withdraw'");
					$with_umr=mysql_fetch_array($select_umr);
						$no		= $with_umr['no_withdraw'];
						$id		= $with_umr['id_member'];
						$jml	= number_format($with_umr['jml_withdraw'],2,',','.');
						$jns	= $with_umr['jns_withdraw'];
						$tgl	= $with_umr['tgl_withdraw'];
					echo "
					<section class='invoice'>
						<div class='row'>
							<div class='col-xs-12 table-responsive'>
								<p>Withdraw simpanan Umrah sebesar <b>IDR $jml</b> telah berhasil</p>
							</div>
						</div>
					</section>
					<section class='invoice'>
						<div class='row'>
							<div class='col-xs-12 table-responsive'>
								<table class='table table-striped'>
								<thead>
									<tr>
										<th>No. Withdraw</th>
										<th>ID</th>
										<th>Jumlah #</th>
										<th>Jenis</th>
										<th>Tanggal</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>$no</td>
										<td>$id</td>
										<td>$jml</td>
										<td>$jns</td>
										<td>$tgl</td>
									</tr>
								</tbody>
								</table>
							</div>
						</div>
						<div class='row no-print'>
							<div class='col-xs-12'>
								<a href='./pages/cetak/cetak-withdraw.php?no_withdraw=$no' target='_blank' class='btn btn-warning pull-right'><i class='fa fa-print'></i> Print</a>
								<button type='button' onclick=location.href='home-admin.php?page=pre-withdraw-simpanan' class='btn btn-primary pull-right' style='margin-right: 10px'>Back</button>
							</div>
						</div>
					</section>
					<div class='clearfix'></div>";
				}
			}
		}
		else if ($_POST['jns_withdraw'] == "Haji"){
			if ($haj < $_POST['jml_withdraw']) {
				echo "
				<div class='register-box'>
					<div class='register-logo'><b>Oops!</b> Saldo Deficit.</div>
					<div class='box box-primary'>
						<div class='register-box-body'>
							<p>Jumlah Saldo Tidak Mencukupi untuk Transaksi Withdraw ini. Jumlah saldo = IDR $haji</p>
							<div class='row'>
								<div class='col-xs-8'></div>
								<div class='col-xs-4'>
									<div class='box-body box-profile'>
										<a class='btn btn-block btn-warning' href='home-admin.php?page=pre-withdraw-simpanan'>Back</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>";
			}
			else {
				$insert_haj = mysql_query("INSERT INTO tb_withdraw (no_withdraw, id_member, jml_withdraw, jns_withdraw, tgl_withdraw) VALUES ('$no_withdraw', '$id_member', '$jml_withdraw', '$jns_withdraw', '$tgl_withdraw')");
				$update_haj = mysql_query("UPDATE tb_member SET haji=haji - $jml_withdraw WHERE id_member='$id_member'");
				
				if ($insert_haj) {
					$select_haj	= mysql_query("SELECT * FROM tb_withdraw WHERE no_withdraw='$no_withdraw'");
					$with_haj=mysql_fetch_array($select_haj);
						$no		= $with_haj['no_withdraw'];
						$id		= $with_haj['id_member'];
						$jml	= number_format($with_haj['jml_withdraw'],2,',','.');
						$jns	= $with_haj['jns_withdraw'];
						$tgl	= $with_haj['tgl_withdraw'];
					echo "
					<section class='invoice'>
						<div class='row'>
							<div class='col-xs-12 table-responsive'>
								<p>Withdraw simpanan Haji sebesar <b>IDR $jml</b> telah berhasil</p>
							</div>
						</div>
					</section>
					<section class='invoice'>
						<div class='row'>
							<div class='col-xs-12 table-responsive'>
								<table class='table table-striped'>
								<thead>
									<tr>
										<th>No. Withdraw</th>
										<th>ID</th>
										<th>Jumlah #</th>
										<th>Jenis</th>
										<th>Tanggal</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>$no</td>
										<td>$id</td>
										<td>$jml</td>
										<td>$jns</td>
										<td>$tgl</td>
									</tr>
								</tbody>
								</table>
							</div>
						</div>
						<div class='row no-print'>
							<div class='col-xs-12'>
								<a href='./pages/cetak/cetak-withdraw.php?no_withdraw=$no' target='_blank' class='btn btn-warning pull-right'><i class='fa fa-print'></i> Print</a>
								<button type='button' onclick=location.href='home-admin.php?page=pre-withdraw-simpanan' class='btn btn-primary pull-right' style='margin-right: 10px'>Back</button>
							</div>
						</div>
					</section>
					<div class='clearfix'></div>";
				}
			}
		}
		else if ($_POST['jns_withdraw'] == "Ijah"){
			if ($ija < $_POST['jml_withdraw']) {
				echo "
				<div class='register-box'>
					<div class='register-logo'><b>Oops!</b> Saldo Deficit.</div>
					<div class='box box-primary'>
						<div class='register-box-body'>
							<p>Jumlah Saldo Tidak Mencukupi untuk Transaksi Withdraw ini. Jumlah saldo = IDR $ijah</p>
							<div class='row'>
								<div class='col-xs-8'></div>
								<div class='col-xs-4'>
									<div class='box-body box-profile'>
										<a class='btn btn-block btn-warning' href='home-admin.php?page=pre-withdraw-simpanan'>Back</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>";
			}
			else {
				$insert_ija = mysql_query("INSERT INTO tb_withdraw (no_withdraw, id_member, jml_withdraw, jns_withdraw, tgl_withdraw) VALUES ('$no_withdraw', '$id_member', '$jml_withdraw', '$jns_withdraw', '$tgl_withdraw')");
				$update_ija = mysql_query("UPDATE tb_member SET ijah=ijah - $jml_withdraw WHERE id_member='$id_member'");
				
				if ($insert_ija) {
					$select_ija	= mysql_query("SELECT * FROM tb_withdraw WHERE no_withdraw='$no_withdraw'");
					$with_ija=mysql_fetch_array($select_ija);
						$no		= $with_ija['no_withdraw'];
						$id		= $with_ija['id_member'];
						$jml	= number_format($with_ija['jml_withdraw'],2,',','.');
						$jns	= $with_ija['jns_withdraw'];
						$tgl	= $with_ija['tgl_withdraw'];
					echo "
					<section class='invoice'>
						<div class='row'>
							<div class='col-xs-12 table-responsive'>
								<p>Withdraw simpanan Ijah sebesar <b>IDR $jml</b> telah berhasil</p>
							</div>
						</div>
					</section>
					<section class='invoice'>
						<div class='row'>
							<div class='col-xs-12 table-responsive'>
								<table class='table table-striped'>
								<thead>
									<tr>
										<th>No. Withdraw</th>
										<th>ID</th>
										<th>Jumlah #</th>
										<th>Jenis</th>
										<th>Tanggal</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>$no</td>
										<td>$id</td>
										<td>$jml</td>
										<td>$jns</td>
										<td>$tgl</td>
									</tr>
								</tbody>
								</table>
							</div>
						</div>
						<div class='row no-print'>
							<div class='col-xs-12'>
								<a href='./pages/cetak/cetak-withdraw.php?no_withdraw=$no' target='_blank' class='btn btn-warning pull-right'><i class='fa fa-print'></i> Print</a>
								<button type='button' onclick=location.href='home-admin.php?page=pre-withdraw-simpanan' class='btn btn-primary pull-right' style='margin-right: 10px'>Back</button>
							</div>
						</div>
					</section>
					<div class='clearfix'></div>";
				}
			}
		}
	}
	else {
		echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
	}
?>