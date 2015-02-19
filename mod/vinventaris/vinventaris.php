<div class="row-fluid">
<?php
if ($_GET['act']=="detail"){
?>
	<?php
	$iid = $_GET['id'];
	$page = "page=".$_GET['page']."&id=$iid";
	$btnfback = "media.php?page=vinv";

	$dt = getData("*,COUNT(bId) AS bJlh","barang","bKode='$iid' GROUP BY bKode");
	?>
	<div class="page-header">
		<div class="alert alert-info">
			<b>ID Barang : </b><?php echo $dt['bKode'];?><br>
			<b>Nama Barang : </b><?php echo $dt['bNama'];?><br>		
			<b>Merk : </b><?php echo $dt['bMerk'];?><br>	
			<b>Jumlah : </b><?php echo $dt['bJlh'];?><br>
			<b>Spesifikasi : </b><?php echo $dt['bSpek'];?>	
		</div>
	</div>
	<div class="row-fluid">
	<div class="span12">
		<a href='<?php echo $btnfback?>' class='btn pull-right'>
			<i class='icon-reply bigger-100'></i>Kembali
		</a>
		<br><br><br>
		<div class="table-header">
		   INVENTARIS
		</div>
		<div class="row-fluid">
		<table id="myTable" class="table table-striped table-bordered table-hover">
		<thead>
		    <tr>
		    <th class="center" width="40px">No</th>
		    <th class="center" width="150px">No.Inventaris</th>
		    <th class="center">Lokasi</th>
		    <th class="center" width="200px">Kondisi</th>
		    <th class="center sorting_disabled" width="40px"></th>
		    </tr>
		</thead>
		<tbody>
		 <?php
		 	$qrt = "SELECT a.*,b.pRuang FROM barang a
		 			  LEFT JOIN penempatan b ON a.bInv=b.pInv
		 			  WHERE bKode='$iid'";
		   $qry = mysql_query($qrt);
			while ($d = mysql_fetch_array($qry)){
		      $no++;
		      $lokasi = ($d['pRuang']=="" ? "<span class='badge badge-success'>Tersedia</span>" : "$d[pRuang]" );
		      $status = ($d['bKondisi']=="1" ? "<span class='badge badge-success'>Baik</span>" : "<span class='badge badge-important'>Rusak</span>");
		      echo "
		      <tr>
		      <td class='center'>$no</td>
		      <td class='center'>$d[bInv]</td>
		      <td class='center'>$lokasi</td>
		      <td class='center'>$status</td>
		      <td class='center'>
	         	<a href='?page=hrepair&did=$d[bInv]' class='tooltip-primary' data-rel='tooltip' data-original-title='History Perbaikan'>
	            	<span class='blue'><i class='icon-bar-chart bigger-120'></i></span>
	            </a>
			   </td>
			   </tr>";
		   }
		   ?>
		</tbody>
		</table>
		</div>
	</div>
	</div>
<?php
}else{
?>
	<div class="span12">
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
		    <th class="center" width="60px">Detail</th>
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
			      <a href='?page=vinv&act=detail&id=$d[bKode]' class='tooltip-success' data-rel='tooltip' data-original-title='Detail Inventaris'>
			      	<span class='blue'><i class='icon-book bigger-120'></i></span>
			      </a>
			   </td>
			   </tr>";
		   }
		   ?>
		</tbody>
		</table>
		</div>
	</div>
<?php
}
?>
</div>