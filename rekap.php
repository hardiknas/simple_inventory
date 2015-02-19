<?php
	$page = $_GET['page'];
?>
<div class="row-fluid">
<div class="span12">
	<?php
	if (empty($_GET['thn'])){
	?>
	<!-- FORM -->
	<div class="row-fluid">
	<div class="span3"></div>
		<div class="span6">
		<div class="widget-box">
			<div class="widget-header">
				<h4>Tahun</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding center">
				<form method="GET">
					<input type="hidden" name="page" value="<?php echo $page;?>">
					<fieldset data-rel="tooltip" data-original-title="Pilih Tahun">
					<select class="chosen-select span3" id="thn" name="thn" data-placeholder="Pilih Tahun">
						<option value="xxxx">Semua</option>
						<?php
						$qd = mysql_query("SELECT DISTINCT a.rTMasuk FROM residen a ORDER BY a.rTMasuk ASC");
						while($md=mysql_fetch_array($qd)){
							echo "<option value='$md[rTMasuk]'>$md[rTMasuk]</option>";
						}
						?>
					</select>
					</fieldset>
					<div class="form-actions center">
					<button type="submit" class="btn btn-info btn-small">
						View <i class="icon-search icon-on-right bigger-110"></i>
					</button>
					</div>
				</form>
				</div>
			</div>
		</div>
		</div>
	<div class="span2"></div>
	</div>
	<!-- FORM -->
	<?php
	}elseif(isset($_GET['thn'])){
		$thn = $_GET['thn'];
		$qterm = (($thn=="xxxx") ? "1" : "rTMasuk='$thn'");
		$title = (($thn=="xxxx") ? "" : "Tahun $thn");
	?>
		<div class="page-header">
			<h1>Rekapitulasi Aktifitas Residen <?php echo $title;?></h1>
		</div>
		<div class="row-fluid ">
		<div class="span12">
			<div class="table-header">
	   		Rekapitulasi Aktifitas Residen
			</div>
			<div class="row-fluid">
			<table id="myTable" class="table table-striped table-bordered table-hover">
			<thead>
			    <tr>
			    <th class="center" width="40px">No</th>
			    <th class="center" width="80px">NIM</th>
			    <th class="center">Nama</th>
			    <th class="center" width="60px">Profil</th>
			    <th class="center" width="30px" data-rel="tooltip" data-original-title="SKS">A</th>
			    <th class="center" width="30px" data-rel="tooltip" data-original-title="KEGIATAN">B</th>
			    <th class="center" width="30px" data-rel="tooltip" data-original-title="TUGAS ILMIAH">C</th>
			    <th class="center" width="30px" data-rel="tooltip" data-original-title="KETERAMPILAN BEDAH (WET LAB)">D</th>
			    <th class="center" width="30px" data-rel="tooltip" data-original-title="KETERAMPILAN BEDAH (PASIEN)">E</th>
			    <th class="center" width="30px" data-rel="tooltip" data-original-title="BIMBINGAN KASUS MINGGUAN CO-ASISTEN">F</th>
			    <th class="center" width="30px" data-rel="tooltip" data-original-title="BIMBINGAN REFERAT CO-ASISTEN">G</th>
			    <th class="center" width="30px" data-rel="tooltip" data-original-title="BAD SITE TEACHING (BST)">H</th>
			    <th class="center" width="30px" data-rel="tooltip" data-original-title="STASE">I</th>
			    <th class="center" width="30px" data-rel="tooltip" data-original-title="TUGAS DAERAH">J</th>
			    <th class="center" width="30px" data-rel="tooltip" data-original-title="SANKSI">K</th>
			    <th class="center" width="30px" data-rel="tooltip" data-original-title="CUTI">L</th>
			    <th class="center" width="30px" data-rel="tooltip" data-original-title="ROTASI RUMAH SAKIT">M</th>
			    <th class="center" width="30px" data-rel="tooltip" data-original-title="THESIS">N</th>
			    <th class="center" width="30px" data-rel="tooltip" data-original-title="PENGHARGAAN (AWARDS)">O</th>
			    <th class="center" width="30px" data-rel="tooltip" data-original-title="PEMERIKSAAN (REKAM MEDIS)">P</th>
			    </tr>
			</thead>
			<tbody>
			 <?php
			    $qry = mysql_query("SELECT * FROM residen WHERE $qterm");
				while ($d = mysql_fetch_array($qry)){
			      $no++;
			      $nim = $d['rNim'];
			      $nama = $d['rNama'];

			      if ($d['rProfil']==1){
			      	$profil = "<i class='icon-check green' data-rel='tooltip' data-original-title='Lengkap'><i>";
			      }else{
			      	$profil = "<i class='icon-remove red' data-rel='tooltip' data-original-title='Belum Lengkap'><i>";
			      }
			      $jsks = getAktivitas("rNim","res_sks","$nim");
					$jkeg = getAktivitas("rNim","res_rekmed","$nim");
					$jti = getAktivitas("rNim","res_tugasilmiah","$nim");
					$jbw = getAktivitas("rNim","res_bedahwlab","$nim");
					$jbp = getAktivitas("rNim","res_bedahpasien","$nim");
					$jbkk = getAktivitas("rNim","res_bkkoas","$nim");
					$jbrk = getAktivitas("rNim","res_brkoas","$nim");
					$jbst = getAktivitas("rNim","res_bsteaching","$nim");
					$jstase = getAktivitas("rNim","res_stase","$nim");
					$jtd = getAktivitas("rNim","res_tdaerah","$nim");
					$jsank = getAktivitas("rNim","res_sanksi","$nim");
					$jcuti = getAktivitas("rNim","res_cuti","$nim");
					$jrot = getAktivitas("rNim","res_rotrs","$nim");
					$jthesis = getAktivitas("rNim","res_thesis","$nim");
					$jawards = getAktivitas("rNim","res_awards","$nim");
					$jrmed = getAktivitas("rNim","res_rekmed","$nim");
			      echo "
			      <tr>
			      <td class='center'>$no</td>
			      <td class='center'>$nim</td>
			      <td>$nama</td>
			      <td class='center'>$profil</td>
			      <td class='center'>$jsks</td>
			      <td class='center'>$jkeg</td>
			      <td class='center'>$jti</td>
			      <td class='center'>$jbw</td>
			      <td class='center'>$jbp</td>
			      <td class='center'>$jbkk</td>
			      <td class='center'>$jbrk</td>
			      <td class='center'>$jbst</td>
			      <td class='center'>$jstase</td>
			      <td class='center'>$jtd</td>
			      <td class='center'>$jsank</td>
			      <td class='center'>$jcuti</td>
			      <td class='center'>$jrot</td>
			      <td class='center'>$jthesis</td>
			      <td class='center'>$jawards</td>
			      <td class='center'>$jrmed</td>
			     	</tr>";
			      }
			   ?>
			</tbody>
			</table>
			</div>
		</div><!--span12-->
		</div><!--row-fluid-->
	<?php
	}
	?>
</div>
</div>