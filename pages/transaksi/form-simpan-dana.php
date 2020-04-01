<section class="content-header">
    <h1>Form<small>Simpan Dana</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Simpan Dana</li>
    </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<form action="home-admin.php?page=simpan-dana" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-3 control-label">Nasabah</label>
							<div class="col-sm-6">
								<?php
									include "dist/koneksi.php";
									$data = mysql_query("SELECT * FROM tb_member");        
									echo '<select name="id_member" onchange="changeValue(this.value)" class="form-control">';    
									echo '<option value="">Pilih Nasabah</option>';    
									while ($row = mysql_fetch_array($data)) {    
										echo '<option value="'.$row['id_member'].'">'.$row['nama'].' - '. $row['nik'].'</option>';    
									}    
									echo '</select>';
									?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Jumlah Simpanan</label>
							<div class="col-sm-6">
								<input type="text" name="jml_simpan" class="form-control" maxlength="12" placeholder="Jumlah Simpanan">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Jenis Simpanan</label>
							<div class="col-sm-6">
								<select name="jenis_simpan" class="form-control">
									<option value="">Pilih</option>
									<option value="Pokok">Pokok</option>
								</select>
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