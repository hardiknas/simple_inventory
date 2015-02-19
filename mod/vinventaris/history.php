<div class="row-fluid">
<div class="span12">
<?php
$iid = $_GET['did'];

$dt = getData("*","barang","bInv='$iid'");
$lok = getValue("pRuang","penempatan","pInv='$iid'");
$lokasi = ($lok=="" ? "Tersedia" : "$lok" );
?>
<div class="page-header">
	<div class="alert alert-info">
		<b>ID Barang : </b><?php echo $dt['bKode'];?><br>
		<b>ID Inventaris : </b><?php echo $dt['bInv'];?><br>		
		<b>Nama : </b><?php echo $dt['bNama'];?><br>	
		<b>Merk : </b><?php echo $dt['bMerk'];?><br>	
		<b>Spesifikasi : </b><?php echo $dt['bSpek'];?>	
		<b>Lokasi : </b><?php echo $lokasi;?>	
	</div>
</div>
<button onclick="window.history.back()" class='btn pull-right'>
	<i class='icon-reply bigger-100'></i>Kembali
</button>
<br><br><br>
<div class="table-header">
   HISTORY PERBAIKAN
</div>
<div class="row-fluid">
<table id="myTable" class="table table-striped table-bordered table-hover">
<thead>
    <tr>
    <th class="center" width="40px">No</th>
    <th class="center" width="120px">ID Tiket</th>
    <th class="center" width="150px">PJ</th>
    <th class="center" width="150px">Status</th>
    <th class="center">Kerusakan</th>
    <th class="center">Pasca Perbaikan</th>
    </tr>
</thead>
<tbody>
 <?php
   $qry = mysql_query("SELECT a.*,b.pTglS,b.pKondisi,b.pKet FROM perbaikan a LEFT JOIN sperbaikan b ON a.pTiket=b.pTiket WHERE a.pInv='$iid'");
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
      <td class='center'>$d[pPJ]</td>   
      <td class='center'>$status</td>
      <td class='left'>
      	<b>Tanggal : </b> $tglp<br>
      	$d[pKerusakan]<br>
      </td>
      <td class='left'>
      	$pasca
      </td>
      </tr>";
   }
   ?>
</tbody>
</table>
</div>
</div>
</div>