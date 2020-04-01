<?php
session_start();
if(!isset($_SESSION['id_user'])){
    die("<b>Oops!</b> Access Failed.
		<p>Sistem Logout. Anda harus melakukan Login kembali.</p>
		<button type='button' onclick=location.href='index.php'>Back</button>");
}
if($_SESSION['hak_akses']!="Admin"){
    die("<b>Oops!</b> Access Failed.
		<p>Anda Bukan Admin.</p>
		<button type='button' onclick=location.href='index.php'>Back</button>");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>APPBanking | Tabungan Siswa</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="dist/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="dist/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="dist/css/AdminLTE.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
	<link rel="stylesheet" href="plugins/iCheck/square/blue.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="plugins/morris/morris.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="plugins/datepicker/bootstrap-datetimepicker.min.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
	<script type="text/javascript" src="plugins/datatables/jquery.js"></script>
			
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">
	<header class="main-header">
		<a href="home-admin.php" class="logo"><span class="logo-mini"><b>O</b>SA</span><span class="logo-lg"><b>Bank</b> OSA</span></a>
		<nav class="navbar navbar-static-top" role="navigation">
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"><span class="sr-only">Toggle navigation</span></a>
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src='dist/img/profile/no-image.jpg' class='user-image' alt='User Image'>
							<span class="hidden-xs"><?php echo $_SESSION['nama_user'] ?></span> &nbsp;<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li class="user-header">
								<img src='dist/img/profile/no-image.jpg' class='img-circle' alt='User Image'>
								<p>Welcome - <?php echo $_SESSION['nama_user'] ?><small><?php echo $_SESSION['hak_akses'] ?></small></p>
							</li>
							<li class="user-body">
								<div class="row">
								</div>
							</li>
							<li class="user-footer">
								<div class="pull-left">
									<?php echo date("d-m-Y");?>
								</div>
								<div class="pull-right">
								  <a href="pages/login/act-logout.php" class="btn btn-default btn-flat">Log out</a>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<aside class="main-sidebar">
		<section class="sidebar">
			<ul class="sidebar-menu">
				<li class="header">MAIN NAVIGATION</li>
				<li class="treeview"><a href="home-admin.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
				<li class="treeview"><a href="home-admin.php?page=form-register-member"><i class="fa fa-user"></i> <span>Register Nasabah</span></a></li>
				<li class="treeview"><a href="#"><i class="fa fa-users"></i> <span>Users and Nasabah</span><i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li><a href="home-admin.php?page=view-data-user">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-right"></i> Data User</a></li>
						<li><a href="home-admin.php?page=view-data-member">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-right"></i> Data Nasabah</a></li>
					</ul>
				</li>
				<li class="treeview"><a href="#"><i class="fa fa-tasks"></i> <span>Transaction</span><i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li><a href="home-admin.php?page=form-simpan-dana">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-right"></i> Simpan</a></li>
						<li><a href="home-admin.php?page=pre-withdraw-simpanan">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-right"></i> Penarikan</a></li>
					</ul>
				</li>
					
				</li>
				<li class="treeview"><a href="#"><i class="fa fa-print"></i> <span>Report</span><i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li><a href="home-admin.php?page=pre-view-simpan-dana">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-right"></i> Simpan</a></li>
						<li><a href="home-admin.php?page=pre-view-withdraw">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-right"></i> Penarikan</a></li>
							<ul class="treeview-menu">
								</ul>
						</li>
					</ul>
				</li>
			</ul>
		</section>
	</aside>
	<div class="content-wrapper">
		<section class="content">
			<?php
				$page = (isset($_GET['page']))? $_GET['page'] : "main";
				switch ($page) {
					case 'form-register-member': include "pages/master/form-register-member.php"; break;
					case 'register-member': include "pages/master/register-member.php"; break;
					case 'view-data-user': include "pages/master/view-data-user.php"; break;
					case 'pre-activated-deactivate-user': include "pages/master/pre-activated-deactivate-user.php"; break;
					case 'activated-user': include "pages/master/activated-user.php"; break;
					case 'deactivate-user': include "pages/master/deactivate-user.php"; break;
					case 'view-data-member': include "pages/master/view-data-member.php"; break;
					case 'view-detail-data-member': include "pages/master/view-detail-data-member.php"; break;
					case 'form-edit-data-member': include "pages/master/form-edit-data-member.php"; break;
					case 'edit-data-member': include "pages/master/edit-data-member.php"; break;
					case 'delete-data-member': include "pages/master/delete-data-member.php"; break;
					case 'form-pinjam-dana': include "pages/transaksi/form-pinjam-dana.php"; break;
					case 'pinjam-dana': include "pages/transaksi/pinjam-dana.php"; break;
					case 'cetak-pinjam-dana': include "pages/view/cetak-pinjam-dana.php"; break;
					case 'form-simpan-dana': include "pages/transaksi/form-simpan-dana.php"; break;
					case 'simpan-dana': include "pages/transaksi/simpan-dana.php"; break;
					case 'pre-bayar-angsuran': include "pages/transaksi/pre-bayar-angsuran.php"; break;
					case 'form-bayar-angsuran': include "pages/transaksi/form-bayar-angsuran.php"; break;
					case 'bayar-angsuran': include "pages/transaksi/bayar-angsuran.php"; break;
					case 'pre-withdraw-simpanan': include "pages/transaksi/pre-withdraw-simpanan.php"; break;
					case 'form-withdraw-simpanan': include "pages/transaksi/form-withdraw-simpanan.php"; break;
					case 'withdraw-simpanan': include "pages/transaksi/withdraw-simpanan.php"; break;					
					case 'pre-view-simpan-dana': include "pages/view/pre-view-simpan-dana.php"; break;
					case 'view-simpan-dana': include "pages/view/view-simpan-dana.php"; break;
					case 'pre-view-pinjam-dana': include "pages/view/pre-view-pinjam-dana.php"; break;
					case 'view-pinjam-dana': include "pages/view/view-pinjam-dana.php"; break;
					case 'pre-view-withdraw': include "pages/view/pre-view-withdraw.php"; break;
					case 'view-withdraw': include "pages/view/view-withdraw.php"; break;
					case 'pre-view-angsuran': include "pages/view/pre-view-angsuran.php"; break;
					case 'view-angsuran': include "pages/view/view-angsuran.php"; break;
					case 'pre-view-bagi-hasil-mudarabah': include "pages/view/pre-view-bagi-hasil-mudarabah.php"; break;
					case 'view-bagi-hasil-mudarabah': include "pages/view/view-bagi-hasil-mudarabah.php"; break;
					
					case 'pre-bagi-hasil-mudarabah': include "pages/transaksi/pre-bagi-hasil-mudarabah.php"; break;
					case 'form-bagi-hasil-mudarabah': include "pages/transaksi/form-bagi-hasil-mudarabah.php"; break;
					case 'bagi-hasil-mudarabah': include "pages/transaksi/bagi-hasil-mudarabah.php"; break;
					default : include 'dashboard.php';	
				}
			?>
		</section>
	</div>
	<footer class="main-footer">
		<div class="pull-right hidden-xs"><b>Version</b> 2.0</div>
		Copyright &copy; 2018 <a href="home-admin.php">Tabungan Siswa</a> All rights reserved
	</footer>
</div>
	<!-- ./wrapper -->
	<!-- jQuery 2.1.4 -->
	<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	  $.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.5 -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<!-- Morris.js charts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="plugins/morris/morris.min.js"></script>
	<!-- Sparkline -->
	<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
	<!-- jvectormap -->
	<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="plugins/knob/jquery.knob.js"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<!-- Slimscroll -->
	<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/app.min.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="dist/js/pages/dashboard.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="dist/js/demo.js"></script>
	<!-- DataTables -->
	<script src="plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
</body>
</html>