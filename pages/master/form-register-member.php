<section class="content-header">
    <h1>Form<small>Register Nasabah</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Register Nasabah Baru</li>
    </ol>
</section>
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
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
			<div class="box box-primary">				
				<div class="box-body">
					<div class="panel-group">
						<div class="panel panel-default">
							<div class="panel-heading">
								 <h4 class="panel-title"><i class="fa fa-plus"></i> Add Data Nasabah<a data-toggle="collapse" data-target="#formmember" href="#formmember" class="collapsed"></a></h4>
							</div>
							<div id="formmember" class="panel-collapse collapse">
								<div class="panel-body">
									<form action="home-admin.php?page=register-member" class="form-horizontal" method="POST" enctype="multipart/form-data">
										<div class="form-group">
											<label class="col-sm-3 control-label">Rekening</label>
											<div class="col-sm-7">
												<input type="text" name="id_member" id="id_member" class="form-control" value="<?php echo kdauto("tb_member","SMK-"); ?>" disabled="disabled" />
												<input type="hidden" name="id_member" id="id_member" value="<?php echo kdauto("tb_member","SMK-"); ?>" />
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">NIK</label>
											<div class="col-sm-7">
												<input type="text" name="nik" class="form-control" maxlength="16">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Nama Member</label>
											<div class="col-sm-7">
												<input type="text" name="nama" class="form-control" maxlength="64">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Tempat, Tanggal Lahir</label>
											<div class="col-sm-3">
												<input type="text" name="tmp_lahir" class="form-control" maxlength="64">
											</div>
											<div class="input-group date form_date col-sm-3" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
												<input type="text" name="tgl_lahir" class="form-control"><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Jenis Kelamin</label>
											<div class="col-sm-7">
												<select name="jk" class="form-control">
													<option value="">Pilih</option>
													<option value="L">Laki-laki</option>
													<option value="P">Perempuan</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Golongan Darah</label>
											<div class="col-sm-7">
												<select name="gol_darah" class="form-control">
													<option value="">Pilih</option>
													<option value="A">A</option>
													<option value="AB">AB</option>
													<option value="B">B</option>
													<option value="O">O</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Agama</label>
											<div class="col-sm-7">
												<select name="agama" class="form-control">
													<option value="">Pilih</option>
													<option value="Islam">Islam</option>
													<option value="Protestan">Protestan</option>
													<option value="Katolik">Katolik</option>
													<option value="Hindu">Hindu</option>
													<option value="Budha">Budha</option>
													<option value="Kepercayaan">Kepercayaan</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Pekerjaan</label>
											<div class="col-sm-7">
												<input type="text" name="pekerjaan" class="form-control" maxlength="32">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Alamat</label>
											<div class="col-sm-7">
												<textarea type="text" name="alamat" class="form-control"></textarea>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Email</label>
											<div class="col-sm-7">
												<input type="text" name="email" class="form-control" maxlength="64">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">No. Telp</label>
											<div class="col-sm-7">
												<input type="text" name="telp" class="form-control" maxlength="12">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-3 col-sm-7">
												<button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
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