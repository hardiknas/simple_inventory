<?php
if ($_GET['page']=='home'){
	include 'public/home.php';
}elseif($_GET['page']=='rekap'){
	include 'public/rekap.php';
}else{
	include 'public/home.php';
}
?>