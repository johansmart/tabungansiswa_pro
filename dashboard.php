
<section class="content-header">
   <h1>Tabungan Siswa<small>(Anda Belum Login)</small></h1>
    <ol class="breadcrumb">
		<li><a href="home-admin.php"><i class="fa fa-dashboard"></i>Dashboard</a></li>
</section>

<?php
	include "dist/koneksi.php";
	$piutang=0;
	$hitung_piutang=mysql_query("SELECT jml_pinjam FROM tb_pinjam");
		while($hasil=mysql_fetch_array($hitung_piutang)){
			$piutang	+=$hasil['jml_pinjam'];
			$total_piutang	=number_format($piutang,0,",",".");
		}
	
	$hutang=0;
	$hitung_hutang=mysql_query("SELECT jml_simpan FROM tb_simpan");
		while($hasil=mysql_fetch_array($hitung_hutang)){
			$hutang	+=$hasil['jml_simpan'];
			$total_hutang	=number_format($hutang,0,",",".");
		}
	
	$kredit=0;
	$hitung_kredit=mysql_query("SELECT jml_withdraw FROM tb_withdraw");
		while($hasil=mysql_fetch_array($hitung_kredit)){
			$kredit	+=$hasil['jml_withdraw'];
			$total_kredit	=number_format($kredit,0,",",".");
		}
	
	$select_member=mysql_query("SELECT * FROM tb_member");
	$jmlmember = mysql_num_rows($select_member);
?>
<?php error_reporting(E_ALL ^ E_NOTICE);?>
<section class="content">
    <div class="row">
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-green">
				<div class="inner">
					<h4>Rp. <?=$total_hutang?>,-</h4>
					<p>Total Simpanan</p>
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
					<p>Total Penarikan</p>
				</div>
				<div class="icon">
					<i class="ion ion-card"></i>
				</div>
				<p class="small-box-footer">Penarikan <i class="fa fa-arrow-circle-right"></i></p>
			</div>
        </div>
        <!-- <div class="col-lg-3 col-xs-6">
			<div class="small-box bg-red">
				<div class="inner">
					<h4><?=$jmlmember?></h4>
					<p>Total Member</p>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
				<p class="small-box-footer">Member <i class="fa fa-arrow-circle-right"></i></p>
			</div> -->
			
        </div>

<div class="row">
			<div class="col-md-9">
		<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#profile" data-toggle="tab">Info</a></li>
				</ul>
				<div class="tab-content">
						<form class="form-horizontal">
							<div class="form-group">
								<div class="col-md-9">
									<p class="" align="justify">Tabungan Siswa adalah sebuah Program <b>SMK Plus Al-Maftuh</b> yang di kelola secara Penuh oleh OSIS SMK Plus Al-Maftuh. Kata OSA merupakan singkatan dari <b>(OSIS SMK AL-MAFTUH)</b>. Tujuan dari pembentukan program ini adalah untuk memberikan pembelajaran dan melatih Hidup Hemat pada Siswa dan Siswi SMK Plus Al-Maftuh.</p>
									<p class="" align="justify">Seluruh Nasabah yang melakukan penyimpanan Uang di Tabungan Siswa tidak dikenakan biaya Administrasi Penyimpanan. Sedangkan setiap penarikan Saldo/Uang Simpanan setiap Nasabah dikenakan biaya sebesar 10% (Sepuluh Persen) saja.</p>
									<p class="" align="justify">Batas minimal penyimpanan adalah Rp. 1000,- (Seribu Rupiah) dan maksimalnya adalah Tidak terbatas. Sedangkan, untuk batas minimal penarikan adalah Rp. 10.000,- (Sepuluh Ribu Rupiah) dikurangi 10% (Sepuluh Persen) dan maksimal penarikan perhari adalah Rp. 20.000,- (Dua Puluh Ribu Rupiah) dikurangi 10% (Sepuluh Persen) kecuali Penutupan Rekening diakhir tahun adalah 100% (Seratus Persen) dikurangi (-) 10% (Sepuluh Persen).</p>
									<p class="" align="justify">Segala Ketentuan yang ditulis di halaman ini mungkin bisa berubah tanpa melakukan pemberitahuan dan membuat kesepakatan dengan Nasabah terlebih dahulu. - <b>Kementrian Keuangan dan Ekonomi OSIS</b>
								</div>
							</div
						</form>
					</div>
			</div>
        </div>
		
    </div>
</div>	
	
</section>