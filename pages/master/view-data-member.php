<section class="content-header">
    <h1>View<small>Data Member</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Data Member</li>
    </ol>
</section>
<?php
	include "dist/koneksi.php";
	$tampilMem=mysql_query("SELECT * FROM tb_member");
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
			<div class="box box-primary">				
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>NIK</th>
								<th>Nama</th>
								<th>Tempat Tangga Lahir</th>
								<th>Pekerjaan</th>
								<th>Saldo</th>
								<th>No. Telp #</th>
								<th>More</th>
							</tr>
						</thead>
						<tbody>
						<?php
							while($member=mysql_fetch_array($tampilMem)){
						?>	
							<tr>
								<td><?php echo $member['nik'];?></td>
								<td><?php echo $member['nama'];?></td>
								<td><?php echo $member['tmp_lahir'];?>, <?php echo $member['tgl_lahir'];?></td>
								<td><?php echo $member['pekerjaan'];?></td>
								<td><?php echo $member['pokok'];?></td>
								<td><?php echo $member['telp'];?></td>
								<td align="center"><a href="home-admin.php?page=view-detail-data-member&id_member=<?=$member['id_member'];?>" title="detail"><i class="fa  fa-folder-open-o"></i></a>&nbsp;&nbsp;&nbsp;<a href="home-admin.php?page=form-edit-data-member&id_member=<?=$member['id_member'];?>" title="edit"><i class="fa  fa-edit"></i></a>&nbsp;&nbsp;&nbsp;<a href="home-admin.php?page=delete-data-member&id_member=<?=$member['id_member'];?>" title="delete"><i class="fa  fa-trash-o"></i></a></td>
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