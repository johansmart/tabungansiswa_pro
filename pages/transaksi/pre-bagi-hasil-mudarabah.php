<section class="content-header">
    <h1>Pre<small>Bagi Hasil Mudarabah</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Bagi Hasil</li>
    </ol>
</section>
<?php
	include "dist/koneksi.php";
	$tampilMud=mysql_query("SELECT * FROM tb_member WHERE mudarabah > 0");
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
			<div class="box box-primary">				
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>NIK</th>
								<th>Nama</th>
								<th>No. Telp</th>
								<th>Simpanan Mudarabah #</th>
								<th>Bagi Hasil</th>
							</tr>
						</thead>
						<tbody>
						<?php
							while($mud=mysql_fetch_array($tampilMud)){
								$mudarabah	=number_format($mud['mudarabah'],2,",",".");
						?>	
							<tr>
								<td><?php echo $mud['id_member'];?></td>
								<td><?php echo $mud['nik'];?></td>
								<td><?php echo $mud['nama'];?></td>
								<td><?php echo $mud['telp'];?></td>
								<td>IDR <?=$mudarabah?></td>
								<td align="center"><a href="home-admin.php?page=form-bagi-hasil-mudarabah&id_member=<?=$mud['id_member'];?>" title="bagi hasil"><i class="fa fa-briefcase"></i></a></td>
							</tr>
						<?php
							}
						?>
						</tbody>
					</table>
				</div>
			</div>
        </div>
	</div>
</section>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>