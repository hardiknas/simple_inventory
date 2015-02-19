<?php
$rid = $_GET['id'];
$btnfback = "media.php?page=vinvr";

$ru = getData("*","ms_ruangan","rKode='$rid'");
$rj = getValue("jNama","_jruangan","jId='$ru[rJenis]'");
?>
<div class="page-header">
	<h1 class="blue">
		Ruangan : <?php echo $ru['rNama'];?><br>
		Jenis : <?php echo $rj;?><br>		
	</h1>
</div>
<a href='<?php echo $btnfback?>' class='btn pull-right'>
	<i class='icon-reply bigger-100'></i>Kembali
</a>
<br><br><br>
<div class="row-fluid">
<div class="span12">
	<div class="table-header">
	   INVENTARIS RUANGAN <?php echo $rid;?>
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="40px">No</th>
	    <th class="center">Inventaris</th>
	    <th class="center" width="100px">Kondisi</th>
	    </tr>
	</thead>
	<tbody>
	 <?php
	 	$qrt = "SELECT a.*,b.bNama,b.bMerk,b.bKondisi FROM penempatan a 
	 			  LEFT JOIN barang b ON a.pInv=b.bInv 
	 			  WHERE a.pRuang='$rid'";
	   $qry = mysql_query($qrt);
		while ($d = mysql_fetch_array($qry)){
	      $no++;
	      $status = ($d['bKondisi']=="1" ? "<span class='badge badge-success'>Baik</span>" : "<span class='badge badge-important'>Rusak</span>");
	      echo "
	      <tr>
	      <td class='center'>$no</td>
	      <td class='left'>
	      	$d[pInv] - $d[bNama]
	      </td>
	      <td class='center'>$status</td>
		   </tr>";
	   }
	   ?>
	</tbody>
	</table>
	</div>
</div>
</div>