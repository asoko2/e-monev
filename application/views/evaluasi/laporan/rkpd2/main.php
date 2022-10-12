<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">
    @media print
    {
      table { page-break-after:auto }
      tr    { page-break-inside:avoid; page-break-after:auto }
      td    { page-break-inside:avoid; page-break-after:auto }
      thead { display:table-header-group }
      tfoot { display:table-footer-group }
    }
    @page {
        size: 33cm 21.5cm;
        margin: 10mm 10mm 10mm 10mm; /* change the margins as you want them to be. */
    }
    * {
        font-family: "Arial Narrow", Arial, Tahoma, sans-serif;
        font-size: 7pt;
        line-height: 8pt;
    }
    table {
        border-collapse: collapse;
        border: 0.5pt;
        page-break-inside:auto;
    }
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }
    tfoot { display:table-footer-group }
    th{
        border: 0.5pt solid #252525 !important;
        font-size: 11pt;
        line-height: 13pt;
        font-weight: 700;
        vertical-align:top; 
    }
    td{
        border: 0.5pt solid #252525 !important;
        vertical-align:top; 
        /*word-wrap: break-word;*/
    }

    .noborder {
        border: 0pt !important;
    }

    .text-right {
        text-align: right;
    }
    .tc {
        text-align: center;
    }
</style>
<?php 
get_instance()->load->helper('global');
$per_urusan = array_group_by($m_dpa, 'kode_urusan', 'kode_bidang','kode_opd','kode_program');
$per_outcome = array_group_by($m_outcome, 'kode_opd','kode_program');
$per_output = array_group_by($m_output, 'kode_opd','kode_kegiatan');
// echo "<pre>";
// print_r($per_urusan);
// print_r($m_dpa);
// die;
$verif = Widget::detOpd('4.3.1.1');


$rata_kota_on = array_map(function($x) use ($tw) {
	if (is_null($x['target_tw1']) 
		|| is_null($x['target_tw2'])
		|| is_null($x['target_tw3'])
		|| is_null($x['target_tw4'])) {
		
		$o = 0;
	} else {
		$o = ($x["realisasi_th$tw"] / ($x['target_tw1']+$x['target_tw2']+$x['target_tw3']+$x['target_tw4']));
	}
	return $o;
}, $m_output);
$rata_kota_rn = array_map(function($x) use ($tw) {

	if (is_null($x['target_renstra'])) {
		$o = 0;
	} else {
		$o = $x["realisasi_renstra"] / $x['target_renstra'];
	}
	return $o;
}, $m_output);

$nomor_program = 0;
$realisasi_kota1 = array_sum(array_column($m_dpa, 'realisasi_tw1'));
$realisasi_kota2 = array_sum(array_column($m_dpa, 'realisasi_tw2'));
$realisasi_kota3 = array_sum(array_column($m_dpa, 'realisasi_tw3'));
$realisasi_kota4 = array_sum(array_column($m_dpa, 'realisasi_tw4'));
$realisasi_kota = array_sum(array_column($m_dpa, "realisasi_th$tw"));
$realisasi_kota_renstra = array_sum(array_column($m_dpa, "realisasi_renstra"));
$target_kota = array_sum(array_column($m_dpa, "pagu_kegiatan"));
$target_kota_renstra = array_sum(array_column($m_dpa, "target_renstra"));

// echo 'Realisasi Renstra Kab = ' . $realisasi_kota_renstra . '<br/>';
// echo 'Realisasi Tahun Kab = ' . $realisasi_kota . '<br/>';
// echo 'Target Renstra Kab = ' . $target_kota_renstra . '<br/>';
// echo 'Target Tahun Kab = ' . $target_kota . '<br/>';
// echo "<pre>";
// print_r($rata_kota_on);
// exit;
$rata_kota_o = array();
$rata_kota_r = array();

foreach ($m_bidang as $v) {
	$master_bidang[$v['kode']] = $v['nama'];
}
foreach ($m_urusan as $v) {
	$master_urusan[$v['kode']] = $v['nama'];
}
foreach ($m_opd as $v) {
	$master_opd[$v['kode']] = $v['nama'];
}
foreach ($m_program as $v) {
	$master_program[$v['kode']] = $v['nama'];
}
?>

<?php 
	$CI =& get_instance();
	$CI->load->model('bantuan');
	$no = 0;
?>
<div id="printx">
<table width="31cm" border=1 cellspacing=0 cellpadding=3>
	<tr><td colspan="25" class="noborder tc"><b>Laporan evaluasi hasil RKPD kabupaten Bojonegoro</b></td></tr>
	<tr><td colspan="25" class="noborder tc"><b>Periode Triwulan <?= $tw?> Tahun 2018</b></td></tr>
	<tr><td colspan="25" class="noborder tc"><br>&nbsp;</tr>
	<tr repeat=1>
		<td valign="middle" align="center" rowspan="2">No</td>
		<td valign="middle" width=15 align="center" rowspan="2">Urusan/Bidang Urusan Pemerintahan Daerah Dan Program/Kegiatan</td>
		<td valign="middle" width=20 align="center" rowspan="2">Kinerja Program (outcome)/ Kegiatan (output)</td>
		<td valign="middle" align="center" rowspan="2" colspan="2">Target Renstra Akhir Periode <?php echo $config->awal_renstra ?> - <?php echo $config->akhir_renstra ?></td>
		<td valign="middle" align="center" rowspan="2" colspan="2">Realisasi Capaian Kinerja Renstra s/d Tahun Lalu</td>
		<td valign="middle" align="center" rowspan="2" colspan="2">Target Kinerja dan Anggaran Renja Tahun Berjalan <?php echo $config->tahun ?></td>
		<td valign="middle" align="center" colspan="8">Realisasi Kinerja Pada Triwulan</td>
		<td valign="middle" align="center" rowspan="2" colspan="2">Realisasi Capaian Kinerja dan Anggaran Renja</td>
		<td valign="middle" align="center" rowspan="2" colspan="2">Tingkat Capaian Kinerja dan Anggaran Renja Tahun <?php echo $config->tahun ?></td>
		<td valign="middle" align="center" rowspan="2" colspan="2">Realisasi Kinerja dan Anggaran Renstra s/d Tahun <?php echo $config->tahun ?></td>
		<td valign="middle" align="center" rowspan="2" colspan="2">Tingkat Capaian Kinerja dan Anggaran Renstra s/d Tahun <?php echo $config->tahun ?></td>
	</tr>
	<tr repeat=1>
		<td valign="middle" align="center" colspan="2">1</td>
		<td valign="middle" align="center" colspan="2">2</td>
		<td valign="middle" align="center" colspan="2">3</td>
		<td valign="middle" align="center" colspan="2">4</td>
	</tr>
	<tr repeat=1>
		<td valign="middle" align="center" rowspan="2">1</td>
		<td width=15 valign="middle" align="center" rowspan="2">2</td>
		<td width=20 valign="middle" align="center" rowspan="2">3</td>
		<td valign="middle" align="center" colspan="2">4</td>
		<td valign="middle" align="center" colspan="2">5</td>
		<td valign="middle" align="center" colspan="2">6</td>
		<td valign="middle" align="center" colspan="2">7</td>
		<td valign="middle" align="center" colspan="2">8</td>
		<td valign="middle" align="center" colspan="2">9</td>
		<td valign="middle" align="center" colspan="2">10</td>
		<td valign="middle" align="center" colspan="2">11</td>
		<td valign="middle" align="center" colspan="2">12</td>
		<td valign="middle" align="center" colspan="2">13</td>
		<td valign="middle" align="center" colspan="2">14</td>
	</tr>
	<tr repeat=1>
		<td width=10 valign="middle" align="center">k</td>
		<td width=13 valign="middle" align="center">rp</td>
		<td width=10 valign="middle" align="center">k</td>
		<td width=13 valign="middle" align="center">rp</td>
		<td width=10 valign="middle" align="center">k</td>
		<td width=13 valign="middle" align="center">rp</td>
		<td width=10 valign="middle" align="center">k</td>
		<td width=13 valign="middle" align="center">rp</td>
		<td width=10 valign="middle" align="center">k</td>
		<td width=13 valign="middle" align="center">rp</td>
		<td width=10 valign="middle" align="center">k</td>
		<td width=13 valign="middle" align="center">rp</td>
		<td width=10 valign="middle" align="center">k</td>
		<td width=13 valign="middle" align="center">rp</td>
		<td width=10 valign="middle" align="center">k</td>
		<td width=13 valign="middle" align="center">rp</td>
		<td width=10 valign="middle" align="center">k</td>
		<td width=13 valign="middle" align="center">rp</td>
		<td width=10 valign="middle" align="center">k</td>
		<td width=13 valign="middle" align="center">rp</td>
		<td width=10 valign="middle" align="center">k</td>
		<td width=13 valign="middle" align="center">rp</td>
	</tr>

	<!-- START LOOP URUSAN -->
	<?php foreach ($per_urusan as $urusan => $per_bidang) :?>
		<?php include 'urusan.php'; ?>
	<?php endforeach ?>

	<tr>
		<td align="right" colspan="8">JUMLAH ANGGARAN DAN REALISASI DARI SELURUH PROGRAM</td>
		<td><?php echo uang($target_kota); ?></td>
		<td bgcolor="#333333"></td>
		<td><?php echo uang($realisasi_kota1); ?></td>
		<td bgcolor="#333333"></td>
		<td><?php echo uang($realisasi_kota2); ?></td>
		<td bgcolor="#333333"></td>
		<td><?php echo uang($realisasi_kota3); ?></td>
		<td bgcolor="#333333"></td>
		<td><?php echo uang($realisasi_kota4); ?></td>
		<td bgcolor="#333333"></td>
		<td><?php echo uang($realisasi_kota); ?></td>
		<td colspan="7" bgcolor="#333333"></td>
	</tr>

	<tr>
		<td align="right" colspan="19">
			TOTAL RATA-RATA CAPAIAN KINERJA DAN ANGGARAN DARI SELURUH PROGRAM (PROGRAM 1 s.d. PROGRAM <?php echo $nomor_program; ?>)
		</td>
		<td><?php echo persentase(array_sum($rata_kota_on),count($rata_kota_on)) ?></td>
		<td><?php echo persen($realisasi_kota/$target_kota); ?></td>
		<td colspan="2"></td>
		<td><?php echo persentase(array_sum($rata_kota_rn),count($rata_kota_rn)) ?></td>
		<td><?php echo persen(($realisasi_kota + $realisasi_kota_renstra)/$target_kota_renstra); ?></td>
	</tr>
	<tr>
		<td align="right" colspan="19">PREDIKAT KINERJA DARI SELURUH PROGRAM (PROGRAM 1 s.d. PROGRAM <?php echo $no; ?>)</td>
		<td><?php echo predikatss(array_sum($rata_kota_on),count($rata_kota_on)) ?></td>
		<td><?php echo predikat($realisasi_kota/$target_kota); ?></td>
		<td colspan="2"></td>
		<td><?php echo predikatss(array_sum($rata_kota_rn),count($rata_kota_rn)) ?></td>
		<td><?php echo predikat(($realisasi_kota + $realisasi_kota_renstra)/$target_kota_renstra); ?></td>
	</tr>
	<tr>
		<td border=0 colspan="25"></td>
	</tr>
	<tr>
		<td border=0 colspan="7" align="center">
			<br>
			Verifikator
			<br>
			<br>
			<br>
			<br>
			<br>
			<b><?= app('nama_verifikator') ?></b><br>
			NIP. <?= app('nip_verifikator') ?> <br>
            <?= app('pangkat_verifikator') ?> <br>
		</td>
		<td border=0 colspan="18" align="center">
			<?php echo strtoupper("Bojonegoro") . ", " . tgl_indo(date("Y-m-d H:i:s")) ?>
			<br>
			<b><?php echo strtoupper("Kepala Bappeda") ?></b>
			<br>
			<br>
			<br>
			<br>
			<br>
			<b>Ir. I Nyoman Sudana, MM</b><br>
			19601211 198603 0 011
		</td>
	</tr>
	<!-- END URUSAN -->
</table>
</div>