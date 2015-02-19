<?php
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set("Asia/Makassar");

include "../config/koneksi.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_thumb.php";
include "../config/fungsiku.php";
include '../config/konfigurasi.php';

if (empty($_SESSION['dpId'])){
	echo "<script>window.close();</script>";
}

else{
	require ("html2pdf/html2pdf.class.php");
	$filename="Data Inventaris.pdf";
	$content = ob_get_clean();
	$year = date('Y');
	$month = date('m');
	$date = date('d');
	$now = date('Y-m-d');
	$date_now = getTglIndo($now);

	$ruang = (empty($_GET['r']) ? "" : $_GET['r']);
	$rng = getData("*","ms_ruangan","rKode='$ruang'");
	$jruang = getValue("jNama","_jruangan","jId='$rng[rJenis]'");
	$title = "$nbln $thn";
	$content = "
				<small>Tanggal Print : $date_now</small>
				<hr>
				<table border='0' style='margin:10px 50px 50px 50px;'>
					<tr valign='middle'>
						<td><img src='$_CONFIG[llogo]' height='$_CONFIG[sysrptheight]'></td>
						<td width='20'></td>
						<td>
							$_CONFIG[sysrptname]<br>
							<h3><b>$_CONFIG[sysowner]</b></h3>
							Alamat : $_CONFIG[sysaddress] - $_CONFIG[syscity] $_CONFIG[syspostal]<br>
							Telp. $_CONFIG[systelp] | Fax. $_CONFIG[sysfax]	| Email : $_CONFIG[sysemail]
						</td>
					</tr>
				</table>
				<hr>
					<br><p align='center'><b><u>LAPORAN DATA INVENTARIS</u></b></p>
					<table align='left'>
					<tr>
						<td><b>Laporan Per $date_now</b></td>
					</tr>
					<tr>
						<td><b>$ruang ($jruang)</b></td>
					</tr>
					</table>
				<br>

				<br>
				<table cellpadding=0 border='0' cellspacing='0' align='center'>
				<tr>
					<th align='center' width='15' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>No</th>
					<th align='center' width='120' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>ID Inventaris</th>
					<th align='center' width='200' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Barang</th>
					<th align='center' width='120' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Kategori</th>
					<th align='center' width='80' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Asal</th>
					<th align='center' width='80' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Kondisi</th>
				</tr>
				";
				$no = 0;
				$query = mysql_query("SELECT a.*, b.* FROM penempatan a 
																  LEFT JOIN barang b ON a.pInv=b.bInv
																  WHERE a.pRuang='$ruang'");
				while ($d = mysql_fetch_array($query)){
					$no++;
					$kat = getValue("kNama","ms_kategori","kId='$d[bKat]'");
	      		$jenis = getValue("jNama","_jpengadaan","jId='$d[bAsal]'");
	      		$kondisi = ($d['bKondisi']=='1' ? "Baik" : "<b>Rusak</b>");
					$content .= 
					"<tr>
						<td style='border:1px solid #000; padding: 4px;' width='15' align='center'>$no</td>
						<td style='border:1px solid #000; padding: 4px;' width='120' align='center'>$d[pInv]</td>
						<td style='border:1px solid #000; padding: 4px;' width='200'>$d[bNama], $d[bMerk]<br></td>
						<td style='border:1px solid #000; padding: 4px;' width='120' align='center'>$kat</td>
						<td style='border:1px solid #000; padding: 4px;' width='80' align='center'>$jenis</td>
						<td style='border:1px solid #000; padding: 4px;' width='80' align='center'>$kondisi</td>
					</tr>";
				}			
				$content .= "
				</table>
				<br>

				<table>
				<tr>
					<td width='450'></td>
					<td align='center'>
						Makassar, $date_now<br>
						Mengetahui :<br>
						<b>$_CONFIG[sysjabatan]</b>
						<br><br><br><br><br>								
						<u><b>$_CONFIG[syspejabat]</b></u><br>
						$_CONFIG[sysnippejabat]
					</td>
				</tr>
				</table>";
			
			
	// conversion HTML => PDF
	try
	{
		$html2pdf = new HTML2PDF('P','A4','fr', false, 'ISO-8859-15',array(10, 10, 10, 10)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>