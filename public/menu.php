<ul class="nav nav-list">
	<li class="active"><a href="index.php?page=home"><i class="icon-home"></i><span class="menu-text">Halaman Utama</span></a></li>
	<div class="sidebar-collapse" id=""></div>
	<li><a href="index.php?page=rekap" class="dropdown-toggle"><i class="icon-folder-open"></i><span class="menu-text">Inventaris</span></a></li>
	<?php
	if (empty($_SESSION['dpId'])){
		echo "<li><a href='login.php' class='dropdown-toggle'><i class='icon-off'></i><span class='menu-text'>Log In</span></a></li>";
	}else{
		echo "<li><a href='media.php?page=home' class='dropdown-toggle'><i class='icon-external-link'></i><span class='menu-text'>Dashboard</span></a></li>";
	}
	?>	
</ul><!--/.nav-list-->