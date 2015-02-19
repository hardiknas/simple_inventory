<div class="row-fluid">
<div class="span12">
<div class="page-header">
	<h1>DATA INVENTARIS</h1>
</div>
<?php
$ntgls = date("dmy");
$tgls = date("d-m-Y");
$page = $_GET['page'];
if($_GET['act']=="tambah"){
	$gn = getANum("bKode","barang","1",10);
	$bid = "DP.".$ntgls.".".getANum("bKode","barang","1",10);
	//echo $bid."<br>".$gn;
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Tambah</h2></div>
<div class="widget-body">
<div class="widget-main">
	<!-- FORM -->
	<form method="POST" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="bKode">ID Barang</label>
			<div class="controls">
				<input type="text" class="input-medium" id="bKode" name="bKode" value="<?php echo $bid;?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="bNama">Nama Barang</label>
			<div class="controls">
				<input class="input-xlarge" type="text" id="bNama" name="bNama" value="<?php echo $e['bNama'];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="bMerk">Merk</label>
			<div class="controls">
				<input class="input-xlarge" type="text" id="bMerk" name="bMerk" value="<?php echo $e['bMerk'];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="bSpek">Spesifikasi</label>
			<div class="controls">
				<textarea class="ckeditor" name="bSpek" id="bSpek" rows="8"><?php echo $e['bSpek'];?></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="bKat">Kategori</label>
			<div class="controls">
				<select class="span3" name="bKat" id="bKat" placeholder="Pilih Kategori">
					<?php
						$qsp = mysql_query("SELECT * FROM ms_kategori");
						while ($s=mysql_fetch_array($qsp)) {
							if ($e['bKat']==$s['kId']){
								echo "<option value='$s[kId]' selected>$s[kNama]</option>";
							}else{
								echo "<option value='$s[kId]'>$s[kNama]</option>";
							}
						}
					?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="bAsal">Jenis Barang (Asal)</label>
			<div class="controls">
				<select class="span3" name="bAsal" id="bAsal" placeholder="Pilih Jenis">
					<?php
						$qsp = mysql_query("SELECT * FROM _jpengadaan");
						while ($s=mysql_fetch_array($qsp)) {
							if ($e['bJenis']==$s['jId']){
								echo "<option value='$s[jId]' selected>$s[jNama]</option>";
							}else{
								echo "<option value='$s[jId]'>$s[jNama]</option>";
							}
						}
					?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="bTgl">Tanggal</label>
			<div class="controls">
				<div class="row-fluid input-append">
					<input class="span2 date-picker" id="bTgl" name="bTgl" type="text" data-date-format="yyyy-mm-dd" value="<?php echo $e['bTgl'];?>" required/>
					<span class="add-on"><i class="icon-calendar"></i></span>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="bJlh">Jumlah Barang</label>
			<div class="controls">
				<input class="input-small" type="number" id="bJlh" max="300" min="1" name="bJlh" value="1" required>
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
			
			$bjlh = $_POST['bJlh'];
			$bkode = $_POST['bKode'];
			$jsukses = 0;

			for ($x=1;$x<=$bjlh;$x++){
				$binv = $bkode.".".$x;
				$q = mysql_query("INSERT INTO barang (bKode,bInv,bNama,
																 bMerk,bSpek,bKat,
																 bAsal,bTgl)
	      											VALUES('$bkode','$binv','$_POST[bNama]',
	      													 '$_POST[bMerk]','$_POST[bSpek]','$_POST[bKat]',
	      													 '$_POST[bAsal]','$_POST[bTgl]')");	


				if ($q){
					$jsukses++;
				}
			}

	      
			if ($bjlh==$jsukses){
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM barang WHERE bKode='$_GET[id]' GROUP BY bKode"));
$idx = $e['bKode'];
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Edit</h2></div>
<div class="widget-body">
<div class="widget-main">
	<!-- FORM -->
		<form method="POST" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="bKode">ID Barang</label>
			<div class="controls">
				<input type="text" class="input-medium" id="bKode" name="bKode" value="<?php echo $e[bKode];?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="bNama">Nama Barang</label>
			<div class="controls">
				<input class="input-xlarge" type="text" id="bNama" name="bNama" value="<?php echo $e['bNama'];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="bMerk">Merk</label>
			<div class="controls">
				<input class="input-xlarge" type="text" id="bMerk" name="bMerk" value="<?php echo $e['bMerk'];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="bSpek">Spesifikasi</label>
			<div class="controls">
				<textarea class="ckeditor" name="bSpek" id="bSpek" rows="8"><?php echo $e['bSpek'];?></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="bKat">Kategori</label>
			<div class="controls">
				<select class="span3" name="bKat" id="bKat" placeholder="Pilih Kategori">
					<?php
						$qsp = mysql_query("SELECT * FROM ms_kategori");
						while ($s=mysql_fetch_array($qsp)) {
							if ($e['bKat']==$s['kId']){
								echo "<option value='$s[kId]' selected>$s[kNama]</option>";
							}else{
								echo "<option value='$s[kId]'>$s[kNama]</option>";
							}
						}
					?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="bAsal">Jenis Barang (Asal)</label>
			<div class="controls">
				<select class="span3" name="bAsal" id="bAsal" placeholder="Pilih Jenis">
					<?php
						$qsp = mysql_query("SELECT * FROM _jpengadaan");
						while ($s=mysql_fetch_array($qsp)) {
							if ($e['bJenis']==$s['jId']){
								echo "<option value='$s[jId]' selected>$s[jNama]</option>";
							}else{
								echo "<option value='$s[jId]'>$s[jNama]</option>";
							}
						}
					?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="bTgl">Tanggal</label>
			<div class="controls">
				<div class="row-fluid input-append">
					<input class="span2 date-picker" id="bTgl" name="bTgl" type="text" data-date-format="yyyy-mm-dd" value="<?php echo $e['bTgl'];?>" required/>
					<span class="add-on"><i class="icon-calendar"></i></span>
				</div>
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

			$q = mysql_query("UPDATE barang SET bNama='$_POST[bNama]',bMerk='$_POST[bMerk]',
														  bSpek='$_POST[bSpek]',bKat='$_POST[bKat]',
	      											  bAsal='$_POST[bAsal]',bTgl='$_POST[bTgl]',
														  onUpdate=NOW()
														WHERE bKode='$_POST[bKode]'");		
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
			mysql_query("DELETE FROM barang WHERE bKode='$_GET[id]'");
			echo "<script>
				 		notifsukses('Sukses','Data Telah Dihapus..!!');
				  		setTimeout('window.location.href=\"media.php?page=$page\"', 1000)
				   </script>";
		}
	?>
	<div class="table-header">
	   DATA INVENTARIS
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="40px">No</th>
	    <th class="center" width="100px">ID Barang</th>
	    <th class="center" width="200px">Nama Barang</th>
	    <th class="center">Merk</th>
	    <th class="center" width="120px">Tanggal</th>
	    <th class="center" width="200px">Kategori</th>
	    <th class="center" width="150px">Jenis Barang (Asal)</th>
	    <th class="center" width="80px">Jumlah</th>
	    <th class="center" width="40px">Aksi</th>
	    </tr>
	</thead>
	<tbody>
	 <?php
	   $qry = mysql_query("SELECT *,COUNT(bId) AS bJlh FROM barang GROUP BY bKode");
		while ($d = mysql_fetch_array($qry)){
	      $no++;
	      $kat = getValue("kNama","ms_kategori","kId='$d[bKat]'");
	      $jenis = getValue("jNama","_jpengadaan","jId='$d[bAsal]'");
	      $tgl = getTglIndo($d['bTgl']);
	      echo "
	      <tr>
	      <td class='center'>$no</td>
	      <td class='center'>$d[bKode]</td>
	      <td class='center'>$d[bNama]</td>
	      <td class='center'>$d[bMerk]</td>
	      <td class='center'>$tgl</td>
	      <td class='center'>$kat</td>
	      <td class='center'>$jenis</td>
	      <td class='center'>$d[bJlh]</td>
	      <td class='center'>
		      <div class='inline position-relative'>
              <button class='btn btn-minier btn-primary dropdown-toggle' data-toggle='dropdown'><i class='icon-cog icon-only bigger-110'></i></button>
              <ul class='dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close'>
              		<li>
                  	<a href='?page=dinv&id=$d[bKode]' class='tooltip-success' data-rel='tooltip' data-original-title='Detail Inventaris'>
                     	<span class='orange'><i class='icon-search bigger-120'></i></span>
                     </a>
                  </li>
                  <li>
                  	<a href='?page=$page&act=edit&id=$d[bKode]' class='tooltip-success' data-rel='tooltip' data-original-title='Edit'>
                     	<span class='green'><i class='icon-edit bigger-120'></i></span>
                     </a>
                  </li>
                  <li>
                  	<a href='?page=$page&mode=hapus&id=$d[bKode]' onclick='return qh();' class='tooltip-error' data-rel='tooltip' data-original-title='Delete'>
                     	<span class='red'><i class='icon-trash bigger-120'></i></span>
                     </a>
                  </li>
              </ul>
            </div>
		   </td>";
	      ?>
	     </tr>
	    <?php
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