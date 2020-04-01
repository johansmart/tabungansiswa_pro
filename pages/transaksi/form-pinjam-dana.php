<section class="content-header">
    <h1>Form<small>Pinjam Dana</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Pinjam Dana</li>
    </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<form action="home-admin.php?page=pinjam-dana" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">Member</label>
							<div class="col-sm-6">
								<?php
									include "dist/koneksi.php";
									$data = mysql_query("SELECT * FROM tb_member");        
									echo '<select name="id_member" onchange="changeValue(this.value)" class="form-control">';    
									echo '<option value="">Pilih Member</option>';    
									while ($row = mysql_fetch_array($data)) {    
										echo '<option value="'.$row['id_member'].'">'. $row['nik'].' - '.$row['nama'].'</option>';    
									}    
									echo '</select>';
									?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Jumlah Pinjaman</label>
							<div class="col-sm-6">
								<input type="text" name="jml_pinjam" class="form-control" maxlength="12" placeholder="Jumlah Pinjaman">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Bunga % Per Tahun</label>
							<div class="col-sm-6">
								<input type="text" name="bunga_pinjam" class="form-control" maxlength="5" placeholder="Dalam Persen %">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Tenor</label>
							<div class="col-sm-6">
								<select name="tenor" class="form-control">
									<option value="">Pilih</option>
									<option value="6">6 Bulan</option>
									<option value="12">12 Bulan</option>
									<option value="18">18 Bulan</option>
									<option value="24">24 Bulan</option>
									<option value="36">36 Bulan</option>
									<option value="48">48 Bulan</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Biaya Administrasi</label>
							<div class="col-sm-6">
								<input type="text" name="biaya_adm" class="form-control" maxlength="12" placeholder="Biaya Administrasi">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Keterangan</label>
							<div class="col-sm-6">
								<textarea type="text" name="ket" class="form-control" maxlength="255" placeholder="Keterangan"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-7">
								<button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>