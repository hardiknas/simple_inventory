<?php
// ALL CONTENT
if ($_GET['page']=='home'){
	include 'home.php';
}elseif($_GET['page']=='profil'){
	include 'profil.php';
}elseif($_GET['page']=='cpass'){
	include 'cpass.php';
// ALL CONTENT

// ADMIN CONTENT & MASTER
}elseif($_GET['page']=='user'){
	include 'mod/user/user.php';
}elseif($_GET['page']=='mkat'){
	include 'mod/master/kategori.php';
}elseif($_GET['page']=='mruang'){
	include 'mod/master/ruangan.php';
}elseif($_GET['page']=='inv'){
	include 'mod/inventaris/inventaris.php';
}elseif($_GET['page']=='dinv'){
	include 'mod/inventaris/dinventaris.php';
}elseif($_GET['page']=='pinv'){
	include 'mod/penempatan/pinventaris.php';
}elseif($_GET['page']=='pdinv'){
	include 'mod/penempatan/pdinventaris.php';
}elseif($_GET['page']=='repair'){
	include 'mod/perbaikan/perbaikan.php';
}elseif($_GET['page']=='vinv'){
	include 'mod/vinventaris/vinventaris.php';
}elseif($_GET['page']=='hrepair'){
	include 'mod/vinventaris/history.php';
}elseif($_GET['page']=='vinvr'){
	include 'mod/vinventarisr/vinventarisr.php';
}elseif($_GET['page']=='vdinvr'){
	include 'mod/vinventarisr/vdinventarisr.php';
}elseif($_GET['page']=='rekap'){
	include 'mod/rekap/rekap.php';
}elseif($_GET['page']=='lap'){
	include 'mod/laporan/laporan.php';
}
// ADMIN CONTENT & MASTER

else{
	include 'error.php';
}
?>