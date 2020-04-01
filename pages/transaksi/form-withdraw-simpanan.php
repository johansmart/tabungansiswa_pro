<section class="content-header">
    <h1>Withdraw<small>Simpanan</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Withdraw Simpanan</li>
    </ol>
</section>
<?php
	if (isset($_POST['search'])){
		$nik	=$_POST['nik_member'];
		
		if (empty($_POST['nik_member'])){
			echo "
			<div class='register-box'>
				<div class='register-logo'><b>Oops!</b> Empty NIK.</div>
				<div class='box box-primary'>
					<div class='register-box-body'>
						<p>Masukan NIK. NIK Member Tidak Boleh Kosong.</p>
						<div class='row'>
							<div class='col-xs-8'></div>
							<div class='col-xs-4'>
								<div class='box-body box-profile'>
									<a class='btn btn-block btn-warning' href='home-admin.php?page=pre-withdraw-simpanan'>Back</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>";
		}
		
		else {
		include "dist/koneksi.php";
		$select_mem=mysql_query("SELECT * FROM tb_member WHERE nik LIKE '$nik'");
		$search=mysql_fetch_array($select_mem);
			$id_member	= $search['id_member'];
			$nama		= $search['nama'];
			$pokok		= number_format($search['pokok'],2,',','.');
			$mudarabah	= number_format($search['mudarabah'],2,',','.');
			$qurban		= number_format($search['qurban'],2,',','.');
			$umrah		= number_format($search['umrah'],2,',','.');
			$haji		= number_format($search['haji'],2,',','.');
			$ijah		= number_format($search['ijah'],2,',','.');

			if (!($search)){
				echo "
				<div class='register-box'>
					<div class='register-logo'><b>Oops!</b> Not Found.</div>
					<div class='box box-primary'>
						<div class='register-box-body'>
							<p>NIK yang Anda Masukan adalah # <u>$nik</u>. Data Tidak ditemukan.</p>
							<div class='row'>
								<div class='col-xs-8'></div>
								<div class='col-xs-4'>
									<div class='box-body box-profile'>
										<a class='btn btn-block btn-warning' href='home-admin.php?page=pre-withdraw-simpanan'>Back</a>
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
					<div class='row'>
						<div class='col-xs-12 table-responsive'>
							<table class='table table-striped'>
							<thead>
								<tr>
									<th>NIK</th>
									<th>Nama</th>
									<th>Pokok</th>
									
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>$nik</td>
									<td>$nama</td>
									<td>$pokok</td>
									
								</tr>
							</tbody>
							</table>
						</div>
					</div>
					<div class='row'>
						<div class='col-xs-6'></div>
						<div class='col-xs-6'>
							<div class='table-responsive'>
								<form action='home-admin.php?page=withdraw-simpanan&id_member=$id_member' class='form-horizontal' method='POST' enctype='multipart/form-data'>
									<table class='table'>
										<tr>
											<th>Pilih Jenis Simpanan</th>
											<td><select name='jns_withdraw' class='form-control'>
													<option value=''>Pilih</option>
													<option value='Pokok'>Pokok</option>
												</select>
											</td>
										</tr>
										<tr>
											<th>Jumlah Withdraw</th>
											<td><input type='text' name='jml_withdraw' class='form-control' maxlength='12' placeholder='IDR'></td>
										</tr>
									</table>
									<div class='input-group-btn'>
										<button type='submit' name='save' value='save' class='btn btn-warning pull-right'><i class='fa fa-credit-card'></i> Withdraw</button>
										<button type='button' onclick=location.href='home-admin.php?page=pre-withdraw-simpanan' class='btn btn-default pull-right' style='margin-right: 10px'>Cancel</button>	
									</div>
								</form>
							</div>
						</div>
					</div>
				</section>
				<div class='clearfix'></div>";
			}
		}
}
?>