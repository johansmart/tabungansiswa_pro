<section class="content-header">
    <h1>Transaction<small>Pinjam</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-member.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Transaction Pinjam</li>
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
								<th>No. Pinjam</th>
								<th>ID Member</th>
								<th>Jumlah Pinjam</th>
								<th>Tenor</th>
								<th>Angsuran</th>
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
							$tampilPinjam=mysql_query("SELECT * FROM tb_pinjam WHERE id_member='$id_member' ORDER BY no_pinjam");
							while($pinjam=mysql_fetch_array($tampilPinjam)){
								$jml_pinjam	=number_format($pinjam['jml_pinjam'],2,",",".");
								$angsuran	=number_format($pinjam['angsuran'],2,",",".");
						?>	
							<tr>
								<td><?php echo $pinjam['no_pinjam'];?></td>
								<td><?php echo $pinjam['id_member'];?></td>
								<td>IDR <?php echo $jml_pinjam?></td>
								<td><?php echo $pinjam['tenor'];?> Bulan</td>
								<td>IDR <?php echo $angsuran?></td>
								<td><?php echo $pinjam['tgl_transaksi'];?></td>
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