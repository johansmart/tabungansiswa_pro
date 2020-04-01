<section class="content-header">
    <h1>Transaction<small>Angsuran</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-member.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Transaction Angsuran</li>
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
								<th>No. Angsuran</th>
								<th>No. Pinjam</th>
								<th>ID Member</th>
								<th>Angsuran Ke #</th>
								<th>Jumlah #</th>
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
							$tampilAngsuran=mysql_query("SELECT * FROM tb_angsuran WHERE id_member='$id_member' ORDER BY no_angsuran");
							while($angsuran=mysql_fetch_array($tampilAngsuran)){
								$jml_angsur	=number_format($angsuran['jml_angsur'],2,",",".");
						?>	
							<tr>
								<td><?php echo $angsuran['no_angsuran'];?></td>
								<td><?php echo $angsuran['no_pinjam'];?></td>
								<td><?php echo $angsuran['id_member'];?></td>
								<td><?php echo $angsuran['angsuran_ke'];?></td>
								<td>IDR <?php echo $jml_angsur?></td>
								<td><?php echo $angsuran['tgl_angsur'];?></td>
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