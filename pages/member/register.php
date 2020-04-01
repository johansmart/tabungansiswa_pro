<section class="content-header">
    <h1>Register</h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Register</li>
    </ol>
</section>
<div class="register-box">
<?php	
	if ($_POST['reg'] == "reg") {
	$id_member	=$_POST['id_member'];
	$nik		=$_POST['nik'];
	$nama		=$_POST['nama'];
	$tmp_lahir	=$_POST['tmp_lahir'];
	$tgl_lahir	=$_POST['tgl_lahir'];
	$jk			=$_POST['jk'];
	$gol_darah	=$_POST['gol_darah'];
	$agama		=$_POST['agama'];
	$pekerjaan	=$_POST['pekerjaan'];
	$alamat		=$_POST['alamat'];
	$email		=$_POST['email'];
	$telp		=$_POST['telp'];
	$date_register	= date('Y-m-d H:m:s');
	
	include "dist/koneksi.php";
	$ceknik=mysql_num_rows (mysql_query("SELECT nik FROM tb_member WHERE nik='$_POST[nik]'"));
			
		if (empty($_POST['nik']) || empty($_POST['nama']) || empty($_POST['tmp_lahir']) || empty($_POST['tgl_lahir']) || empty($_POST['jk']) || empty($_POST['gol_darah']) || empty($_POST['agama']) || empty($_POST['pekerjaan']) || empty($_POST['alamat']) || empty($_POST['email']) || empty($_POST['telp'])) {
		echo "<div class='register-logo'><b>Oops!</b> Data Tidak Lengkap.</div>
			<div class='box box-primary'>
				<div class='register-box-body'>
					<p>Harap periksa kembali dan pastikan data yang Anda masukan lengkap dan benar</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='index.php?page=form-register' class='btn btn-block btn-warning'>Back</button>
						</div>
					</div>
				</div>
			</div>";
		}
		
		else if($ceknik > 0) {
		echo "<div class='register-logo'><b>Oops!</b> NIK Tidak Terdaftar.</div>
			<div class='box box-primary'>
				<div class='register-box-body'>
					<p>Harap periksa kembali dan pastikan NIK yang Anda masukan adalah benar</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='index.php?page=form-register' class='btn btn-block btn-warning'>Back</button>
						</div>
					</div>
				</div>
			</div>";
		}
		
		else{
		$insert = "INSERT INTO tb_member (id_member, nik, nama, tmp_lahir, tgl_lahir, jk, gol_darah, agama, pekerjaan, alamat, email, telp, date_register) VALUES ('$id_member', '$nik', '$nama', '$tmp_lahir', '$tgl_lahir', '$jk', '$gol_darah', '$agama', '$pekerjaan', '$alamat', '$email', '$telp', '$date_register')";
		$query = mysql_query ($insert);
		
		$insert_user = "INSERT INTO tb_user (id_user, nama_user, password, hak_akses, aktif, date_create) VALUES ('$id_member', '$nama', '123', 'Member', 'N', '$date_register')";
		$query2 = mysql_query ($insert_user);
		
		if($query){
			echo "<div class='register-logo'><b>Register</b> Successful!</div>	
				<div class='register-box-body'>
					<p>Register Member Berhasil.<br />
					<br />ID Anda &nbsp;&nbsp;&nbsp;: $id_member
					<br />Password : 123<br />
					<br />Silahkan hubungi Admin agar Akun Anda segera diaktivasi</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='index.php' class='btn btn-primary btn-block btn-flat'>OK</button>
						</div>
					</div>
				</div>";
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>