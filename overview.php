<section class="content-header">
   <h1>Tabungan Siswa<small>Overview</small></h1>
    <ol class="breadcrumb">
		<li><a href="home-member.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    </ol>
</section>
<?php
	include "dist/koneksi.php";
	$hutang=0;
	$hitung_hutang=mysql_query("SELECT jml_pinjam FROM tb_pinjam WHERE id_member='$_SESSION[id_user]'");
		while($hasil=mysql_fetch_array($hitung_hutang)){
			$hutang	+=$hasil['jml_pinjam'];
			$total_hutang	=number_format($hutang,0,",",".");
		}
	
	$piutang=0;
	$hitung_piutang=mysql_query("SELECT jml_simpan FROM tb_simpan WHERE id_member='$_SESSION[id_user]'");
		while($hasil=mysql_fetch_array($hitung_piutang)){
			$piutang	+=$hasil['jml_simpan'];
			$total_piutang	=number_format($piutang,0,",",".");
		}
	
	$kredit=0;
	$hitung_kredit=mysql_query("SELECT jml_withdraw FROM tb_withdraw WHERE id_member='$_SESSION[id_user]'");
		while($hasil=mysql_fetch_array($hitung_kredit)){
			$kredit	+=$hasil['jml_withdraw'];
			$total_kredit	=number_format($kredit,0,",",".");
		}
	
	$debit=0;
	$hitung_debit=mysql_query("SELECT jml_angsur FROM tb_angsuran WHERE id_member='$_SESSION[id_user]'");
		while($hasil=mysql_fetch_array($hitung_debit)){
			$debit	+=$hasil['jml_angsur'];
			$total_debit	=number_format($debit,0,",",".");
		}
?>
<?php error_reporting(E_ALL ^ E_NOTICE);?>
<section class="content">
<h4 align="center">Perubahan Data Simpanan dan Penarikan  mungkin membutuhkan waktu<br>(1 x 24 Jam)</h4><br>
    <div class="row">
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-green">
				<div class="inner">
					<h4>Rp. <?=$total_piutang?>.-</h4>
					<p>Simpanan (Bukan Saldo)</p>
				</div>
				<div class="icon">
					<i class="ion ion-android-book"></i>
				</div>
				<p class="small-box-footer">Simpanan <i class="fa fa-arrow-circle-right"></i></p>
			</div>
        </div>
        <div class="col-lg-3 col-xs-6">
			<div class="small-box bg-yellow">
				<div class="inner">
					<h4>Rp. <?=$total_kredit?>,-</h4>
					<p>Penarikan</p>
				</div>
				<div class="icon">
					<i class="ion ion-card"></i>
				</div>
				<p class="small-box-footer">Penarikan <i class="fa fa-arrow-circle-right"></i></p>
			</div>
    </div>
</section>
    <center>
    			    				<div class="">
									<?php echo date("d-m-Y");?> (Tercatat)
								</div></center><br>