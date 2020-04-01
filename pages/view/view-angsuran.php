<section class="content-header">
    <h1>Transaction<small>Angsuran</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Transaction Angsuran</li>
    </ol>
</section>
<?php
	if (isset($_POST['search'])){
		$id_member	=$_POST['id_member'];
		
		if (empty($_POST['id_member'])){
			echo "
			<div class='register-box'>
				<div class='register-logo'><b>Oops!</b> Empty ID Member.</div>
				<div class='box box-primary'>
					<div class='register-box-body'>
						<p>Masukan ID Member. ID Member Tidak Boleh Kosong.</p>
						<div class='row'>
							<div class='col-xs-8'></div>
							<div class='col-xs-4'>
								<div class='box-body box-profile'>
									<a class='btn btn-block btn-warning' href='home-admin.php?page=pre-view-angsuran'>Back</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>";
		}
		
		else {
		include "dist/koneksi.php";
		$tampilAng=mysql_query("SELECT * FROM tb_angsuran WHERE id_member='$id_member'");
		
		$searchId=mysql_query("SELECT * FROM tb_angsuran WHERE id_member='$id_member'");
			$search=mysql_fetch_array($searchId);
		
			if (!($search)){
				echo "
				<div class='register-box'>
					<div class='register-logo'><b>Oops!</b> Not Found.</div>
					<div class='box box-primary'>
						<div class='register-box-body'>
							<p>ID Member yang Anda Masukan adalah # <u>$id_member</u>. Data Tidak ditemukan.</p>
							<div class='row'>
								<div class='col-xs-8'></div>
								<div class='col-xs-4'>
									<div class='box-body box-profile'>
										<a class='btn btn-block btn-warning' href='home-admin.php?page=pre-view-angsuran'>Back</a>
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
									<th>No. Angsuran</th>
									<th>No. Pinjam</th>
									<th>ID Member</th>
									<th>Angsuran Ke #</th>
									<th>Jumlah #</th>
									<th>Tanggal Transaksi</th>
									<th>More</th>
								</tr>
							</thead>
							<tbody>";								
									while($angsuran=mysql_fetch_array($tampilAng)){
										$jml_angsuran	=number_format($angsuran['jml_angsur'],2,",",".");
								echo"	
									<tr>
										<td>$angsuran[no_angsuran]</td>
										<td>$angsuran[no_pinjam]</td>
										<td>$angsuran[id_member]</td>
										<td>$angsuran[angsuran_ke]</td>
										<td>IDR $jml_angsuran</td>
										<td>$angsuran[tgl_angsur]</td>
										<td align='center'><a href='./pages/cetak/cetak-angsuran.php?no_angsuran=$angsuran[no_angsuran]' target='_blank' title='print'><i class='fa fa-print'></i></a></td>
									</tr>";
									}
								echo"
								</tbody>
							</table>
						</div>
					</div>
				</section>
				<div class='clearfix'></div>";
			}
		}
}
?>