<?php
$server = "localhost";
$user = "root";
$password = "a14";
$database = "ow_invendp";

// Connect Ke Mysql
$connect = mysql_connect($server,$user,$password) or die ("Koneksi Mysql Gagal");
mysql_select_db($database,$connect) or die ("Pilih Database Gagal");


/*
AkunFlickr
email : ictfkunhas@yahoo.com
pass : Fklantai3
*/
?>