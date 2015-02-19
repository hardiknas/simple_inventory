<div class="row-fluid">
<div class="span12">
<?php
$page = $_GET['page'];
if($_GET['act']=="tambah"){
	$uid = "DP.U.".getANum("uId","user","1",6);
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Tambah</h2></div>
<div class="widget-body">
<div class="widget-main">
	<!-- FORM -->
	<form method="POST" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="uid">ID</label>
			<div class="controls">
				<input type="text" class="input-medium" id="uid" name="uid" value="<?php echo $uid;?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="nama">Nama</label>
			<div class="controls">
				<input class="input-xlarge" type="text" id="nama" name="nama" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="lvl">Level</label>
			<div class="controls">
				<select class="span2" name="lvl" id="lvl">
					<?php
						$qsp = mysql_query("SELECT * FROM _level ORDER BY lId ASC");
						while ($s=mysql_fetch_array($qsp)) {
							if ($e['uLevel']==$s['lId']){
								echo "<option value='$s[lId]' selected>$s[lLevel]</option>";	
							}else{
								echo "<option value='$s[lId]'>$s[lLevel]</option>";
							}
						}
					?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="telp">Telp</label>
			<div class="controls">
				<div class="input-append">
					<input class="input-medium" type="text" id="telp" name="telp" value="<?php echo $e['uTelp'];?>" required>
					<span class="add-on"><i class="icon-phone"></i></span>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="email">Email</label>
			<div class="controls">
				<div class="input-append">
					<input class="input-xlarge" type="text" id="email" name="email" value="<?php echo $e['uEmail'];?>" required>
					<span class="add-on"><i class="icon-envelope"></i></span>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="username">Username</label>
			<div class="controls">
				<input type="text" class="input-medium" id="username" name="username" value="<?php echo $e['uUname'];?>" onblur="Cariuser(this.value);" required>
				<span class="help-inline" id="notifunama"></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Password</label>
			<div class="controls">
				<input type="password" class="input-medium" id="password" name="password" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="foto">Foto</label>
			<div class="controls">
				<div id="foto">
					<div class="span2" data-rel="tooltip" data-placement="right" data-original-title="Ukuran File Gambar Tidak Boleh Lebih 1MB">
						<input type="file" name="fupload" required> 
					</div>
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
		  	$pass = md5($_POST['password']);

		  	$lokasi_file    = $_FILES['fupload']['tmp_name'];
	  		$tipe_file      = $_FILES['fupload']['type'];
	  		$nama_file      = $_FILES['fupload']['name'];
	  		$acak           = rand(1,99);
	  		$foto = $acak.$nama_file;

			if (!empty($lokasi_file)){
				UploadUser($foto);
				$ft = getValue("uFoto","user","uId='$_POST[uid]'");
				if (!$ft==""){
					unlink("foto_user/$ft");
				}

				$q = mysql_query("INSERT INTO user (uId,uUname,uNama,uLevel,uTelp,
			                                        uEmail,uPass,uFoto)
												 VALUES('$_POST[uid]','$_POST[username]','$_POST[nama]','$_POST[lvl]','$_POST[telp]',
			                                       '$_POST[email]','$pass','$foto')
			                    ");
			}else{
				$q = mysql_query("INSERT INTO user (uId,uUname,uNama,uLevel,uTelp,
			                                        uEmail,uPass)
												 VALUES('$_POST[uid]','$_POST[username]','$_POST[nama]','$_POST[lvl]','$_POST[telp]',
			                                       '$_POST[email]','$pass')
			                    ");
			}

			  	
		  	
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE uId='$_GET[id]'"));
$uid = $e['uId'];
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Edit</h2></div>
<div class="widget-body">
<div class="widget-main">
	<!-- FORM -->
	<form method="POST" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="uid">ID</label>
			<div class="controls">
				<input type="text" class="input-medium" id="uid" name="uid" value="<?php echo $uid;?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="nama">Nama</label>
			<div class="controls">
				<input class="input-xlarge" type="text" id="nama" name="nama" value="<?php echo $e['uNama'];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="lvl">Level</label>
			<div class="controls">
				<select class="span2" name="lvl" id="lvl">
					<?php
						$qsp = mysql_query("SELECT * FROM _level ORDER BY lId ASC");
						while ($s=mysql_fetch_array($qsp)) {
							if ($e['uLevel']==$s['lId']){
								echo "<option value='$s[lId]' selected>$s[lLevel]</option>";	
							}else{
								echo "<option value='$s[lId]'>$s[lLevel]</option>";
							}
						}
					?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="telp">Telp</label>
			<div class="controls">
				<div class="input-append">
					<input class="input-medium" type="text" id="telp" name="telp" value="<?php echo $e['uTelp'];?>" required>
					<span class="add-on"><i class="icon-phone"></i></span>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="email">Email</label>
			<div class="controls">
				<div class="input-append">
					<input class="input-xlarge" type="text" id="email" name="email" value="<?php echo $e['uEmail'];?>" required>
					<span class="add-on"><i class="icon-envelope"></i></span>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="foto">Foto</label>
			<div class="controls">
				<?php
					$ptol = "Anda belum menginput gambar, ukuran file gambar tidak boleh lebih 1MB";
					if (!empty($e['uFoto'])){
						$gbrx ="<div class='span2'>
								<img class='pull-left' src='foto_user/$e[uFoto]' width='80%' margin='5px' data-rel='tooltip' data-placement='right' data-original-title='Foto Sekarang'>
								</div>";
						$ptol = "Abaikan jika gambar tidak diganti, ukuran file gambar tidak boleh lebih 1MB";
					}						
				?>
				<?php echo $gbrx;?>
				<div id="foto">
					<div class="span2" data-rel="tooltip" data-placement="right" data-original-title="<?php echo $ptol;?>">
						<input type="file" name="fupload"> 
					</div>
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
			
		  	$lokasi_file    = $_FILES['fupload']['tmp_name'];
	  		$tipe_file      = $_FILES['fupload']['type'];
	  		$nama_file      = $_FILES['fupload']['name'];
	  		$acak           = rand(1,99);
	  		$foto = $acak.$nama_file;

			if (!empty($lokasi_file)){
				UploadUser($foto);
				$ft = getValue("uFoto","user","uId='$_POST[uid]'");
				if (!$ft==""){
					unlink("foto_user/$ft");
				}

				$q = mysql_query("UPDATE user SET uNama='$_POST[nama]',uLevel='$_POST[lvl]',uTelp='$_POST[telp]',
			                                     uEmail='$_POST[email]',uFoto='$foto',
			                                     onUpdate=NOW()
			                                 WHERE uId='$_POST[uid]'
			                    ");

				if ($_SESSION['dpId']==$_POST['uid']){
					$_SESSION['dpFoto']="foto_user/$foto";
					$_SESSION['dpNama'] = $_POST['nama'];
					$_SESSION['dpLevel'] = $_POST['lvl'];
				}
			}else{
				$q = mysql_query("UPDATE user SET uNama='$_POST[nama]',uLevel='$_POST[lvl]',uTelp='$_POST[telp]',
			                                     uEmail='$_POST[email]',
			                                     onUpdate=NOW()
			                                 WHERE uId='$_POST[uid]'
			                    ");
			}
		  	
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
}elseif($_GET['act']=="cpass"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE uId='$_GET[id]'"));
$uid = $e['uId'];
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Ubah Password</h2></div>
<div class="widget-body">
<div class="widget-main">
	<!-- FORM -->
	<form method="POST" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="uid">ID</label>
			<div class="controls">
				<input type="text" class="input-medium" id="uid" name="uid" value="<?php echo $uid;?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="username">Username</label>
			<div class="controls">
				<input type="text" class="input-medium" id="username" name="username" value="<?php echo $e['uUname'];?>" onblur="Cariuser(this.value);" required>
				<span class="help-inline" id="notifunama"></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Password</label>
			<div class="controls">
				<input type="password" class="input-medium" id="password" name="password" required>
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
			$pass = md5($_POST['password']);
			$q = mysql_query("UPDATE user SET uUname ='$_POST[username]',
				                          uPass ='$pass',
				                          onUpdate=NOW()
				                      WHERE uId = '$_POST[uid]'");
		  	
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
			mysql_query("DELETE FROM user WHERE uUname='$_GET[id]'");
			echo "<script>
				 		notifsukses('Sukses','Data Telah Dihapus..!!');
				  		setTimeout('window.location.href=\"media.php?page=$page\"', 1000)
				   </script>";
		}
	?>
	<div class="table-header">
	    DATA USER
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center">No</th>
	    <th class='center' width="80px">ID</th>
	    <th class='center'>Nama</th>
	    <th class="center">Level</th>
	    <th class="center">Telp</th>
	    <th class="center">Email</th>
	    <th class="center">Username</th>
	    <th class="center" width="40px">Aksi</th>
	    </tr>
	</thead>
	<tbody>
	 <?php
	    $qry = mysql_query("SELECT * FROM user ORDER BY uId ASC");
		while ($d = mysql_fetch_array($qry)){
	      $no++;
	      $ulvl = getValue("lLevel","_level","lId='$d[uLevel]'");
	      echo "
	      <tr>
	      <td class='center'>$no</td>
	      <td class='center'>$d[uId]</td>
	      <td>$d[uNama]</td>
	      <td class='center'>$ulvl</td>
	      <td class='center'>$d[uTelp]</td>
	      <td>$d[uEmail]</td>
	      <td class='center'>$d[uUname]</td>
	      <td class='center'>
            <div class='inline position-relative'>
              <button class='btn btn-minier btn-primary dropdown-toggle' data-toggle='dropdown'><i class='icon-cog icon-only bigger-110'></i></button>
              <ul class='dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close'>
                  <li>
                  	<a href='?page=$page&act=edit&id=$d[uId]' class='tooltip-success' data-rel='tooltip' data-original-title='Edit'>
                     	<span class='green'><i class='icon-edit bigger-120'></i></span>
                     </a>
                  </li>
                   <li>
                  	<a href='?page=$page&act=cpass&id=$d[uId]' class='tooltip-success' data-rel='tooltip' data-original-title='Ubah Password'>
                     	<span class='blue'><i class='icon-lock bigger-120'></i></span>
                     </a>
                  </li>
                  <li>
                  	<a href='?page=$page&mode=hapus&id=$d[uId]' onclick='return qh();' class='tooltip-error' data-rel='tooltip' data-original-title='Delete'>
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

<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript">
function Cariuser(x){
	var uid = document.getElementById("uid");
	var uid = uid.value;
	var url = "cekuser.php?x=" + x + "&uid=" + uid;
	ambilData(url, "notifunama");
}
</script>