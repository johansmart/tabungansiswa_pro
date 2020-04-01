<section class="content-header">
    <h1>Bayar<small>Angsuran</small></h1>
    <ol class="breadcrumb">
        <li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Bayar Angsuran</li>
    </ol>
</section>
<section class="invoice">
	<div class="row">
        <div class="col-xs-12 table-responsive">
			<div class="box box-primary">
				<div class="box-header">
					<span class="description" style="margin-right: 310px;float: right;"><strong>Masukan Nomor Pinjam </strong></span>
					<div class="box-tools">
						<form action="home-admin.php?page=form-bayar-angsuran" class="form-horizontal" method="POST" enctype="multipart/form-data">
							<div class="input-group input-group-sm" style="width: 300px;">
								<input type="text" name="nomor_pinjam" class="form-control pull-right" maxlength="12" placeholder="Type Nomor Pinjam Here">
								<div class="input-group-btn">
									<button type="submit" name="search" value="search" class="btn btn-default"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>