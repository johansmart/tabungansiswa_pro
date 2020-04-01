<section class="content-header">
    <h1>Profile<small>Nasabah</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-member.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Profile</li>
    </ol>
</section>
<?php
	include "dist/koneksi.php";
	$select_member	="SELECT * FROM tb_member WHERE id_member='$_SESSION[id_user]'";
	$tampil	= mysql_query($select_member);
    $hasil	= mysql_fetch_array ($tampil);
		$nik			= stripslashes ($hasil['nik']);
		$nama			= stripslashes ($hasil['nama']);
		$tmp_lahir		= stripslashes ($hasil['tmp_lahir']);
		$tgl_lahir		= stripslashes ($hasil['tgl_lahir']);
		$jk				= stripslashes ($hasil['jk']);
		$gol_darah		= stripslashes ($hasil['gol_darah']);
		$agama			= stripslashes ($hasil['agama']);
		$pekerjaan		= stripslashes ($hasil['pekerjaan']);
		$alamat			= stripslashes ($hasil['alamat']);
		$email			= stripslashes ($hasil['email']);
		$telp			= stripslashes ($hasil['telp']);
		$date_register	= stripslashes ($hasil['date_register']);
		$pokok			= number_format($hasil['pokok'],2,',','.');
		$mudarabah		= number_format($hasil['mudarabah'],2,',','.');
		$qurban			= number_format($hasil['qurban'],2,',','.');
		$umrah			= number_format($hasil['umrah'],2,',','.');
		$haji			= number_format($hasil['haji'],2,',','.');
		$ijah			= number_format($hasil['ijah'],2,',','.');
?>
<section class="content">
    <div class="row">
        <div class="col-md-3">
			<div class="box box-primary">
				<div class="box-body box-profile">
					<img src="dist/img/profile/no-image.jpg" class="profile-user-img img-responsive img-circle" alt="User profile picture"><br />
					<h3 class="profile-username text-center"><?=$nama?></h3>
					<p class="text-muted text-center"><?=$pekerjaan?></p>
					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<i class="fa fa-phone"></i> <a class="pull-right"><?=$telp?></a>
						</li>
						<li class="list-group-item">
							<i class="fa fa-envelope"></i> <a class="pull-right"><?=$email?></a>
						</li>
					</ul>
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Birth Day</h3>
				</div>
				<div class="box-body">
					<strong><i class="fa fa-map-marker margin-r-5"></i></strong>
					<p class="text-muted"><?=$tmp_lahir?>, <?=$tgl_lahir?></p>
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Registered</h3>
				</div>
				<div class="box-body">
					<strong><i class="fa fa-lock margin-r-5"></i></strong>
					<p class="text-muted"><?=$date_register?></p>
				</div>
			</div>
        </div>
        <div class="col-md-9">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
					<li><a href="#simpanan" data-toggle="tab">Saldo</a></li>
				</ul>
				<div class="tab-content">
					<div class="active tab-pane" id="profile">
						<form class="form-horizontal">
						<p align="center">(Perubahan Data Nasabah dilakukan oleh Pihak Bank)</p>
							<div class="form-group">
								<label class="col-sm-3 control-label">NIK</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?=$nik?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Nama</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?=$nama?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Tempat Lahir</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?=$tmp_lahir?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Tanggal Lahir</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?=$tgl_lahir?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Jenis Kelamin</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?=$jk?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Agama</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?=$agama?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Golongan Darah</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?=$gol_darah?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Alamat</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?=$alamat?>" disabled="disabled">
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="simpanan">
						<form class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-3 control-label">Pokok</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="IDR <?=$pokok?>" disabled="disabled">
								</div>
							</div>
							<p align="center">(Saldo = Simpanan-Penarikan)</p>
							<!-- <div class="form-group">
								<label class="col-sm-3 control-label">UAS</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="IDR <?=$ijah?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Prakerin</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="IDR <?=$qurban?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Ujikom</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="IDR <?=$umrah?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">UN</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="IDR <?=$haji?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Tour/Wisata</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="IDR <?=$mudarabah?>" disabled="disabled">
								</div>
							</div> -->
						</form>
					</div>
				</div>
			</div>
        </div>
    </div>
</section>