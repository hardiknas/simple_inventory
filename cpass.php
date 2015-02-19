<?php
	$page = "home";
	$e = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE uId='$_SESSION[dpId]'"));
	$uid = $e['uId'];
?>
<div class="row-fluid">
<div class="span12">
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