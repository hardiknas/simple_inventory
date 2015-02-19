<?php
if ($_SESSION['dpLevel']=="0"){
?>
<ul class="nav nav-list">
	<li class="active"><a href="?page=home"><i class="icon-desktop"></i><span class="menu-text">Beranda</span></a></li>
	<div class="sidebar-collapse" id=""></div>
	<li><a href="?page=inv" class="dropdown-toggle"><i class="icon-hdd"></i><span class="menu-text">Data Inventaris</span></a></li>
	<li><a href="?page=pinv" class="dropdown-toggle"><i class="icon-check"></i><span class="menu-text">Penempatan Inventaris</span></a></li>
	<li><a href="?page=repair" class="dropdown-toggle"><i class="icon-cog"></i><span class="menu-text">Perbaikan</span></a></li>
	<div class="sidebar-collapse" id=""></div>
	<li><a href="?page=vinv" class="dropdown-toggle"><i class="icon-search"></i><span class="menu-text">Cari Inventaris</span></a></li>
	<li><a href="?page=rekap" class="dropdown-toggle"><i class="icon-list"></i><span class="menu-text">Rekapitulasi</span></a></li>
	<li><a href="?page=lap" class="dropdown-toggle"><i class="icon-folder-close"></i><span class="menu-text">Laporan</span></a></li>
	<div class="sidebar-collapse" id=""></div>
	<li><a href="?page=mruang" class="dropdown-toggle"><i class="icon-home"></i><span class="menu-text">Data Ruangan</span></a></li>
	<li><a href="?page=mkat" class="dropdown-toggle"><i class="icon-tasks"></i><span class="menu-text">Data Kategori Alat</span></a></li>
	<div class="sidebar-collapse" id=""></div>
	<li><a href="?page=user" class="dropdown-toggle"><i class="icon-user"></i><span class="menu-text">User</span></a></li>
</ul><!--/.nav-list-->
<?php
}else{
?>
<ul class="nav nav-list">
	<li class="active"><a href="?page=home"><i class="icon-desktop"></i><span class="menu-text">Beranda</span></a></li>
	<div class="sidebar-collapse" id=""></div>
	<li><a href="?page=vinv" class="dropdown-toggle"><i class="icon-hdd"></i><span class="menu-text">Data Inventaris</span></a></li>
	<li><a href="?page=vinvr" class="dropdown-toggle"><i class="icon-home"></i><span class="menu-text">Inventaris Per Ruangan</span></a></li>
	<li><a href="?page=rekap" class="dropdown-toggle"><i class="icon-list"></i><span class="menu-text">Rekapitulasi</span></a></li>
	<div class="sidebar-collapse" id=""></div>
	<li><a href="?page=lap" class="dropdown-toggle"><i class="icon-folder-close"></i><span class="menu-text">Laporan</span></a></li>
</ul><!--/.nav-list-->
<?php
}
?>