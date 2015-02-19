<script src="../assets/chart/Chart.js"></script>
<style type="text/css">
canvas {
   width: 100% !important;
   max-width: 800px;
   height: auto !important;
}
</style>
<?php
	$hari_s = getHari(date("w"));
	$infologin =  "$hari_s, ".getTglIndo(date('Y m d'))." | ".date('H:i:s');
?>
<div class="alert alert-block alert-success">
	<button type="button" class="close" data-dismiss="alert">
		<i class="icon-remove"></i>
	</button>
	<i class="icon-ok green"></i>
		Hai,, <strong class="blue"><?php echo $_SESSION['dpNama'];?></strong>, 
		selamat datang di halaman Administrator.<br> Silahkan klik menu pilihan yang berada 
		di sebelah kiri untuk mengelola konten website anda.
		<small class="red">
			<p>&nbsp;</p<p>&nbsp;</p>
			<p>Login : <?php echo $infologin;?> WITA</p>
		</small>
</div>
<!--PAGE CONTENT BEGINS-->
<div class="row-fluid">
	<div class="span12">
		<div class="table-header">
		   REKAPITULASI KONDISI KESELURUHAN INVENTARIS PER <?php echo strtoupper($infologin);?>
		</div>
		<div class="row-fluid">
		<table id="myTable" class="table table-striped table-bordered table-hover">
		<thead>
		    <tr>
		    <th class="center" width="40px">No</th>
		    <th class="center">Kategori</th>
		    <th class="center" width="150">Total</th>
		    <th class="center" width="150">Baik</th>
		    <th class="center" width="150">Rusak</th>
		    <th class="center" width="150">Terpakai</th>
		    <th class="center" width="150">Tersedia</th>
		    </tr>
		</thead>
		<tbody>
		 <?php
		   $qry = mysql_query("SELECT a.kId,a.kNama FROM ms_kategori a");
			while ($d = mysql_fetch_array($qry)){
		      $no++;
		      $jtotal = getJumlah("SELECT bId FROM barang WHERE bKat='$d[kId]'");
		      $jbaik = getJumlah("SELECT bId FROM barang WHERE bKat='$d[kId]' AND bKondisi='1'");
		      $jrusak = getJumlah("SELECT bId FROM barang WHERE bKat='$d[kId]' AND bKondisi='0'");
		      $jterpakai = getJumlah("SELECT bId FROM barang WHERE bKat='$d[kId]' AND bInv IN (SELECT pInv FROM penempatan)");
		      $jtersedia = getJumlah("SELECT bId FROM barang WHERE bKat='$d[kId]' AND bInv NOT IN (SELECT pInv FROM penempatan)");
		      echo "
		      <tr>
		      <td class='center'>$no</td>
		      <td class='left'>$d[kNama]</td>
		      <td class='center'>$jtotal</td>
		      <td class='center'>$jbaik</td>
		      <td class='center'>$jrusak</td>
		      <td class='center'>$jterpakai</td>
		      <td class='center'>$jtersedia</td>
			   </tr>";
		   }
		   ?>
		</tbody>
		</table>
	</div>
</div>
<!--PAGE CONTENT ENDS-->