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

	$thn = (empty($_GET['thn']) ? "" : $_GET['thn']);
	$tterm = (empty($_GET['thn']) ? "1" : "YEAR(a.pTgl)='$thn'");
	$bln = (empty($_GET['bln']) ? "" : $_GET['bln']);
	$nbln = (empty($_GET['bln']) ? "" : getBulan($_GET['bln']));
	$mterm = (empty($_GET['bln']) ? "1" : "MONTH(a.pTgl)='$bln'");

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
					<br><p align='center'><b><u>LAPORAN PERBAIKAN INVENTARIS</u></b></p>
					<table align='center'>
					<tr>
						<td><b>$title</b></td>
					</tr>
					</table>
				<br>

				<br>
				<table cellpadding=0 border='0' cellspacing='0' align='center'>
				<tr>
					<th align='center' width='15' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>No</th>
					<th align='center' width='80' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>ID Tiket</th>
					<th align='center' width='200' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Inventaris</th>
					<th align='center' width='120' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>PJ</th>
					<th align='center' width='60' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Status</th>
					<th align='center' width='200' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Kerusakan</th>
					<th align='center' width='200' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Pasca Perbaikan</th>
				</tr>
				";
				$no = 0;
				$query = mysql_query("SELECT a.*,b.pTglS,b.pKondisi,b.pKet FROM perbaikan a 
															LEFT JOIN sperbaikan b ON a.pTiket=b.pTiket 
															WHERE $tterm AND $mterm");
				while ($d = mysql_fetch_array($query)){
					$no++;
					$brg = getData("*","barang","bInv='$d[pInv]'");
			      $tglp = getTglIndo($d['pTgl']);
			      $tgls = getTglIndo($d['pTglS']);
			      $status = ($d['pProses']=="1" ? "<b>Proses</b>" : "Selesai");
			      $kondisi = ($d['pKondisi']=="1" ? "Baik" : "<b>Rusak</b>");
			      $pasca = "";
			      if (!empty($d['pTglS'])){
			      	$pasca = "<b>Tanggal : </b> $tgls<br>
							       <b>Kondisi : </b> $kondisi<br>
							       $d[pKet]<br>";
			      }
					$content .= 
					"<tr>
						<td style='border:1px solid #000; padding: 4px;' width='15' align='center'>$no</td>
						<td style='border:1px solid #000; padding: 4px;' width='80' align='center'>$d[pTiket]</td>
						<td style='border:1px solid #000; padding: 4px;' width='200'>
							ID Inventaris : $d[pInv]<br>
							Nama Barang : $brg[bNama]<br>
							Merk : $brg[bMerk]<br>
						</td>
						<td style='border:1px solid #000; padding: 4px;' width='120' align='center'>$d[pPJ]</td>
						<td style='border:1px solid #000; padding: 4px;' width='60' align='center'>$status</td>
						<td style='border:1px solid #000; padding: 4px;' width='200' align='left'>
							<b>Tanggal : </b> $tglp<br>
      					$d[pKerusakan]<br>
						</td>
						<td style='border:1px solid #000; padding: 4px;' width='200' align='left'>
							$pasca
						</td>
					</tr>";
				}			
				$content .= "
				</table>
				<br>

				<table>
				<tr>
					<td width='700'></td>
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
		$html2pdf = new HTML2PDF('L','A4','fr', false, 'ISO-8859-15',array(10, 10, 10, 10)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>