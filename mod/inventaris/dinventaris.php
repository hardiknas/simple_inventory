<?php
$iid = $_GET['id'];
$page = "page=".$_GET['page']."&id=$iid";
$btnfback = "media.php?page=inv";

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
	<?php
		if ($_GET['mode']=="hapus"){
			mysql_query("DELETE FROM barang WHERE bId='$_GET[did]'");
			echo "<script>
				 		notifsukses('Sukses','Data Telah Dihapus..!!');
				  		setTimeout('window.location.href=\"media.php?$page\"', 1000)
				   </script>";
		}
	?>
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
         	<a href='?$page&mode=hapus&did=$d[bId]' class='tooltip-primary' onclick='return qh();' data-rel='tooltip' data-original-title='Hapus Inventaris'>
            	<span class='red'><i class='icon-trash bigger-120'></i></span>
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