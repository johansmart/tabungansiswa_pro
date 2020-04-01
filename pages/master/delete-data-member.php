<section class="content-header">
    <h1>Delete<small>Data Member</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Delete Data Member</li>
    </ol>
</section>
<div class="register-box">
<?php
include "dist/koneksi.php";
if (isset($_GET['id_member'])) {
	$id_member = $_GET['id_member'];
	$query   = "SELECT * FROM tb_member WHERE id_member='$id_member'";
	$hasil   = mysql_query($query);
	$data    = mysql_fetch_array($hasil);
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	
	if (!empty($id_member) && $id_member != "") {
		$delete = "DELETE FROM tb_member WHERE id_member='$id_member'";
		$sqldel = mysql_query ($delete);
		
		$deluser = "DELETE FROM tb_user WHERE id_user='$id_member'";
		$sqluser = mysql_query ($deluser);
		
		$delsimpan = "DELETE FROM tb_simpan WHERE id_member='$id_member'";
		$sqlsimpan = mysql_query ($delsimpan);
		
		$delpinjam = "DELETE FROM tb_pinjam WHERE id_member='$id_member'";
		$sqlpinjam = mysql_query ($delpinjam);
		
		if ($sqldel) {		
			echo "<div class='register-logo'><b>Delete</b> Successful!</div>	
				<div class='register-box-body'>
					<p>Data Member ".$id_member." Berhasil di Hapus</p>
					<div class='row'>
						<div class='col-xs-8'></div>
						<div class='col-xs-4'>
							<button type='button' onclick=location.href='home-admin.php?page=view-data-member' class='btn btn-primary btn-block btn-flat'>Next >></button>
						</div>
					</div>
				</div>";		
		}
		else{
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";	
		}
	}
	mysql_close($Open);
?>
</div>