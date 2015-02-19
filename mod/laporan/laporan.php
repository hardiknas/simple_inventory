<div class="row-fluid">
<div class="span12">	
	<div class="table-header">
	   LAPORAN
	</div>
	<div class="row-fluid">
	<table id="xmyTable" class="table table-striped table-bordered table-hover">
	<thead>
	   <tr>
	   <th class="center" width="40px">No</th>
	   <th class="center" width="400px">Jenis Laporan</th>
		<th class="center">Filter</th>
	   <th class="center" width="200px">Aksi</th>
	   </tr>
	</thead>
	<tbody>
		<tr>
		   <td class="center">1</td>
		   <td class="left">Laporan Data Kondisi Inventaris Saat Ini</td>
		   <form action="cetak/lapinvnow.php" method="GET" target="_blank">
		   <td class="center">
		   	<?php
		   		$tnow = getTglIndo(date("Y-m-d"));
		   	?>
		   	Ket : Laporan Data Kondisi Inventaris Per <?php echo $tnow;?>
		   </td>
		   <td class="center">
		   	<button class='btn btn-primary btn-small' type="submit">
					<i class='icon-print bigger-100'></i> Cetak
				</button>
			</td>
			</form>
	   </tr>
	 	<tr>
		   <td class="center">2</td>
		   <td class="left">Laporan Data Inventaris Masuk Berdasarkan Bulan & Tahun</td>
		   <form action="cetak/lapinv.php" method="GET" target="_blank">
		   <td class="center">
		   	<select class="span4" id="bln" name="bln" data-placeholder="Pilih Bulan">
					<?php
					for ($b=1;$b<=12;$b++){
						$nmbln = getBulan($b);
						if ($b==$bln){
							echo "<option value='$b' selected>$nmbln</option>";
						}else{
							echo "<option value='$b'>$nmbln</option>";
						}
					}
					?>
				</select>
				<select class="span3" id="thn" name="thn" data-placeholder="Pilih Tahun">
					<?php
					$qpr = mysql_query("SELECT DISTINCT YEAR(bTgl) as thn FROM barang");
					while($m=mysql_fetch_array($qpr)){
						if ($m['thn']==$thn){
							echo "<option value='$m[thn]' selected>$m[thn]</option>";
						}else{
							echo "<option value='$m[thn]'>$m[thn]</option>";
						}
					}
					?>
				</select>
		   </td>
		   <td class="center">
		   	<button class='btn btn-primary btn-small' type="submit">
					<i class='icon-print bigger-100'></i> Cetak
				</button>
			</td>
			</form>
	   </tr>
	   <tr>
		   <td class="center">2</td>
		   <td class="left">Laporan Inventaris Per Ruangan</td>
		   <form action="cetak/lapinvr.php" method="GET" target="_blank">
		   <td class="center">
				<select class="chosen-select span2" id="r" name="r" data-placeholder="Pilih Ruangan">
					<?php
					$qpr = mysql_query("SELECT rKode,rNama FROM ms_ruangan");
					while($m=mysql_fetch_array($qpr)){
						echo "<option value='$m[rKode]'>$m[rKode]</option>";
					}
					?>
				</select>
		   </td>
		   <td class="center">
		   	<button class='btn btn-primary btn-small' type="submit">
					<i class='icon-print bigger-100'></i> Cetak
				</button>
			</td>
			</form>
	   </tr>
	   <tr>
		   <td class="center">3</td>
		   <td class="left">Laporan Perbaikan</td>
		   <form action="cetak/laprepair.php" method="GET" target="_blank">
		    <td class="center">
		   	<select class="span4" id="bln" name="bln" data-placeholder="Pilih Bulan">
					<?php
					for ($b=1;$b<=12;$b++){
						$nmbln = getBulan($b);
						if ($b==$bln){
							echo "<option value='$b' selected>$nmbln</option>";
						}else{
							echo "<option value='$b'>$nmbln</option>";
						}
					}
					?>
				</select>
				<select class="span3" id="thn" name="thn" data-placeholder="Pilih Tahun">
					<?php
					$qpr = mysql_query("SELECT DISTINCT YEAR(bTgl) as thn FROM barang");
					while($m=mysql_fetch_array($qpr)){
						if ($m['thn']==$thn){
							echo "<option value='$m[thn]' selected>$m[thn]</option>";
						}else{
							echo "<option value='$m[thn]'>$m[thn]</option>";
						}
					}
					?>
				</select>
		   </td>
		   <td class="center">
		   	<button class='btn btn-primary btn-small' type="submit">
					<i class='icon-print bigger-100'></i> Cetak
				</button>
			</td>
			</form>
	   </tr>
	</tbody>
	</table>
	</div>
</div>
</div>