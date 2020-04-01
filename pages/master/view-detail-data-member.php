<?php
	if (isset($_GET['id_member'])) {
	$id_member = $_GET['id_member'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "dist/koneksi.php";
	$ambilData=mysql_query("SELECT * FROM tb_member WHERE id_member='$id_member'");
	$hasil=mysql_fetch_array($ambilData);
?>
<section class="content-header">
    <h1>Detail<small>Data Member <b>#<?=$id_member?></b></small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Data Member</li>
    </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body">
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-3 control-label">NIK</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" value="<?=$hasil['nik'];?>" disabled="disabled" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Nama</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" value="<?=$hasil['nama'];?>" disabled="disabled" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tempat, Tanggal Lahir</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" value="<?=$hasil['tmp_lahir'];?>" disabled="disabled">
							</div>
							<div class="col-sm-3">
								<input type="text" class="form-control" value="<?=$hasil['tgl_lahir'];?>" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Jenis Kelamin</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" value="<?=$hasil['jk'];?>" disabled="disabled" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Golongan Darah</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" value="<?=$hasil['gol_darah'];?>" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Agama</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" value="<?=$hasil['agama'];?>" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Pekerjaan</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" value="<?=$hasil['pekerjaan'];?>" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Alamat</label>
							<div class="col-sm-7">
								<textarea type="text" class="form-control" disabled="disabled"><?=$hasil['alamat'];?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Email</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" value="<?=$hasil['email'];?>" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">No. Telp</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" value="<?=$hasil['telp'];?>" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Date Register</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" value="<?=$hasil['date_register'];?>" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-1">
								<a class="btn btn-primary btn-block" href="home-admin.php?page=view-data-member">Back</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>