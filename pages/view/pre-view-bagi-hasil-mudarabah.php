<section class="content-header">
    <h1>Pre<small>View Bagi Hasil Mudarabah</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">View Bagi Hasil Mudarabah</li>
    </ol>
</section>
<section class="invoice">
	<div class="row">
        <div class="col-xs-12 table-responsive">
			<div class="box box-primary">
				<div class="box-header">
					<span class="description" style="float: left;"><a href='./pages/cetak/cetak-bagi-hasil-mudarabah-all.php' target='_blank' class='btn btn-warning pull-right'><i class='fa fa-print'></i> Print All</a></span>
					<span class="description" style="margin-right: 310px;float: right;"><strong><u>Atau</u> Masukan ID Member </strong></span>
					<div class="box-tools">
						<form action="home-admin.php?page=view-bagi-hasil-mudarabah" class="form-horizontal" method="POST" enctype="multipart/form-data">
							<div class="input-group input-group-sm" style="width: 300px;">
								<input type="text" name="id_member" class="form-control pull-right" maxlength="8" placeholder="Type ID Member Here">
								<div class="input-group-btn">
									<button type="submit" name="search" value="search" class="btn btn-default"><i class="fa fa-search"></i></button>&nbsp;
								</div>	
							</div>							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>