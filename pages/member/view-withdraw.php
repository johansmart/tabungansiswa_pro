<section class="content-header">
    <h1>Transaksi<small>Penarikan</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-member.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Transaksi Penarikan</li>
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
								<th>No. Penarikan</th>
								<th>ID Member</th>
								<th>Jumlah Tarik</th>
								<th>Jenis</th>
								<th>Tanggal</th>
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
							$tampilWithdraw=mysql_query("SELECT * FROM tb_withdraw WHERE id_member='$id_member' ORDER BY no_withdraw");
							while($withdraw=mysql_fetch_array($tampilWithdraw)){
								$jml_withdraw	=number_format($withdraw['jml_withdraw'],2,",",".");
						?>	
							<tr>
								<td><?php echo $withdraw['no_withdraw'];?></td>
								<td><?php echo $withdraw['id_member'];?></td>
								<td>IDR <?php echo $jml_withdraw?></td>
								<td><?php echo $withdraw['jns_withdraw'];?></td>
								<td><?php echo $withdraw['tgl_withdraw'];?></td>
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