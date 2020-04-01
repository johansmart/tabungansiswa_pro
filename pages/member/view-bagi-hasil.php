<section class="content-header">
    <h1>Transaction<small>Bagi Hasil</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-member.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Transaction Bagi Hasil</li>
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
								<th>No. Transaksi</th>
								<th>ID Member</th>
								<th>Jumlah Bagi Hasil</th>
								<th>Jenis Bagi Hasil</th>
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
							$tampilBag=mysql_query("SELECT * FROM tb_bagihasil WHERE id_member='$id_member'");
							while($bagi=mysql_fetch_array($tampilBag)){
								$jml_bagihasil	=number_format($bagi['jml_bagihasil'],2,",",".");
						?>	
							<tr>
								<td><?php echo $bagi['no_transaksi'];?></td>
								<td><?php echo $bagi['id_member'];?></td>
								<td>IDR <?php echo $jml_bagihasil?></td>
								<td><?php echo $bagi['jns_bagihasil'];?></td>
								<td><?php echo $bagi['tgl_transaksi'];?></td>
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