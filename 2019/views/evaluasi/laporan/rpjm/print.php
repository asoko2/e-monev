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

<div id="printx" style="border: none">
<table width="100%" border=0 cellspacing=0 cellpadding=3>
	<tr  border=0><td colspan="41" class="noborder tc"  align="center" border=0 style="border :0pt"><b>Formulir E.58</b></td></tr>
	<tr  border=0><td colspan="41" class="noborder tc" align="center" border=0 style="border :0"><b>Evaluasi Terhadap Hasil RPJMD</b></td></tr>
	<tr><td colspan="41" class="noborder tc" align="center"><b>Kabupaten Bojonegoro</b></td></tr>
	<tr><td colspan="41" class="noborder tc" align="center"><b>Period Pelaksanaan: Tahun <?= $rpjmd->renstra_awal ?>- Tahun  <?= $rpjmd->renstra_5 ?></b></td></tr>
	<tr><td colspan="41" class="noborder text-left"><br>Sasaran Pembangunan Jangka Menengah:</tr>
	<tr><td colspan="41" class="noborder text-left"><br> </tr>

	<tr repeat=1>
		<td valign="middle" align="center" rowspan="2">No</td>
		<td valign="middle" align="center" rowspan="2">Sasaran</td>
		<td valign="middle" align="center" rowspan="2">Program Pioritas</td>
		<td valign="middle" align="center" rowspan="2">Indikator kinerja</td>
		<td valign="middle" align="center" rowspan="2">Data Capaian Awal Tahun</td>
		<td valign="middle" align="center" rowspan="2" colspan="2">Target Pada Akhir Tahun Perencanaan</td>
		<td valign="middle" align="center" colspan="10">Target RPJMD Kabupaten/Kota Pada RKPD Kabupaten/kota Tahun Ke-</td>
		<td valign="middle" align="center" colspan="10">Capaian Target RPJMD Kabupaten/Kota Pada RKPD Kabupaten/kota Tahun Ke-</td>
		<td valign="middle" align="center" colspan="10">Tingkat Capaian Target RPJMD Kabupaten/Kota Pada RKPD Kabupaten/kota Tahun Ke-</td>
		<td valign="middle" align="center" rowspan="2" colspan="2">Capaian Pada Akhir Tahun Perencanaan</td>
		<td valign="middle" align="center" rowspan="2" colspan="2">Rasio Capian Akhir (%)</td>
	</tr>
	<tr repeat=1>
		<td valign="middle" align="center" colspan="2">1</td>
		<td valign="middle" align="center" colspan="2">2</td>
		<td valign="middle" align="center" colspan="2">3</td>
		<td valign="middle" align="center" colspan="2">4</td>
		<td valign="middle" align="center" colspan="2">5</td>

		<td valign="middle" align="center" colspan="2">1</td>
		<td valign="middle" align="center" colspan="2">2</td>
		<td valign="middle" align="center" colspan="2">3</td>
		<td valign="middle" align="center" colspan="2">4</td>
		<td valign="middle" align="center" colspan="2">5</td>

		<td valign="middle" align="center" colspan="2">1</td>
		<td valign="middle" align="center" colspan="2">2</td>
		<td valign="middle" align="center" colspan="2">3</td>
		<td valign="middle" align="center" colspan="2">4</td>
		<td valign="middle" align="center" colspan="2">5</td>


	</tr>
	<tr repeat=1>
		<td valign="middle" align="center" rowspan="2">(1)</td>
		<td valign="middle" align="center" rowspan="2">(2)</td>
		<td valign="middle" align="center" rowspan="2">(3)</td>
		<td valign="middle" align="center" rowspan="2">(4)</td>
		<td valign="middle" align="center" rowspan="2">(5)</td>
		<td valign="middle" align="center" colspan="2">(6)</td>
		<td valign="middle" align="center" colspan="2">(7)</td>
		<td valign="middle" align="center" colspan="2">(8)</td>
		<td valign="middle" align="center" colspan="2">(9)</td>
		<td valign="middle" align="center" colspan="2">(10)</td>
		<td valign="middle" align="center" colspan="2">(11)</td>
		<td valign="middle" align="center" colspan="2">(12)</td>
		<td valign="middle" align="center" colspan="2">(13)</td>
		<td valign="middle" align="center" colspan="2">(14)</td>
		<td valign="middle" align="center" colspan="2">(15)</td>
		<td valign="middle" align="center" colspan="2">(16)</td>
		<td valign="middle" align="center" colspan="2">(17)</td>
		<td valign="middle" align="center" colspan="2">(18)</td>
		<td valign="middle" align="center" colspan="2">(19)</td>
		<td valign="middle" align="center" colspan="2">(20)</td>
		<td valign="middle" align="center" colspan="2">(21)</td>
		<td valign="middle" align="center" colspan="2">(22)</td>
		<td valign="middle" align="center" colspan="2">(23)</td>
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

	<?php foreach ($rpjm as $sasaran): ?>
		<tr>
			<td></td>
			<td colspan="40"><?= $sasaran['uraian'] ?></td>
		</tr>
		<?php 
			$i = 1; //hitudng urutan
		?>
		<?php if (isset($sasaran['program'])): ?>
			<?php foreach ($sasaran['program'] as $k_program =>  $program): ?>
				<?php foreach ($program->indikator as $i => $indikator): ?>
					<?php if ($i == 0): ?>
						<tr>
							<td></td>
							<td></td>
							<td><?= $program->nama_program?></td>
							<td><?= $indikator->indikator ?> (<?=  $indikator->satuan ?>) </td>
							<td class="text-right"><?= ($indikator->r_rpjm_0) ?> </td>
							<td class="text-right"><?= ($indikator->t_rpjm_0) ?> </td>
							<td class="text-right"><?= ($program->akhir_rpjm) ?> </td>
							<td class="text-right"><?= ($indikator->t_rpjm_1) ?></td>
							<td class="text-right"><?= ($program->t_rpjm_1) ?> </td>
							<td class="text-right"><?= ($indikator->t_rpjm_2) ?></td>
							<td class="text-right"><?= ($program->t_rpjm_2) ?> </td>
							<td class="text-right"><?= ($indikator->t_rpjm_3) ?></td>
							<td class="text-right"><?= ($program->t_rpjm_3) ?> </td>
							<td class="text-right"><?= ($indikator->t_rpjm_4) ?></td>
							<td class="text-right"><?= ($program->t_rpjm_4) ?> </td>
							<td class="text-right"><?= ($indikator->t_rpjm_5) ?></td>
							<td class="text-right"><?= ($program->t_rpjm_5) ?> </td>

							<td class="text-right"><?= ($indikator->r_rpjm_1) ?></td>
							<td class="text-right"><?= ($program->r_rpjm_1) ?> </td>
							<td class="text-right"><?= ($indikator->r_rpjm_2) ?></td>
							<td class="text-right"><?= ($program->r_rpjm_2) ?> </td>
							<td class="text-right"><?= ($indikator->r_rpjm_3) ?></td>
							<td class="text-right"><?= ($program->r_rpjm_3) ?> </td>
							<td class="text-right"><?= ($indikator->r_rpjm_4) ?></td>
							<td class="text-right"><?= ($program->r_rpjm_4) ?> </td>
							<td class="text-right"><?= ($indikator->r_rpjm_5) ?></td>
							<td class="text-right"><?= ($program->r_rpjm_5) ?> </td>
							<?php 
							// hitung rata2
							if ($indikator->c_rpjm_1 !== '' || $indikator->c_rpjm_1 != '-') {
								$rata_rata[1] [] = $indikator->c_rpjm_1;
								$rata_rata[2] [] = $indikator->c_rpjm_2;
								$rata_rata[3] [] = $indikator->c_rpjm_3;
								$rata_rata[4] [] = $indikator->c_rpjm_4;
								$rata_rata[5] [] = $indikator->c_rpjm_5;

								$rata_rata_keu [1] [] = $program->c_rpjm_1;
								$rata_rata_keu [2] [] = $program->c_rpjm_2;
								$rata_rata_keu [3] [] = $program->c_rpjm_3;
								$rata_rata_keu [4] [] = $program->c_rpjm_4;
								$rata_rata_keu [5] [] = $program->c_rpjm_5;

								$rata_rata_tot [] = $indikator->rasio_rpjm;
								$rata_rata_keu_tot [] = $program->rasio_rpjm;
								
							}
							?>

							<td class="text-right"><?= ($indikator->c_rpjm_1) ?> cek</td>
							<td class="text-right"><?= nilai($program->c_rpjm_1) ?> </td>
							<td class="text-right"><?= ($indikator->c_rpjm_2) ?></td>
							<td class="text-right"><?= nilai($program->c_rpjm_2) ?> </td>
							<td class="text-right"><?= ($indikator->c_rpjm_3) ?></td>
							<td class="text-right"><?= nilai($program->c_rpjm_3) ?> </td>
							<td class="text-right"><?= ($indikator->c_rpjm_4) ?></td>
							<td class="text-right"><?= nilai($program->c_rpjm_4) ?> </td>
							<td class="text-right"><?= ($indikator->c_rpjm_5) ?></td>
							<td class="text-right"><?= nilai($program->c_rpjm_5) ?> </td>
							<td class="text-right"><?= ($indikator->c_rpjm) ?></td>
							<td class="text-right"><?= ($program->c_rpjm) ?> </td>

							<td class="text-right"><?= ($indikator->rasio_rpjm) ?></td>
							<td class="text-right"><?= ($program->rasio_rpjm) ?> </td>
						</tr>			
					<?php else: ?>
						<tr>
							<td></td>
							<td></td>
							<td> </td>
							<td><?= $indikator->indikator ?> (<?=  $indikator->satuan ?>) </td>
							<td class="text-right"><?= ($indikator->r_rpjm_0) ?> </td>
							<td class="text-right"><?= ($indikator->t_rpjm_0) ?> </td>
							<td class="text-right"></td>
							<td class="text-right"><?= ($indikator->t_rpjm_1) ?></td>
							<td class="text-right"></td>
							<td class="text-right"><?= ($indikator->t_rpjm_2) ?></td>
							<td class="text-right"></td>
							<td class="text-right"><?= ($indikator->t_rpjm_3) ?></td>
							<td class="text-right"></td>
							<td class="text-right"><?= ($indikator->t_rpjm_4) ?></td>
							<td class="text-right"></td>
							<td class="text-right"><?= ($indikator->t_rpjm_5) ?></td>
							<td class="text-right"></td>

							<td class="text-right"><?= ($indikator->r_rpjm_1) ?></td>
							<td class="text-right"></td>
							<td class="text-right"><?= ($indikator->r_rpjm_2) ?></td>
							<td class="text-right"></td>
							<td class="text-right"><?= ($indikator->r_rpjm_3) ?></td>
							<td class="text-right"></td>
							<td class="text-right"><?= ($indikator->r_rpjm_4) ?></td>
							<td class="text-right"></td>
							<td class="text-right"><?= ($indikator->r_rpjm_5) ?></td>
							<td class="text-right"></td>

							<?php 
							// hitung rata2
							if ($indikator->c_rpjm_1 !== '' || $indikator->c_rpjm_1 != '-') {
								$rata_rata[1] [] = $indikator->c_rpjm_1;
								$rata_rata[2] [] = $indikator->c_rpjm_2;
								$rata_rata[3] [] = $indikator->c_rpjm_3;
								$rata_rata[4] [] = $indikator->c_rpjm_4;
								$rata_rata[5] [] = $indikator->c_rpjm_5;


								$rata_rata_tot [] = $indikator->rasio_rpjm;
								
							}
							?>

							<td class="text-right"><?= ($indikator->c_rpjm_1) ?></td>
							<td class="text-right"></td>
							<td class="text-right"><?= ($indikator->c_rpjm_2) ?></td>
							<td class="text-right"></td>
							<td class="text-right"><?= ($indikator->c_rpjm_3) ?></td>
							<td class="text-right"></td>
							<td class="text-right"><?= ($indikator->c_rpjm_4) ?></td>
							<td class="text-right"></td>
							<td class="text-right"><?= ($indikator->c_rpjm_5) ?></td>
							<td class="text-right"></td>
							<td class="text-right"><?= ($indikator->c_rpjm) ?></td>
							<td class="text-right"></td>
							<td class="text-right"><?= ($indikator->rasio_rpjm) ?></td>
							<td class="text-right"> </td>
						</tr>		
					<?php endif ?>
				<?php endforeach ?>		
			<?php endforeach ?>
		<?php endif ?>
		
	<?php endforeach ?>

	<tr>
		<td colspan="27" class="text-right">Rata-Rata Kinerja (%)</td>
		<td><?= nilai(array_sum($rata_rata[1])/count($rata_rata[1]) ) ?></td>
		<td><?= nilai(array_sum($rata_rata_keu[1])/count($rata_rata_keu[1]) ) ?></td>

		<td><?= nilai(array_sum($rata_rata[2])/count($rata_rata[2]) ) ?></td>
		<td><?= nilai(array_sum($rata_rata_keu[2])/count($rata_rata_keu[2]) ) ?></td>

		<td><?= nilai(array_sum($rata_rata[3])/count($rata_rata[3]) ) ?></td>
		<td><?= nilai(array_sum($rata_rata_keu[3])/count($rata_rata_keu[3]) ) ?></td>


		<td><?= nilai(array_sum($rata_rata[4])/count($rata_rata[4]) ) ?></td>
		<td><?= nilai(array_sum($rata_rata_keu[4])/count($rata_rata_keu[4]) ) ?></td>

		<td><?= nilai(array_sum($rata_rata[5])/count($rata_rata[5]) ) ?></td>
		<td><?= nilai(array_sum($rata_rata_keu[5])/count($rata_rata_keu[5]) ) ?></td>

		<td></td>
		<td></td>

		<td><?= nilai(array_sum($rata_rata_tot)/count($rata_rata_tot)) ?></td>
		<td><?= nilai(array_sum($rata_rata_keu_tot)/count($rata_rata_keu_tot)) ?></td>
		
	</tr>

	<tr>
		<td colspan="27" class="text-right">Predikat Kinerja</td>
		<td><?= predikat(array_sum($rata_rata[1])/count($rata_rata[1]) ) ?></td>
		<td><?= predikat(array_sum($rata_rata_keu[1])/count($rata_rata_keu[1]) ) ?></td>

		<td><?= predikat(array_sum($rata_rata[2])/count($rata_rata[2]) ) ?></td>
		<td><?= predikat(array_sum($rata_rata_keu[2])/count($rata_rata_keu[2]) ) ?></td>

		<td><?= predikat(array_sum($rata_rata[3])/count($rata_rata[3]) ) ?></td>
		<td><?= predikat(array_sum($rata_rata_keu[3])/count($rata_rata_keu[3]) ) ?></td>


		<td><?= predikat(array_sum($rata_rata[4])/count($rata_rata[4]) ) ?></td>
		<td><?= predikat(array_sum($rata_rata_keu[4])/count($rata_rata_keu[4]) ) ?></td>

		<td><?= predikat(array_sum($rata_rata[5])/count($rata_rata[5])) ?></td>
		<td><?= predikat(array_sum($rata_rata_keu[5])/count($rata_rata_keu[5])) ?></td>

		<td></td>
		<td></td>

		<td><?= predikat(array_sum($rata_rata_tot)/count($rata_rata_tot)) ?></td>
		<td><?= predikat(array_sum($rata_rata_keu_tot)/count($rata_rata_keu_tot)) ?></td>
		
	</tr>

	<tr>
		<td colspan="41">
			Faktor Pendorong Keberhasilan Pencapaian :
			<ul>
				<?php foreach ($pendorong as $key => $value): ?>
					<li><?= $value->pendorong ?></li>
				<?php endforeach ?>
				
			</ul>
		</td>
	</tr>

	<tr>
		<td colspan="41">
			Faktor Penghambat Pencapaian Kinerja :
			<ul>
				<?php foreach ($penghambat as $key => $value): ?>
					<li><?= $value->penghambat ?></li>
				<?php endforeach ?>
				
			</ul>
		</td>
	</tr>

	<tr>
		<td colspan="41">
			Tindak Lanjut yang Diperlukan dalam RKPD Kabupaten/Kota berikutnya :
			<ul>
				<?php foreach ($tl_rkpd as $key => $value): ?>
					<li><?= $value->tindak_lanjut ?></li>
				<?php endforeach ?>
				
			</ul>
		</td>
	</tr>
	<tr>
		<td colspan="41">
			Tindak Lanjut yang Diperlukan dalam RPJMD Kabupaten/Kota berikutnya :
			<ul>
				<?php foreach ($tl_rpjm as $key => $value): ?>
					<li><?= $value->tindak_lanjut ?></li>
				<?php endforeach ?>
				
			</ul>
		</td>
	</tr>
	<tr ><td class="noborder tc" colspan="41"> &nbsp;</td></tr>
	<tr>
		<td colspan="20" class="noborder tc"   align="center"></td>
		<td colspan="10" class="noborder tc"   align="center">
			Disusun
			<br>
			....................., Tanggal
			<br>
			Kepala BAPPEDA
			<br>
			Kabupaten Bojonegoro
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			(.........................................................................)

		</td>

		<td colspan="11" class="noborder tc"   align="center">
			Disetujui
			<br>
			....................., Tanggal
			<br>
			Gubernur
			<br>
			Provinsi Jawa Timur
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			(.........................................................................)

		</td>
	</tr>
</table>
</div>