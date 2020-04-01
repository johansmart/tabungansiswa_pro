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
		$id_member = $hasil['id_member'];
?>
<section class="content-header">
    <h1>Form<small>Edit Data Member <b>#<?=$id_member?></b></small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Edit Data Member</li>
    </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<form action="home-admin.php?page=edit-data-member&id_member=<?=$id_member?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">NIK</label>
							<div class="col-sm-7">
								<input type="text" name="nik" class="form-control" value="<?=$hasil['nik'];?>" maxlength="16">
							</div>
						</div><div class="form-group">
							<label class="col-sm-3 control-label">Nama</label>
							<div class="col-sm-7">
								<input type="text" name="nama" class="form-control" value="<?=$hasil['nama'];?>" maxlength="64">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tempat, Tanggal Lahir</label>
							<div class="col-sm-3">
								<input type="text" name="tmp_lahir" class="form-control" value="<?=$hasil['tmp_lahir'];?>" maxlength="32">
							</div>
							<div class="input-group date form_date col-sm-3" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
								<input type="text" name="tgl_lahir" class="form-control" value="<?=$hasil['tgl_lahir'];?>"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
						</div>
						<div class="form-group has-feedback">
							<label class="col-sm-3 control-label">Jenis Kelamin</label>
							<div class="col-sm-7">
								<select name="jk" class="form-control">
									<option value="L" <?php echo ($hasil['jk']=='L')?"selected":""; ?>>Laki-laki
									<option value="P" <?php echo ($hasil['jk']=='P')?"selected":""; ?>>Perempuan
								</select>
							</div>
						</div>
						<div class="form-group has-feedback">
							<label class="col-sm-3 control-label">Golongan Darah</label>
							<div class="col-sm-7">
								<select name="gol_darah" class="form-control">
									<option value="A" <?php echo ($hasil['gol_darah']=='A')?"selected":""; ?>>A
									<option value="AB" <?php echo ($hasil['gol_darah']=='AB')?"selected":""; ?>>AB
									<option value="B" <?php echo ($hasil['gol_darah']=='B')?"selected":""; ?>>B
									<option value="O" <?php echo ($hasil['gol_darah']=='O')?"selected":""; ?>>O
								</select>
							</div>
						</div>
						<div class="form-group has-feedback">
							<label class="col-sm-3 control-label">Agama</label>
							<div class="col-sm-7">
								<select name="agama" class="form-control">
									<option value="Islam" <?php echo ($hasil['agama']=='Islam')?"selected":""; ?>>Islam
									<option value="Protestan" <?php echo ($hasil['agama']=='Protestan')?"selected":""; ?>>Protestan									
									<option value="Katolik" <?php echo ($hasil['agama']=='Katolik')?"selected":""; ?>>Katolik									
									<option value="Hindu" <?php echo ($hasil['agama']=='Hindu')?"selected":""; ?>>Hindu									
									<option value="Budha" <?php echo ($hasil['agama']=='Budha')?"selected":""; ?>>Budha									
									<option value="Kepercayaan" <?php echo ($hasil['agama']=='Kepercayaan')?"selected":""; ?>>Kepercayaan									
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Pekerjaan</label>
							<div class="col-sm-7">
								<input type="text" name="pekerjaan" class="form-control" value="<?=$hasil['pekerjaan'];?>" maxlength="32">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Alamat</label>
							<div class="col-sm-7">
								<textarea type="text" name="alamat" class="form-control" maxlength="512"><?=$hasil['alamat'];?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Email</label>
							<div class="col-sm-7">
								<input type="text" name="email" class="form-control" value="<?=$hasil['email'];?>" maxlength="12">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">No. Telp</label>
							<div class="col-sm-7">
								<input type="text" name="telp" class="form-control" value="<?=$hasil['telp'];?>" maxlength="12">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-7">
								<button type="submit" name="edit" value="edit" class="btn btn-primary">Edit</button>
								<a class="btn btn-default pull-right" href="home-admin.php?page=view-data-member">Cancel</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<!-- datepicker -->
<script type="text/javascript" src="plugins/datepicker/jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="plugins/datepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="plugins/datepicker/js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript">
	 $('.form_date').datetimepicker({
			language:  'id',
			weekStart: 1,
			todayBtn:  1,
	  autoclose: 1,
	  todayHighlight: 1,
	  startView: 2,
	  minView: 2,
	  forceParse: 0
		});
</script>