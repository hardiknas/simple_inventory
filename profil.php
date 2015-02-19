<?php
	$page = "home";
	$e = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE uId='$_SESSION[dpId]'"));
	$uid = $e['uId'];
?>
<div class="row-fluid">
<div class="span12">
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

				$q = mysql_query("UPDATE user SET uNama='$_POST[nama]',uTelp='$_POST[telp]',
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
				$q = mysql_query("UPDATE user SET uNama='$_POST[nama]',uTelp='$_POST[telp]',
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
</div>
</div>