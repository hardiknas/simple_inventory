<div class="row-fluid">
<div class="span12">
<?php
$page = $_GET['page'];
if($_GET['act']=="tambah"){
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Tambah</h2></div>
<div class="widget-body">
<div class="widget-main">
	<!-- FORM -->
	<form method="POST" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="rKode">Kode</label>
			<div class="controls">
				<input class="input-medium" type="text" id="rKode" name="rKode" value="<?php echo $e['rKode'];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="rNama">Nama</label>
			<div class="controls">
				<input class="input-xxlarge" type="text" id="rNama" name="rNama" value="<?php echo $e['rNama'];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="rJenis">Jenis</label>
			<div class="controls">
				<select class="span3" name="rJenis" id="rJenis">
					<?php
						$qsp = mysql_query("SELECT * FROM _jruangan ORDER BY jId ASC");
						while ($s=mysql_fetch_array($qsp)) {
							if ($e['rJenis']==$s['jId']){
								echo "<option value='$s[jId]' selected>$s[jNama]</option>";	
							}else{
								echo "<option value='$s[jId]'>$s[jNama]</option>";
							}
						}
					?>
				</select>
			</div>
		</div>
		<div class="form-actions">
			<button class="btn btn-info" type="submit" name="simpan">
				<i class="icon-save bigger-110"></i>Simpan
			</button>
			<a class="btn" href="media.php?page=<?php echo $page;?>">
				<i class="icon-undo bigger-110"></i>Batal
			</a>
		</div>
	</form>
	<!-- FORM -->
	<?php
		if (isset($_POST['simpan'])){
		  	$q = mysql_query("INSERT INTO ms_ruangan (rKode,rNama,rJenis)
		  											VALUES('$_POST[rKode]','$_POST[rNama]','$_POST[rJenis]')
		                    ");
			if ($q){
			echo "<script>
			 		notifsukses('Sukses','Data Telah Tersimpan..!!');
			  		setTimeout('window.location.href=\"media.php?page=$page\"', 1000)
			      </script>";
			}else{
			echo "<script>
			      notiferror('Gagal','Data Gagal Tersimpan, pastikan data yang diinput telah benar ..!!');
			  		setTimeout(function() { history.go(-1); }, 1000);
			      </script>";
			}

		}
	?>
</div>
</div>
</div>	
<?php
}elseif($_GET['act']=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM ms_ruangan WHERE rKode='$_GET[id]'"));
$idx = $e['rKode'];
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Edit</h2></div>
<div class="widget-body">
<div class="widget-main">
	<!-- FORM -->
	<form method="POST" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="rKode">Kode</label>
			<div class="controls">
				<input class="input-medium" type="text" id="rKode" name="nama" value="<?php echo $e['rKode'];?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="rNama">Nama</label>
			<div class="controls">
				<input class="input-xxlarge" type="text" id="rNama" name="rNama" value="<?php echo $e['rNama'];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="rJenis">Jenis</label>
			<div class="controls">
				<select class="span3" name="Jenis" id="lvl">
					<?php
						$qsp = mysql_query("SELECT * FROM _jruangan ORDER BY jId ASC");
						while ($s=mysql_fetch_array($qsp)) {
							if ($e['rJenis']==$s['jId']){
								echo "<option value='$s[jId]' selected>$s[jNama]</option>";	
							}else{
								echo "<option value='$s[jId]'>$s[jNama]</option>";
							}
						}
					?>
				</select>
			</div>
		</div>
		<div class="form-actions">
			<button class="btn btn-info" type="submit" name="simpan">
				<i class="icon-save bigger-110"></i>Simpan
			</button>
			<a class="btn" href="media.php?page=<?php echo $page;?>">
				<i class="icon-undo bigger-110"></i>Batal
			</a>
		</div>
	</form>
	<!-- FORM -->
	<?php
		if (isset($_POST['simpan'])){
			
			$q = mysql_query("UPDATE ms_ruangan SET rNama ='$_POST[rNama]',
																 rJenis ='$_POST[rJenis]',
																 onUpdate=NOW()
			                      					WHERE rKode = '$_POST[rKode]'");
			
		  	
			if ($q){
			echo "<script>
			 		notifsukses('Sukses','Data Telah Tersimpan..!!');
			  		setTimeout('window.location.href=\"media.php?page=$page\"', 1000)
			      </script>";
			}else{
			echo "<script>
			      notiferror('Gagal','Data Gagal Tersimpan, pastikan data yang diinput telah benar ..!!');
			  		setTimeout(function() { history.go(-1); }, 1000);
			      </script>";
			}
		}
	?>
</div>
</div>
</div>	
<?php
}else{
?>
	<a href="?page=<?php echo $page;?>&act=tambah" class="btn btn-primary">
		<i class="icon-download-alt bigger-100"></i>Tambah
	</a><br><br>
	<?php
		if ($_GET['mode']=="hapus"){
			mysql_query("DELETE FROM ms_ruangan WHERE rKode='$_GET[id]'");
			echo "<script>
				 		notifsukses('Sukses','Data Telah Dihapus..!!');
				  		setTimeout('window.location.href=\"media.php?page=$page\"', 1000)
				   </script>";
		}
	?>
	<div class="table-header">
	   DATA RUANGAN
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="40px">No</th>
	    <th class="center" width="100px">Kode</th>
	    <th class="center">Nama Ruangan</th>
	    <th class="center">Jenis Ruangan</th>
	    <th class="center" width="40px">Aksi</th>
	    </tr>
	</thead>
	<tbody>
	 <?php
	    $qry = mysql_query("SELECT * FROM ms_ruangan");
		while ($d = mysql_fetch_array($qry)){
	      $no++;
	      $jr = getValue("jNama","_jruangan","jId='$d[rJenis]'");
	      echo "
	      <tr>
	      <td class='center'>$no</td>
	      <td class='center'>$d[rKode]</td>
	      <td class='left'>$d[rNama]</td>
	      <td class='center'>$jr</td>
	      <td class='center'>
            <div class='inline position-relative'>
              <button class='btn btn-minier btn-primary dropdown-toggle' data-toggle='dropdown'><i class='icon-cog icon-only bigger-110'></i></button>
              <ul class='dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close'>
                  <li>
                  	<a href='?page=$page&act=edit&id=$d[rKode]' class='tooltip-success' data-rel='tooltip' data-original-title='Edit'>
                     	<span class='green'><i class='icon-edit bigger-120'></i></span>
                     </a>
                  </li>
                  <li>
                  	<a href='?page=$page&mode=hapus&id=$d[rKode]' onclick='return qh();' class='tooltip-error' data-rel='tooltip' data-original-title='Delete'>
                     	<span class='red'><i class='icon-trash bigger-120'></i></span>
                     </a>
                  </li>
              </ul>
            </div>
	      </td>
	      </tr>";
	      }
	    ?>
	</tbody>
	</table>
	</div>
<?php
}
?>
</div>
</div>