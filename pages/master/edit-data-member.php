<section class="content-header">
    <h1>Edit<small>Data Member</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Edit Data Member</li>
    </ol>
</section>
<div class="register-box">
<?php
	if (isset($_GET['id_member'])) {
	$id_member = $_GET['id_member'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "dist/koneksi.php";
	$tampilMember	= mysql_query("SELECT * FROM tb_member WHERE id_member='$id_member'");
	$hasil	= mysql_fetch_array ($tampilMember);
				
	if ($_POST['edit'] == "edit") {
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
		
		$update= mysql_query ("UPDATE tb_member SET nik='$nik', nama='$nama', tmp_lahir='$tmp_lahir', tgl_lahir='$tgl_lahir', jk='$jk', gol_darah='$gol_darah', agama='$agama', pekerjaan='$pekerjaan', alamat='$alamat', email='$email', telp='$telp' WHERE id_member='$id_member'");
		$update_user= mysql_query ("UPDATE tb_user SET nama_user='$nama' WHERE id_user='$id_member'");
		if($update){
			echo "<div class='register-logo'><b>Edit</b> Successful!</div>	
				<div class='register-box-body'>
					<p>Edit Data Member ".$id_member." Berhasil</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-admin.php?page=view-data-member' class='btn btn-primary btn-block btn-flat'>Next >></button>
						</div>
					</div>
				</div>";
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
?>
</div>