<?php
error_reporting(E_ALL ^ E_DEPRECATED);
	$Open = mysql_connect("localhost","root","");
		if (!$Open){
		die ("Koneksi ke Engine MySQL Gagal !<br>");
		}
	$Koneksi = mysql_select_db("tabungan");
		if (!$Koneksi){
		die ("Koneksi ke Database Gagal !");
		}
?>