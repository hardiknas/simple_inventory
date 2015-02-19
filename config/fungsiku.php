<?php
include "koneksi.php";
date_default_timezone_set('Asia/Makassar');

function getData($field,$tabel,$term){
	$dt = mysql_fetch_array(mysql_query("SELECT $field FROM $tabel WHERE $term"));
	return $dt;
}

function getValue($field,$table,$term){
	$z = mysql_fetch_array(mysql_query("SELECT $field FROM $table WHERE $term"));
	return $z[0];
}

function getJumlah($query){
	$z = mysql_num_rows(mysql_query("$query"));
	return $z;
}

function getAktivitas($field,$tabel,$id){
	$z = mysql_num_rows(mysql_query("SELECT $field FROM $tabel WHERE $field='$id'"));
	return $z;
}

function getTahun(){
	$thn_s = date('Y');
	$start = 2005;
	$thn = array();
	for ($x = $start; $x <= $thn_s; $x++){
		array_push($thn, $x);
	}
	return $thn;
}

function getANum($field,$tabel,$term,$jslice){
	$q = mysql_fetch_array(mysql_query("SELECT MAX($field) as x FROM $tabel WHERE $term"));
	$d = $q['x'];
	$not = substr($d, $jslice,3);
	
	if ($not==""){
		$y = "001";
	}else{
		$i = $not;
		$i++;
		if (strlen($i)==1){
			$y="00".$i;
		}elseif (strlen($i)==2){
			$y="0".$i;
		}else{
			$y=$i;
		}
	}
	return $y; 
}
?>