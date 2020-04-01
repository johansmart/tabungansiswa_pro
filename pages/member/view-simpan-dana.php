<section class="content-header">
    <h1>Transaction<small>Simpan</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-member.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Transaction Simpan</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
			<div class="box box-primary">				
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No. Simpan</th>
								<th>ID Member</th>
								<th>Jumlah Simpan</th>
								<th>Jenis Simpanan</th>
								<th>Tanggal Transaksi</th>
							</tr>
						</thead>
						<tbody>
						<?php
							if (isset($_GET['id_member'])) {
								$id_member = $_GET['id_member'];
							}
							else{
								die ("Error. No ID Selected! ");	
							}
							include "dist/koneksi.php";
							$tampilSimpan=mysql_query("SELECT * FROM tb_simpan WHERE id_member='$id_member' ORDER BY no_simpan");
							while($simpan=mysql_fetch_array($tampilSimpan)){
								$jml_simpan	=number_format($simpan['jml_simpan'],2,",",".");
						?>	
							<tr>
								<td><?php echo $simpan['no_simpan'];?></td>
								<td><?php echo $simpan['id_member'];?></td>
								<td>IDR <?php echo $jml_simpan?></td>
								<td><?php echo $simpan['jenis_simpan'];?></td>
								<td><?php echo $simpan['tgl_transaksi'];?></td>
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