<section class="content-header">
    <h1>Form<small>Bagi Hasil Mudarabah</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Bagi Hasil Mudarabah</li>
    </ol>
</section>
<?php
	if (isset($_GET['id_member'])) {
		$id_member		= $_GET['id_member'];
	}
	else{
		die ("Error. No Number Selected! ");	
	}
	include "dist/koneksi.php";
	$ambilMud=mysql_query("SELECT * FROM tb_member WHERE id_member='$id_member'");
	$mud=mysql_fetch_array($ambilMud);
		$nik		= $mud['nik'];
		$nama		= $mud['nama'];
		$telp		= $mud['telp'];
		$mudarabah	= number_format($mud['mudarabah'],2,",",".");
		
?>		
<section class="invoice">
	<div class="row">
		<div class="col-xs-12 table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>NIK</th>
						<th>Nama</th>
						<th>No. Telp</th>
						<th>Jumlah Bagi Hasil #</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?=$id_member?></td>
						<td><?=$nik?></td>
						<td><?=$nama?></td>
						<td><?=$telp?></td>
						<td>IDR <?=$mudarabah?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>			
	<div class="row no-print">
		<div class="col-xs-12">
			<a href="home-admin.php?page=bagi-hasil-mudarabah&id_member=<?=$id_member?>&jml_bagihasil=<?=$mud['mudarabah']?>" class="btn btn-warning pull-right"><i class="fa fa-briefcase"></i> Action</a>
			<button type="button" onclick=location.href="home-admin.php?page=pre-bagi-hasil-mudarabah" class="btn btn-default pull-right" style="margin-right: 10px">Cancel</button>
		</div>
	</div>
</section>