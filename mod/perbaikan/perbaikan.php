<div class="row-fluid">
<div class="span12">
<div class="page-header">
	<h1>DATA PERBAIKAN</h1>
</div>
<?php
$ntgls = date("dmy");
$tgls = date("d-m-Y");
$page = $_GET['page'];
if($_GET['act']=="tambah"){
	$gn = getANum("pTiket","perbaikan","1",9);
	$tid = "P.".$ntgls.".".getANum("pTiket","perbaikan","1",9);
	//echo $tid."<br>".$gn;
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Tambah</h2></div>
<div class="widget-body">
<div class="widget-main">
	<!-- FORM -->
	<form method="POST" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="pTiket">ID Tiket</label>
			<div class="controls">
				<input type="text" class="input-medium" id="pTiket" name="pTiket" value="<?php echo $tid;?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="pTgl">Tanggal</label>
			<div class="controls">
				<div class="row-fluid input-append">
					<input class="span2 date-picker" id="pTgl" name="pTgl" type="text" data-date-format="yyyy-mm-dd" value="<?php echo $e['pTgl'];?>" required/>
					<span class="add-on"><i class="icon-calendar"></i></span>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="pInv">Inventaris</label>
			<div class="controls">
				<select class="span4 chosen-select" name="pInv" id="pInv" placeholder="Pilih Inventaris">
					<?php
						$qsp = mysql_query("SELECT * FROM barang WHERE bKondisi='1'");
						while ($s=mysql_fetch_array($qsp)) {
							if ($e['pInv']==$s['bInv']){
								echo "<option value='$s[bInv]' selected>$s[bInv] : $s[bNama]</option>";
							}else{
								echo "<option value='$s[bInv]'>$s[bInv] : $s[bNama]</option>";
							}
						}
					?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="pPJ">Penanggung Jawab</label>
			<div class="controls">
				<input class="input-xlarge" type="text" id="pPJ" name="pPJ" value="<?php echo $e['pPJ'];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="pKerusakan">Kerusakan</label>
			<div class="controls">
				<textarea class="ckeditor" name="pKerusakan" id="pKerusakan" rows="8"><?php echo $e['pKerusakan'];?></textarea>
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
			
			$q1 = mysql_query("INSERT INTO perbaikan (pTiket,pInv,pTgl,
																 pKerusakan,pPJ)
	      											VALUES('$_POST[pTiket]','$_POST[pInv]','$_POST[pTgl]',
	      													 '$_POST[pKerusakan]','$_POST[pPJ]')");	

			if ($q1){
				$q2 = mysql_query("UPDATE barang SET bKondisi='0' WHERE bInv='$_POST[pInv]'");
			}

	      
			if ($q2){
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM perbaikan WHERE pTiket='$_GET[id]'"));
$tid = $e['pTiket'];
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Edit</h2></div>
<div class="widget-body">
<div class="widget-main">
	<!-- FORM -->
	<form method="POST" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="pTiket">ID Tiket</label>
			<div class="controls">
				<input type="text" class="input-medium" id="pTiket" name="pTiket" value="<?php echo $tid;?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="pTgl">Tanggal</label>
			<div class="controls">
				<div class="row-fluid input-append">
					<input class="span2 date-picker" id="pTgl" name="pTgl" type="text" data-date-format="yyyy-mm-dd" value="<?php echo $e['pTgl'];?>" required/>
					<span class="add-on"><i class="icon-calendar"></i></span>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="pInv">Inventaris</label>
			<div class="controls">
				<select class="span4 chosen-select" name="pInv" id="pInv" placeholder="Pilih Inventaris" disabled>
					<?php
						$qsp = mysql_query("SELECT * FROM barang");
						while ($s=mysql_fetch_array($qsp)) {
							if ($e['pInv']==$s['bInv']){
								echo "<option value='$s[bInv]' selected>$s[bInv] : $s[bNama]</option>";
							}else{
								echo "<option value='$s[bInv]'>$s[bInv] : $s[bNama]</option>";
							}
						}
					?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="pPJ">Penanggung Jawab</label>
			<div class="controls">
				<input class="input-xlarge" type="text" id="pPJ" name="pPJ" value="<?php echo $e['pPJ'];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="pKerusakan">Kerusakan</label>
			<div class="controls">
				<textarea class="ckeditor" name="pKerusakan" id="pKerusakan" rows="8"><?php echo $e['pKerusakan'];?></textarea>
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
			
			$q = mysql_query("UPDATE perbaikan SET pTgl='$_POST[pTgl]',
	      												pKerusakan='$_POST[pKerusakan]',
	      												pPJ='$_POST[pPJ]',
	      												onUpdate=NOW()
	      											WHERE pTiket='$_POST[pTiket]'");	
	      
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
}elseif($_GET['act']=="selesai"){
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.pTglS,b.pKondisi,b.pKet FROM perbaikan a LEFT JOIN sperbaikan b ON a.pTiket=b.pTiket WHERE a.pTiket='$_GET[id]'"));
$tid = $e['pTiket'];
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Selesai</h2></div>
<div class="widget-body">
<div class="widget-main">
	<!-- FORM -->
	<form method="POST" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="pTiket">ID Tiket</label>
			<div class="controls">
				<input type="text" class="input-medium" id="pTiket" name="pTiket" value="<?php echo $tid;?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="pTgl">Tanggal Perbaikan</label>
			<div class="controls">
				<div class="row-fluid input-append">
					<input class="span2 date-picker" id="pTgl" name="pTgl" type="text" data-date-format="yyyy-mm-dd" value="<?php echo $e['pTgl'];?>" disabled required/>
					<span class="add-on"><i class="icon-calendar"></i></span>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="pInv">Inventaris</label>
			<div class="controls">
				<select class="span4 chosen-select" name="pInv" id="pInv" placeholder="Pilih Inventaris" disabled>
					<?php
						$qsp = mysql_query("SELECT * FROM barang");
						while ($s=mysql_fetch_array($qsp)) {
							if ($e['pInv']==$s['bInv']){
								echo "<option value='$s[bInv]' selected>$s[bInv] : $s[bNama]</option>";
							}else{
								echo "<option value='$s[bInv]'>$s[bInv] : $s[bNama]</option>";
							}
						}
					?>
				</select>
				<input type="hidden" id="pInv" name="pInv" value="<?php echo $e[pInv];?>" >
			</div>
		</div>
		<hr>
		<h5 class="blue">Kondisi Setelah Perbaiakan</h5>
		<hr>
		<div class="control-group">
			<label class="control-label" for="pTglS">Tanggal Selesai</label>
			<div class="controls">
				<div class="row-fluid input-append">
					<input class="span2 date-picker" id="pTglS" name="pTglS" type="text" data-date-format="yyyy-mm-dd" value="<?php echo $e['pTglS'];?>" required/>
					<span class="add-on"><i class="icon-calendar"></i></span>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="pKondisi">Kondisi</label>
			<div class="controls"> 
				<?php
				$arKon = array('0'=>'Rusak','1'=>'Baik');
				foreach ($arKon as $k => $v) {
					if ($k==$e['pKondisi']){
						echo "<input name='pKondisi' type='radio' class='ace' value='$k' checked/><span class='lbl'> $v </span><br>";
					}else{
						echo "<input name='pKondisi' type='radio' class='ace' value='$k' /><span class='lbl'> $v </span><br>";
					}
				}
				?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="pKet">Ket</label>
			<div class="controls">
				<textarea class="ckeditor" name="pKet" id="pKet" rows="8"><?php echo $e['pKet'];?></textarea>
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
			
			$qta = "INSERT INTO sperbaikan (pTiket,pTglS,
													  pKondisi,pKet)
										   VALUES ('$_POST[pTiket]','$_POST[pTglS]',
													  '$_POST[pKondisi]','$_POST[pKet]')
						ON DUPLICATE KEY UPDATE pTglS='$_POST[pTglS]',
													  pKondisi='$_POST[pKondisi]',pKet='$_POST[pKet]'";
			$q1 = mysql_query($qta);

			if ($q1){
				$q3 = mysql_query("UPDATE perbaikan SET pProses='0' WHERE pTiket='$_POST[pTiket]'");
				$q2 = mysql_query("UPDATE barang SET bKondisi='$_POST[pKondisi]' WHERE bInv='$_POST[pInv]'");
			}

	      
			if ($q2&&$q3){
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
			$invx = getValue("pInv","perbaikan","pTiket='$_GET[id]'");
			mysql_query("UPDATE barang SET bKondisi='1' WHERE bInv='$invx'");
			mysql_query("DELETE FROM perbaikan WHERE pTiket='$_GET[id]'");
			echo "<script>
				 		notifsukses('Sukses','Data Telah Dihapus..!!');
				  		setTimeout('window.location.href=\"media.php?page=$page\"', 1000)
				   </script>";
		}
	?>
	<div class="table-header">
	   DATA PERBAIKAN
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="40px">No</th>
	    <th class="center" width="120px">ID Tiket</th>
	    <th class="center" width="300px">Inventaris</th>
	    <th class="center" width="150px">Status</th>
	    <th class="center">Kerusakan</th>
	    <th class="center">Pasca Perbaikan</th>
	    <th class="center" width="40px">Aksi</th>
	    </tr>
	</thead>
	<tbody>
	 <?php
	   $qry = mysql_query("SELECT a.*,b.pTglS,b.pKondisi,b.pKet FROM perbaikan a LEFT JOIN sperbaikan b ON a.pTiket=b.pTiket");
		while ($d = mysql_fetch_array($qry)){
	      $no++;
	      $inama = getValue("bNama","barang","bInv='$d[pInv]'");
	      $tglp = getTglIndo($d['pTgl']);
      	$tgls = getTglIndo($d['pTglS']);
      	$status = ($d['pProses']=="1" ? "<span class='badge badge-warning'>Proses</span>" : "<span class='badge badge-success'>Selesai</span>");
      	$kondisi = ($d['pKondisi']=="1" ? "<span class='badge badge-success'>Baik</span>" : "<span class='badge badge-important'>Rusak</span>");
      	$pasca = "";
      	if (!empty($d['pTglS'])){
      		$pasca = "<b>Tanggal : </b> $tgls<br>
					       <b>Kondisi : </b> $kondisi<br>
				   	    $d[pKet]<br>";
      	}
	      echo "
	      <tr>
	      <td class='center'>$no</td>
	      <td class='center'>$d[pTiket]</td>
	      <td class='left'>
	      	$d[pInv] - $inama
	      </td>
	      <td class='center'>$status</td>
	      <td class='left'>
	      	<b>Tanggal : </b> $tglp<br>
	      	<b>Penanggung Jawab : </b> $tglp<br>
      		$d[pKerusakan]<br>
      	</td>
      	<td class='left'>
	      	$pasca
      	</td>
	      <td class='center'>
		      <div class='inline position-relative'>
              <button class='btn btn-minier btn-primary dropdown-toggle' data-toggle='dropdown'><i class='icon-cog icon-only bigger-110'></i></button>
              <ul class='dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close'>
              		<li>
                  	<a href='?page=$page&act=selesai&id=$d[pTiket]' class='tooltip-success' data-rel='tooltip' data-original-title='Selesai Perbaikan'>
                     	<span class='orange'><i class='icon-check bigger-120'></i></span>
                     </a>
                  </li>
                  <li>
                  	<a href='?page=$page&act=edit&id=$d[pTiket]' class='tooltip-success' data-rel='tooltip' data-original-title='Edit'>
                     	<span class='green'><i class='icon-edit bigger-120'></i></span>
                     </a>
                  </li>
                  <li>
                  	<a href='?page=$page&mode=hapus&id=$d[pTiket]' onclick='return qh();' class='tooltip-error' data-rel='tooltip' data-original-title='Delete'>
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