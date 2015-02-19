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
	$tterm = (empty($_GET['thn']) ? "1" : "YEAR(bTgl)='$thn'");
	$bln = (empty($_GET['bln']) ? "" : $_GET['bln']);
	$nbln = (empty($_GET['bln']) ? "" : getBulan($_GET['bln']));
	$mterm = (empty($_GET['bln']) ? "1" : "MONTH(bTgl)='$bln'");

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
					<br><p align='center'><b><u>LAPORAN DATA INVENTARIS MASUK</u></b></p>
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
					<th align='center' width='140' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>ID Barang</th>
					<th align='center' width='200' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Info Barang</th>
					<th align='center' width='120' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Tgl Masuk</th>
					<th align='center' width='150' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Kategori</th>
					<th align='center' width='100' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Asal</th>
					<th align='center' width='60' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Jumlah</th>
				</tr>
				";
				$no = 0;
				$query = mysql_query("SELECT *,COUNT(bId) AS bJlh FROM barang WHERE $tterm AND $mterm GROUP BY bKode");
				while ($d = mysql_fetch_array($query)){
					$no++;
					$kat = getValue("kNama","ms_kategori","kId='$d[bKat]'");
	      		$jenis = getValue("jNama","_jpengadaan","jId='$d[bAsal]'");
	      		$tglm = getTglIndo($d['bTgl']);
					$content .= 
					"<tr>
						<td style='border:1px solid #000; padding: 4px;' width='15' align='center'>$no</td>
						<td style='border:1px solid #000; padding: 4px;' width='140' align='center'>$d[bKode]</td>
						<td style='border:1px solid #000; padding: 4px;' width='200'>
							Nama Barang : $d[bNama]<br>
							Merk : $d[bMerk]<br>
							Spesifikasi : $d[bSpek]<br>
						</td>
						<td style='border:1px solid #000; padding: 4px;' width='120' align='center'>$tglm</td>
						<td style='border:1px solid #000; padding: 4px;' width='150' align='center'>$kat</td>
						<td style='border:1px solid #000; padding: 4px;' width='100' align='center'>$jenis</td>
						<td style='border:1px solid #000; padding: 4px;' width='60' align='center'>$d[bJlh]</td>
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