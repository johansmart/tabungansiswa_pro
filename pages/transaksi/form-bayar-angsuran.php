<section class="content-header">
    <h1>Bayar<small>Angsuran</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Bayar Angsuran</li>
    </ol>
</section>
<?php
	if (isset($_POST['search'])){
		$nomor_pinjam=$_POST['nomor_pinjam'];
		
		if (empty($_POST['nomor_pinjam'])){
			echo "
			<div class='register-box'>
				<div class='register-logo'><b>Oops!</b> Empty No. Pinjam.</div>
				<div class='box box-primary'>
					<div class='register-box-body'>
						<p>Masukan Nomor Pinjam. Nomor Pinjam Tidak Boleh Kosong.</p>
						<div class='row'>
							<div class='col-xs-8'></div>
							<div class='col-xs-4'>
								<div class='box-body box-profile'>
									<a class='btn btn-block btn-warning' href='home-admin.php?page=pre-bayar-angsuran'>Back</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>";
		}
		
		else {
		include "dist/koneksi.php";
		$query=mysql_query("SELECT * FROM tb_pinjam WHERE no_pinjam LIKE '$nomor_pinjam'");
		$search=mysql_fetch_array($query);
			$no_pinjam		= $search['no_pinjam'];
			$id_member		= $search['id_member'];
			$get_angsuran	= $search['angsuran'];
			$angsuran		= number_format($search['angsuran'],2,",",".");
			$sisa_tenor		= $search['sisa_tenor'];
			$status			= $search['status'];
			
		$member=mysql_query("SELECT * FROM tb_member WHERE id_member='$id_member'");
		$hasilM=mysql_fetch_array($member);
			$nik	= $hasilM['nik'];
			$nama	= $hasilM['nama'];
		
		$angsur=mysql_query("SELECT * FROM tb_angsuran WHERE no_pinjam='$no_pinjam'");
		$hasilA=mysql_num_rows($angsur);
			$angsur_ke		= $hasilA + 1;
		
			if (!($search)){
				echo "
				<div class='register-box'>
					<div class='register-logo'><b>Oops!</b> Not Found.</div>
					<div class='box box-primary'>
						<div class='register-box-body'>
							<p>Nomor Pinjam yang Anda Masukan adalah # <u>$nomor_pinjam</u>. Data Tidak ditemukan.</p>
							<div class='row'>
								<div class='col-xs-8'></div>
								<div class='col-xs-4'>
									<div class='box-body box-profile'>
										<a class='btn btn-block btn-warning' href='home-admin.php?page=pre-bayar-angsuran'>Back</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>";
			}
			
			else if ($sisa_tenor =="0"){
				echo "
				<div class='register-box'>
					<div class='register-logo'><b>Oops!</b> Lunas.</div>
					<div class='box box-primary'>
						<div class='register-box-body'>
							<p>Nomor Pinjam yang Anda Masukan adalah # <u>$nomor_pinjam</u>. Pinjaman tersebut telah LUNAS.</p>
							<div class='row'>
								<div class='col-xs-8'></div>
								<div class='col-xs-4'>
									<div class='box-body box-profile'>
										<a class='btn btn-block btn-warning' href='home-admin.php?page=pre-bayar-angsuran'>Back</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>";
			}
			
			else {
			echo"
				<section class='invoice'>
					<form action='home-admin.php?page=bayar-angsuran&no_pinjam=$no_pinjam&id_member=$id_member&angsuran_ke=$angsur_ke&jml_angsur=$get_angsuran' class='form-horizontal' method='POST' enctype='multipart/form-data'>
						<div class='row'>
							<div class='col-xs-12 table-responsive'>
								<table class='table table-striped'>
								<thead>
									<tr>
										<th>No. Pinjam</th>
										<th>NIK</th>
										<th>Nama</th>
										<th>Angsuran #</th>
										<th>Sisa Tenor</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>$no_pinjam</td>
										<td>$nik</td>
										<td>$nama</td>
										<td>IDR $angsuran</td>
										<td>$sisa_tenor</td>
										<td>$status</td>
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
											<th>Angsuran ke</th>
											<th>: $angsur_ke</th>
										</tr>
										<tr>
											<th>Jumlah Bayar</th>
											<th>: IDR $angsuran</th>
										</tr>
										<tr>
											<th>Keterangan</th>
											<td><textarea type='text' name='ket' class='form-control' maxlength='255' placeholder='Keterangan'></textarea></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<hr>
						<div class='row no-print' class='form-group'>
							<div class='col-xs-12'>
								<button name='save' value='save' class='btn btn-warning pull-right'><i class='fa fa-credit-card'></i> Bayar</button>
								<a href='home-admin.php?page=pre-bayar-angsuran' class='btn btn-default pull-right' style='margin-right: 10px'>Cancel</a>
							</div>
						</div>
					</form>
				</section>
				<div class='clearfix'></div>";
			}
		}
}
?>