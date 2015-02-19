<?php
  header("Cache-Control: no-cache, must-revalidates");
  header("Expires: Mon, 26 Jul 1997 00:00:00 GMT");

  require_once ("config/koneksi.php");

  $x = $_GET["x"]; // Ambil variabel URL
  $uid = $_GET["uid"];
  $sql = "SELECT * FROM user WHERE uUname='$x' AND uId!='$uid'";
  $hasil = mysql_query($sql);
  if (!$hasil){
   print("query tak dapat diproses");
  }else{
     $baris = mysql_fetch_row($hasil);
     $data_ada = TRUE;
     if (empty($baris)){
        $data_ada = FALSE;
     }
     if ($data_ada){
		 		echo "<span class='label label-large label-warning'>Username sudah terdaftar, Gunakan Username lain..!!</span>";
     }else{
		    echo "<span class='label label-large label-success'>OK</span>";
	   }
  }
?>
