<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 

$per_urusan = array_group_by($m_dpa, 'kode_urusan', 'kode_bidang','kode_opd','kode_program');
$per_outcome = array_group_by($m_outcome, 'kode_opd','kode_program');
$per_output = array_group_by($m_output, 'kode_opd','kode_kegiatan');
// echo "<pre>";
// print_r($per_urusan);
// die;

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
<table width="90%" border=1 cellspacing=0 cellpadding=3>
	<tr repeat=1>
		<td valign=middle align="center" rowspan="2">No</td>
		<td valign=middle align="center" rowspan="2">Sasaran</td>
		<td valign=middle align="center" rowspan="2">Kode</td>
		<td valign=middle width="20" align="center" rowspan="2">Urusan/Bidang Urusan Pemerintahan Daerah Dan Program/Kegiatan</td>
		<td valign=middle width="45" align="center" rowspan="2">Indikator Kinerja Program (outcome)/ Kegiatan (output)</td>
		<td valign=middle align="center" rowspan="2" colspan="2">Target Renstra Akhir Periode <?php echo $config->awal_renstra ?> - <?php echo $config->akhir_renstra ?></td>
		<td valign=middle align="center" rowspan="2" colspan="2">Realisasi Capaian Kinerja Renstra s/d Tahun Lalu</td>
		<td valign=middle align="center" rowspan="2" colspan="2">Target Kinerja dan Anggaran Renja Tahun Berjalan <?php echo $config->tahun ?></td>
		<td valign=middle align="center" colspan="8">Realisasi Kinerja Pada Triwulan</td>
		<td valign=middle align="center" rowspan="2" colspan="2">Realisasi Capaian Kinerja dan Anggaran Renja</td>
		<td valign=middle align="center" rowspan="2" colspan="2">Tingkat Capaian Kinerja dan Anggaran Renja Tahun <?php echo $config->tahun ?></td>
		<td valign=middle align="center" rowspan="2" colspan="2">Realisasi Kinerja dan Anggaran Renstra s/d Tahun <?php echo $config->tahun ?></td>
		<td valign=middle align="center" rowspan="2" colspan="2">Tingkat Capaian Kinerja dan Anggaran Renstra s/d Tahun <?php echo $config->tahun ?></td>
		<td valign=middle align="center" rowspan="2">Penanggung jawab</td>
	</tr>
	<tr repeat=1>
		<td valign=middle align="center" colspan="2">1</td>
		<td valign=middle align="center" colspan="2">2</td>
		<td valign=middle align="center" colspan="2">3</td>
		<td valign=middle align="center" colspan="2">4</td>
	</tr>
	<tr repeat=1>
		<td valign=middle align="center" rowspan="2">1</td>
		<td valign=middle align="center" rowspan="2">2</td>
		<td valign=middle align="center" colspan="2" rowspan="2">3</td>
		<td valign=middle align="center" rowspan="2">4</td>
		<td valign=middle align="center" colspan="2">5</td>
		<td valign=middle align="center" colspan="2">6</td>
		<td valign=middle align="center" colspan="2">7</td>
		<td valign=middle align="center" colspan="2">8</td>
		<td valign=middle align="center" colspan="2">9</td>
		<td valign=middle align="center" colspan="2">10</td>
		<td valign=middle align="center" colspan="2">11</td>
		<td valign=middle align="center" colspan="2">12</td>
		<td valign=middle align="center" colspan="2">13</td>
		<td valign=middle align="center" colspan="2">14</td>
		<td valign=middle align="center" colspan="2">15</td>
		<td valign=middle align="center" rowspan="2">16</td>
	</tr>
	<tr repeat=1>
		<td width="10" valign=middle align="center">k</td>
		<td width="14" valign=middle align="center">rp</td>
		<td width="10" valign=middle align="center">k</td>
		<td width="14" valign=middle align="center">rp</td>
		<td width="10" valign=middle align="center">k</td>
		<td width="14" valign=middle align="center">rp</td>
		<td width="10" valign=middle align="center">k</td>
		<td width="14" valign=middle align="center">rp</td>
		<td width="10" valign=middle align="center">k</td>
		<td width="14" valign=middle align="center">rp</td>
		<td width="10" valign=middle align="center">k</td>
		<td width="14" valign=middle align="center">rp</td>
		<td width="10" valign=middle align="center">k</td>
		<td width="14" valign=middle align="center">rp</td>
		<td width="10" valign=middle align="center">k</td>
		<td width="14" valign=middle align="center">rp</td>
		<td width="10" valign=middle align="center">k</td>
		<td width="14" valign=middle align="center">rp</td>
		<td width="10" valign=middle align="center">k</td>
		<td width="14" valign=middle align="center">rp</td>
		<td width="10" valign=middle align="center">k</td>
		<td width="14" valign=middle align="center">rp</td>
	</tr>

	<!-- START LOOP URUSAN -->
	<?php foreach ($per_urusan as $urusan => $per_bidang) :?>
		<tr bgcolor="#e5e5e5">
			<td></td>
			<td></td>
			<td><?php echo $urusan ?></td>
			<td colspan="25"><?php echo $master_urusan[$urusan] ?></td>
		</tr>
		<!-- START LOOP BIDANG -->
		<?php foreach ($per_bidang as $bidang => $per_opd) :?>
			<tr bgcolor="#f5f5f5">
				<td></td>
				<td></td>
				<td><?php echo $bidang ?></td>
				<td colspan="25"><?php echo $master_bidang[$bidang] ?></td>
			</tr>
			<!-- START LOOP OPD -->
			<?php foreach ($per_opd as $opd => $per_program) :?>
				<tr>
					<td></td>
					<td></td>
					<td><?php echo $opd ?></td>
					<td colspan="25"><?php echo $master_opd[$opd] ?></td>
				</tr>
				<!-- START LOOP PROGRAM -->
				<?php foreach ($per_program as $program => $per_kegiatan) :?>
					<tr>
						<td></td>
						<td></td>
						<td><?php echo $program ?></td>
						<td><?php echo $master_program[$program] ?></td>
						<td>
							<?php echo $per_outcome[$opd][$program][0]['indikator'] ?>
							 ( <?php echo $per_outcome[$opd][$program][0]['satuan'] ?> )	
						</td>
						<td>
							<?php echo nilai($per_outcome[$opd][$program][0]['target_renstra']) ?>
						</td>
						<td>
							<?php echo array_sum(array_column($per_kegiatan,'target_renstra')) ?>
						</td>
						<td>
							<?php echo nilai($per_outcome[$opd][$program][0]['realisasi_renstra']) ?>
						</td>
						<td>
							<?php echo array_sum(array_column($per_kegiatan,'realisasi_renstra')) ?>
						</td>
						<td>
							<?php echo nilai($per_outcome[$opd][$program][0]['target_tahunan']) ?>
						</td>
						<td>
							<?php echo array_sum(array_column($per_kegiatan,'pagu_kegiatan')) ?>
						</td>
						<td>
							<?php echo nilai($per_outcome[$opd][$program][0]['realisasi_tw1']) ?>
						</td>
						<td>
							<?php echo array_sum(array_column($per_kegiatan,'realisasi_tw1')) ?>
						</td>
						<td>
							<?php echo nilai($per_outcome[$opd][$program][0]['realisasi_tw2']) ?>
						</td>
						<td>
							<?php echo array_sum(array_column($per_kegiatan,'realisasi_tw2')) ?>
						</td>
						<td>
							<?php echo nilai($per_outcome[$opd][$program][0]['realisasi_tw3']) ?>
						</td>
						<td>
							<?php echo array_sum(array_column($per_kegiatan,'realisasi_tw3')) ?>
						</td>
						<td>
							<?php echo nilai($per_outcome[$opd][$program][0]['realisasi_tw4']) ?>
						</td>
						<td>
							<?php echo array_sum(array_column($per_kegiatan,'realisasi_tw4')) ?>
						</td>
					</tr>
					<!-- START LOOP BIDANG -->
					<?php foreach ($per_kegiatan as $dpa) :?>
						<tr bgcolor="#e5e5e5">
							<td></td>
							<td></td>
							<td><?php echo $dpa['kode_kegiatan'] ?></td>
							<td colspan="25"><?php echo $dpa['nama_kegiatan'] ?></td>
						</tr>
					<?php endforeach ?>
					<!-- END BIDANG -->
				<?php endforeach ?>
				<!-- END PROGRAM -->
			<?php endforeach ?>
			<!-- END OPD -->
		<?php endforeach ?>
		<!-- END BIDANG -->
	<?php endforeach ?>
	<!-- END URUSAN -->



	<?php die; ?>
	<?php foreach ($keuangan['urusan'] as $val_urusan) : ?>
		<tr bgcolor="#e5e5e5">
			<td></td>
			<td></td>
			<td><?php echo $val_urusan->kd_urusan1 ?></td>
			<td colspan="25"><?php echo $val_urusan->nm_urusan ?></td>
		</tr>
		<?php foreach ($keuangan['bidang'] as $val_bidang): ?>
			<?php if ($val_urusan->kd_urusan1 == $val_bidang->kd_urusan1 ): ?>
				<tr bgcolor="#f0f0f0">
					<td></td>
					<td></td>
					<td><?php echo $val_bidang->kd_urusan1 . '.' . $val_bidang->kd_bidang1 ?></td>
					<td colspan="25"><?php echo $val_bidang->nm_bidang ?></td>
				</tr>
				<!-- Program Start -->
				<?php foreach ($keuangan['program'] as $val_program): ?>
					<?php  
						$keterangan = $CI->bantuan->ket_program($val_program->kode_opd,$val_program->kode_program);
						$indi_program = $CI->bantuan->indi_program($val_program->kode_opd,$val_program->kode_program, $periode);
						// $predikatOutput = $CI->bantuan->avgKinerjaOutput($val_program->kode_opd,$val_program->kode_program, $periode);
						$rataOutputPeriode = [];// dd($predikatOutput);
						$rataOutputRenstra = [];// dd($predikatOutput);
						$rataUangPeriode = [];// dd($predikatUang);
						$rataUangRenstra = [];// dd($predikatOutput);
					?>
					<?php if (
						$val_bidang->kd_urusan1 == $val_program->kd_urusan1 &&
						$val_bidang->kd_bidang1 == $val_program->kd_bidang1
					): $no++;?>
						<?php if ($val_program->jml_indi > 1 ): ?>
							<tr>
								<td rowspan="<?php echo $val_program->jml_indi ?>"><?php echo $no; ?></td>
								<td rowspan="<?php echo $val_program->jml_indi ?>"><?php echo $keterangan->sasaran ?></td>
								<td rowspan="<?php echo $val_program->jml_indi ?>"><?php echo $val_program->kode_program ?></td>
								<td rowspan="<?php echo $val_program->jml_indi ?>"><?php echo $val_program->nm_program ?></td>
								<td><?php echo $indi_program[0]->indikator ?> (<?php echo $indi_program[0]->satuan ?>)</td>
								<td><?php echo $indi_program[0]->target_renstra ?></td>
								<td rowspan="<?php echo $val_program->jml_indi ?>"><?php echo rpXls($val_program->target_renstra) ?></td>
								<td><?php echo $indi_program[0]->realisasi_renstra ?></td>
								<td rowspan="<?php echo $val_program->jml_indi ?>"><?php echo rpXls($val_program->realisasi_renstra) ?></td>
								<td><?php echo nilai($indi_program[0]->target_tahunan) ?></td>
								<td rowspan="<?php echo $val_program->jml_indi ?>"><?php echo rpXls($val_program->pagu_anggaran) ?></td>
								<td><?php echo $periode > 0 ? nilai($indi_program[0]->realisasi_tw1) : '' ?></td>
								<td rowspan="<?php echo $val_program->jml_indi ?>"><?php echo rpXls($val_program->realisasi_tw1) ?></td>
								<td><?php echo $periode > 1 ? nilai($indi_program[0]->realisasi_tw2) : '' ?></td>
								<td rowspan="<?php echo $val_program->jml_indi ?>"><?php echo rpXls($val_program->realisasi_tw2) ?></td>
								<td><?php echo $periode > 2 ? nilai($indi_program[0]->realisasi_tw3) : '' ?></td>
								<td rowspan="<?php echo $val_program->jml_indi ?>"><?php echo rpXls($val_program->realisasi_tw3) ?></td>
								<td><?php echo $periode > 3 ? nilai($indi_program[0]->realisasi_tw4) :'' ?></td>
								<td rowspan="<?php echo $val_program->jml_indi ?>"><?php echo rpXls($val_program->realisasi_tw4) ?></td>
								<td><?php echo nilai($indi_program[0]->realisasi_tahunan);?></td>
								<td rowspan="<?php echo $val_program->jml_indi ?>"><?php echo nilai($val_program->realisasi_tahunan);?></td>
								<td><?php echo persen(($indi_program[0]->realisasi_tahunan/$indi_program[0]->target_tahunan)*100) ?></td>
								<td rowspan="<?php echo $val_program->jml_indi ?>"><?php echo persen(($val_program->realisasi_tahunan/$val_program->pagu_anggaran)*100)?></td>
								<td><?php echo nilai($indi_program[0]->realisasi_tahunan + $indi_program[0]->realisasi_renstra) ?></td>
								<td rowspan="<?php echo $val_program->jml_indi ?>"><?php echo rpXls($val_program->realisasi_tahunan + $val_program->realisasi_renstra)?></td>
								<td><?php echo persen((($indi_program[0]->realisasi_tahunan + $indi_program[0]->realisasi_renstra)/$indi_program[0]->target_renstra) * 100);?></td>
								<td rowspan="<?php echo $val_program->jml_indi ?>"><?php echo persen((($val_program->realisasi_tahunan + $val_program->realisasi_renstra) / $val_program->target_renstra)*100);?></td>
								<td><?php echo $indi_program[0]->penanggung_jawab ?></td>
							</tr>
							<?php foreach ($indi_program as $key => $indi_programs): ?>
								<?php if ($key > 0 ): ?>
									<tr>
										<td><?php echo $indi_programs->indikator ?> (<?php echo $indi_programs->satuan ?>)</td>
										<td><?php echo nilai($indi_programs->target_renstra) ?></td>
										<td><?php echo nilai($indi_programs->realisasi_renstra) ?></td>
										<td><?php echo $indi_programs->target_tahunan ?></td>
										<td><?php echo $periode > 0 ? nilai($indi_programs->realisasi_tw1) : '' ?></td>
										<td><?php echo $periode > 1 ? nilai($indi_programs->realisasi_tw2) : '' ?></td>
										<td><?php echo $periode > 2 ? nilai($indi_programs->realisasi_tw3) : '' ?></td>
										<td><?php echo $periode > 3 ? nilai($indi_programs->realisasi_tw4) : '' ?></td>
										<td><?php echo nilai($indi_programs->realisasi_tahunan);?></td>
										<td><?php echo persen(($indi_programs->realisasi_tahunan/$indi_programs->target_tahunan)*100);?></td>
										<td><?php echo nilai($indi_programs->realisasi_tahunan + $indi_programs->realisasi_renstra);?></td>
										<td><?php echo persen((($indi_programs->realisasi_tahunan + $indi_programs->realisasi_renstra)/$indi_programs->target_renstra) * 100);?></td>
										<td><?php echo $indi_programs->penanggung_jawab ?></td>
									</tr>
								<?php endif ?>
							<?php endforeach ?>
						<?php else: ?>	
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $keterangan->sasaran ?></td>
								<td><?php echo $val_program->kode_program ?></td>
								<td><?php echo $val_program->nm_program ?></td>
								<td><?php echo $indi_program[0]->indikator ?> (<?php echo $indi_program[0]->satuan ?>)</td>
								<td><?php echo nilai($indi_program[0]->target_renstra) ?></td>
								<td><?php echo rpXls($val_program->target_renstra) ?></td>
								<td><?php echo nilai($indi_program[0]->realisasi_renstra) ?></td>
								<td><?php echo rpXls($val_program->realisasi_renstra) ?></td>
								<td><?php echo nilai($indi_program[0]->target_tahunan) ?></td>
								<td><?php echo rpXls($val_program->pagu_anggaran) ?></td>
								<td><?php echo $periode > 0 ?nilai($indi_program[0]->realisasi_tw1) : '' ?></td>
								<td><?php echo rpXls($val_program->realisasi_tw1) ?></td>
								<td><?php echo $periode > 1 ? nilai($indi_program[0]->realisasi_tw2) : '' ?></td>
								<td><?php echo rpXls($val_program->realisasi_tw2) ?></td>
								<td><?php echo $periode > 2 ? nilai($indi_program[0]->realisasi_tw3) : ''?></td>
								<td><?php echo rpXls($val_program->realisasi_tw3) ?></td>
								<td><?php echo $periode > 3 ? nilai($indi_program[0]->realisasi_tw4) :''?></td>
								<td><?php echo rpXls($val_program->realisasi_tw4) ?></td>
								<td><?php echo nilai($indi_program[0]->realisasi_tahunan);?></td>
								<td><?php echo nilai($val_program->realisasi_tahunan);?></td>
								<td><?php echo persen(($indi_program[0]->realisasi_tahunan/$indi_program[0]->target_tahunan)*100);?></td>
								<td><?php echo persen(($val_program->realisasi_tahunan/$val_program->pagu_anggaran)*100)?>	</td>
								<td><?php echo nilai($indi_program[0]->realisasi_tahunan + $indi_program[0]->realisasi_renstra);?></td>
								<td><?php echo rpXls($val_program->realisasi_tahunan + $val_program->realisasi_renstra);	?></td>
								<td><?php echo persen((($indi_program[0]->realisasi_tahunan + $indi_program[0]->realisasi_renstra)/$indi_program[0]->target_renstra) * 100);?></td>
								<td><?php echo persen((($val_program->realisasi_tahunan + $val_program->realisasi_renstra) / $val_program->target_renstra)*100);?></td>
								<td><?php echo $indi_program[0]->penanggung_jawab ?></td>
							</tr>	
						<?php endif ?>
						<!-- Kegiatan Start -->
						<?php foreach ($keuangan['kegiatan'] as $val_kegiatan): ?>
							<?php  
								$indi_kegiatan = $CI->bantuan->indi_kegiatan($val_kegiatan->kode_opd,$val_kegiatan->kode_kegiatan,$periode);
							?>

							<?php if (
								$val_program->kd_urusan1 == $val_kegiatan->kd_urusan1 &&
								$val_program->kd_bidang1 == $val_kegiatan->kd_bidang1 &&
								$val_program->kd_program == $val_kegiatan->kd_program
								
							):  ?>
								<?php if ($val_kegiatan->jml_indi > 1 ): ?>
									<tr>
										<td rowspan="<?php echo $val_kegiatan->jml_indi ?>"></td>
										<td rowspan="<?php echo $val_kegiatan->jml_indi ?>"></td>
										<td rowspan="<?php echo $val_kegiatan->jml_indi ?>"><?php echo $val_kegiatan->kode_kegiatan ?></td>
										<td rowspan="<?php echo $val_kegiatan->jml_indi ?>"><?php echo $val_kegiatan->nm_kegiatan ?></td>
										<td><?php echo $indi_kegiatan[0]->indikator ?> (<?php echo $indi_kegiatan[0]->satuan ?>)</td>
										<td><?php echo nilai($indi_kegiatan[0]->target_renstra) ?></td>
										<td rowspan="<?php echo $val_kegiatan->jml_indi ?>"><?php echo rpXls($val_kegiatan->target_renstra) ?></td>
										<td><?php echo nilai($indi_kegiatan[0]->realisasi_renstra) ?></td>
										<td rowspan="<?php echo $val_kegiatan->jml_indi ?>"><?php echo rpXls($val_kegiatan->realisasi_renstra) ?></td>
										<td><?php echo $indi_kegiatan[0]->target_tahunan ?></td>
										<td rowspan="<?php echo $val_kegiatan->jml_indi ?>"><?php echo rpXls($val_kegiatan->pagu_anggaran) ?></td>
										<td><?php echo $periode > 0 ? nilai($indi_kegiatan[0]->realisasi_tw1) : ''?></td>
										<td rowspan="<?php echo $val_kegiatan->jml_indi ?>"><?php echo rpXls($val_kegiatan->realisasi_tw1) ?></td>
										<td><?php echo $periode > 1 ? nilai($indi_kegiatan[0]->realisasi_tw2) : ''?></td>
										<td rowspan="<?php echo $val_kegiatan->jml_indi ?>"><?php echo rpXls($val_kegiatan->realisasi_tw2) ?></td>
										<td><?php echo $periode > 2 ? nilai($indi_kegiatan[0]->realisasi_tw3) : '' ?></td>
										<td rowspan="<?php echo $val_kegiatan->jml_indi ?>"><?php echo rpXls($val_kegiatan->realisasi_tw3) ?></td>
										<td><?php echo $periode > 3 ? nilai($indi_kegiatan[0]->realisasi_tw4) : '' ?></td>
										<td rowspan="<?php echo $val_kegiatan->jml_indi ?>"><?php echo rpXls($val_kegiatan->realisasi_tw4) ?></td>
										<td><?php echo nilai($indi_kegiatan[0]->realisasi_tahunan);?></td>
										<td rowspan="<?php echo $val_kegiatan->jml_indi ?>"><?php echo nilai($val_kegiatan->realisasi_tahunan);?></td>
										<td><?php echo persen(($indi_kegiatan[0]->realisasi_tahunan/$indi_kegiatan[0]->target_tahunan)*100);?></td>
										<td rowspan="<?php echo $val_kegiatan->jml_indi ?>"><?php echo persen(($val_kegiatan->realisasi_tahunan/$val_kegiatan->pagu_anggaran)*100);?></td>
										<td><?php echo nilai($indi_kegiatan[0]->realisasi_tahunan+$indi_kegiatan[0]->realisasi_renstra);?></td>
										<td rowspan="<?php echo $val_kegiatan->jml_indi ?>"><?php echo rpXls($val_kegiatan->realisasi_tahunan + $val_kegiatan->realisasi_renstra);?></td>
										<td><?php echo persen((($indi_kegiatan[0]->realisasi_tahunan+$indi_kegiatan[0]->realisasi_renstra)/$indi_kegiatan[0]->target_renstra) * 100);?></td>
										<td rowspan="<?php echo $val_kegiatan->jml_indi ?>"><?php echo persen((($val_kegiatan->realisasi_tw1 + $val_kegiatan->realisasi_renstra) / $val_kegiatan->target_renstra)*100);?></td>
										<td><?php echo $indi_kegiatan[0]->penanggung_jawab ?></td>
									</tr>
									<?php array_push($rataUangPeriode, (($val_kegiatan->realisasi_tahunan/$val_kegiatan->pagu_anggaran)*100)) ?>
									<?php array_push($rataOutputPeriode, (($indi_kegiatan[0]->realisasi_tahunan/$indi_kegiatan[0]->target_tahunan)*100)) ?>
									<?php array_push($rataUangRenstra, ((($val_kegiatan->realisasi_tw1 + $val_kegiatan->realisasi_renstra) / $val_kegiatan->target_renstra)*100)) ?>
									<?php array_push($rataOutputRenstra, ((($indi_kegiatan[0]->realisasi_tahunan+$indi_kegiatan[0]->realisasi_renstra)/$indi_kegiatan[0]->target_renstra) * 100)) ?>
									<?php foreach ($indi_kegiatan as $key => $indi_kegiatans): ?>
										<?php if ($key > 0 ): ?>

											<?php array_push($rataOutputPeriode, (($indi_kegiatans->realisasi_tahunan/$indi_kegiatans->target_tahunan)*100)) ?>
											<?php array_push($rataOutputRenstra, ((($indi_kegiatans->realisasi_tahunan+$indi_kegiatans->realisasi_renstra)/$indi_kegiatans->target_renstra) * 100)) ?>
											<tr>
												<td><?php echo $indi_kegiatans->indikator ?> (<?php echo $indi_kegiatans->satuan ?>)</td>
												<td><?php echo nilai($indi_kegiatans->target_renstra) ?></td>
												<td><?php echo $indi_kegiatans->target_tahunan ?></td>
												<td><?php echo $periode > 0 ? nilai($indi_kegiatans->realisasi_tw1) : '' ?></td>
												<td><?php echo $periode > 1 ? nilai($indi_kegiatans->realisasi_tw2) : '' ?></td>
												<td><?php echo $periode > 2 ? nilai($indi_kegiatans->realisasi_tw3) : '' ?></td>
												<td><?php echo $periode > 3 ? nilai($indi_kegiatans->realisasi_tw4) : '' ?></td>
												<td><?php echo nilai($indi_kegiatans->realisasi_tahunan);?></td>
												<td><?php echo nilai(($indi_kegiatans->realisasi_tahunan/$indi_kegiatans->target_tahunan)*100);?></td>
												<td><?php echo nilai($indi_kegiatans->realisasi_tahunan+$indi_kegiatans->realisasi_renstra);?></td>
												<td><?php echo nilai((($indi_kegiatans->realisasi_tahunan+$indi_kegiatans->realisasi_renstra)/$indi_kegiatans->target_renstra)*100);?></td>
												<td><?php echo $indi_kegiatans->penanggung_jawab ?></td>
											</tr>
										<?php endif ?>
									<?php endforeach ?>
								<?php else: ?>	
									<tr>
										<td></td>
										<td></td>
										<td><?php echo $val_kegiatan->kode_kegiatan ?></td>
										<td><?php echo $val_kegiatan->nm_kegiatan ?></td>
										<td><?php echo $indi_kegiatan[0]->indikator ?> (<?php echo $indi_kegiatan[0]->satuan ?>)</td>
										<td><?php echo nilai($indi_kegiatan[0]->target_renstra) ?></td>
										<td><?php echo rpXls($val_kegiatan->target_renstra) ?></td>
										<td><?php echo nilai($indi_kegiatan[0]->realisasi_renstra) ?></td>
										<td><?php echo rpXls($val_kegiatan->realisasi_renstra) ?></td>
										<td><?php echo $indi_kegiatan[0]->target_tahunan ?></td>
										<td><?php echo rpXls($val_kegiatan->pagu_anggaran) ?></td>
										<td><?php echo $periode > 0 ? nilai($indi_kegiatan[0]->realisasi_tw1) : ''?></td>
										<td><?php echo rpXls($val_kegiatan->realisasi_tw1) ?></td>
										<td><?php echo $periode > 1 ? nilai($indi_kegiatan[0]->realisasi_tw2) : ''?></td>
										<td><?php echo rpXls($val_kegiatan->realisasi_tw2) ?></td>
										<td><?php echo $periode > 2 ? nilai($indi_kegiatan[0]->realisasi_tw3) : '' ?></td>
										<td><?php echo rpXls($val_kegiatan->realisasi_tw3) ?></td>
										<td><?php echo $periode > 3 ? nilai($indi_kegiatan[0]->realisasi_tw4) : '' ?></td>
										<td><?php echo rpXls($val_kegiatan->realisasi_tw4) ?></td>
										<td><?php echo nilai($indi_kegiatan[0]->realisasi_tahunan);?></td>
										<td><?php echo nilai($val_kegiatan->realisasi_tahunan);?></td>
										<td><?php echo persen(($indi_kegiatan[0]->realisasi_tahunan/$indi_kegiatan[0]->target_tahunan)*100);?></td>
										<td><?php echo persen(($val_kegiatan->realisasi_tahunan/$val_kegiatan->pagu_anggaran)*100);?></td>
										<td><?php echo nilai($indi_kegiatan[0]->realisasi_tahunan+$indi_kegiatan[0]->realisasi_renstra);?></td>
										<td><?php echo rpXls($val_kegiatan->realisasi_tahunan + $val_kegiatan->realisasi_renstra);?></td>
										<td><?php echo persen((($indi_kegiatan[0]->realisasi_tahunan+$indi_kegiatan[0]->realisasi_renstra)/$indi_kegiatan[0]->target_renstra) * 100);?></td>
										<td><?php echo persen((($val_kegiatan->realisasi_tw1 + $val_kegiatan->realisasi_renstra) / $val_kegiatan->target_renstra)*100);?></td>
										<td><?php echo $indi_kegiatan[0]->penanggung_jawab ?></td>
									</tr>	
									<?php array_push($rataUangPeriode, (($val_kegiatan->realisasi_tahunan/$val_kegiatan->pagu_anggaran)*100)) ?>
									<?php array_push($rataOutputPeriode, (($indi_kegiatan[0]->realisasi_tahunan/$indi_kegiatan[0]->target_tahunan)*100)) ?>
									<?php array_push($rataUangRenstra, ((($val_kegiatan->realisasi_tw1 + $val_kegiatan->realisasi_renstra) / $val_kegiatan->target_renstra)*100)) ?>
									<?php array_push($rataOutputRenstra, ((($indi_kegiatan[0]->realisasi_tahunan+$indi_kegiatan[0]->realisasi_renstra)/$indi_kegiatan[0]->target_renstra) * 100)) ?>
								<?php endif ?>
								
								
							<?php endif ?>		
						<?php endforeach ?>

						<!-- Kegiatan END -->
						<tr>
							<td align="right" colspan="21">
								Rata-rata Capaian Kinerja
							</td>
							<td><?php echo persen(array_sum($rataOutputPeriode)/count($rataOutputPeriode)); ?></td>
							<td><?php echo persen(array_sum($rataUangPeriode)/count($rataUangPeriode)); ?></td>
							<td colspan="2"></td>
							<td><?php echo persen(array_sum($rataOutputRenstra)/count($rataOutputRenstra)); ?></td>
							<td><?php echo persen(array_sum($rataUangRenstra)/count($rataUangRenstra)); ?></td>
							<td></td>
						</tr>
						<tr>
							<td align="right" colspan="21">Predikat Kinerja</td>
							<td><?php echo predikat(array_sum($rataOutputPeriode)/count($rataOutputPeriode)); ?></td>
							<td><?php echo predikat(array_sum($rataUangPeriode)/count($rataUangPeriode)); ?></td>
							<td colspan="2"></td>
							<td><?php echo predikat(array_sum($rataOutputRenstra)/count($rataOutputRenstra)); ?></td>
							<td><?php echo predikat(array_sum($rataUangRenstra)/count($rataUangRenstra)); ?></td>
							<td></td>
						</tr>
					<?php endif ?>		
				<?php endforeach ?>
				<!-- Program END -->		
			<?php endif ?>		
		<?php endforeach ?>		
	<?php endforeach ?>

	<tr>
		<td border=0 colspan="28"></td>
	</tr>

	<?php
		$target_program = array_sum(array_map(
            function($element){
                return $element->pagu_anggaran;
            }, 
        $keuangan['program']));
		$realisasi_program1 = array_sum(array_map(
            function($element){
                return $element->realisasi_tw1;
            }, 
        $keuangan['program']));
		$realisasi_program2 = array_sum(array_map(
            function($element){
                return $element->realisasi_tw2;
            }, 
        $keuangan['program']));
		$realisasi_program3 = array_sum(array_map(
            function($element){
                return $element->realisasi_tw3;
            }, 
        $keuangan['program']));
		$realisasi_program4 = array_sum(array_map(
            function($element){
                return $element->realisasi_tw4;
            }, 
        $keuangan['program']));
		$realisasi_program = array_sum(array_map(
            function($element){
                return $element->realisasi_tahunan;
            }, 
        $keuangan['program']));
	?>

	<tr>
		<td align="right" colspan="10">JUMLAH ANGGARAN DAN REALISASI DARI SELURUH PROGRAM</td>
		<td><?php echo nilai($target_program); ?></td>
		<td bgcolor="#333333"></td>
		<td><?php echo nilai($realisasi_program1); ?></td>
		<td bgcolor="#333333"></td>
		<td><?php echo nilai($realisasi_program2); ?></td>
		<td bgcolor="#333333"></td>
		<td><?php echo nilai($realisasi_program3); ?></td>
		<td bgcolor="#333333"></td>
		<td><?php echo nilai($realisasi_program4); ?></td>
		<td bgcolor="#333333"></td>
		<td><?php echo nilai($realisasi_program); ?></td>
		<td colspan="7" bgcolor="#333333"></td>
	</tr>
	<tr>
		<td align="right" colspan="21">
			TOTAL RATA-RATA CAPAIAN KINERJA DAN ANGGARAN DARI SELURUH PROGRAM (PROGRAM 1 s.d. PROGRAM <?php echo $no; ?>)
		</td>
		<td><?php echo persens(array_sum($rataOutputPeriode)/count($rataOutputPeriode)); ?></td>
		<td><?php echo persens(array_sum($rataUangPeriode)/count($rataUangPeriode)); ?></td>
		<td colspan="2"></td>
		<td><?php echo persens(array_sum($rataOutputRenstra)/count($rataOutputRenstra)); ?></td>
		<td><?php echo persens(array_sum($rataUangRenstra)/count($rataUangRenstra)); ?></td>
		<td></td>
	</tr>
	<tr>
		<td align="right" colspan="21">PREDIKAT KINERJA DARI SELURUH PROGRAM (PROGRAM 1 s.d. PROGRAM <?php echo $no; ?>)</td>
		<td><?php echo predikat(array_sum($rataOutputPeriode)/count($rataOutputPeriode)); ?></td>
		<td><?php echo predikat(array_sum($rataUangPeriode)/count($rataUangPeriode)); ?></td>
		<td colspan="2"></td>
		<td><?php echo predikat(array_sum($rataOutputRenstra)/count($rataOutputRenstra)); ?></td>
		<td><?php echo predikat(array_sum($rataUangRenstra)/count($rataUangRenstra)); ?></td>
		<td></td>
	</tr>

	<tr>
		<td border=0 colspan="28"></td>
	</tr>
	<tr>
		<td border=0 colspan="9" align="center">
			<br>
			Verifikator
			<br>
			<?php echo strtoupper($config->jabatan) ?>
			<br>
			<br>
			<br>
			<br>
			<?php echo strtoupper($config->nama) ?><br>
			<?php echo strtoupper($config->nip) ?>
		</td>
		<td border=0 colspan="19" align="center">
			<?php echo strtoupper($config->klien) . ", " . tgl_indo(date_format($tanggal, "Y-m-d H:i:s")) ?>
			<br>
			<?php //echo strtoupper($ref_opd->nm_sub_unit) ?><br>
			<?php echo strtoupper($ref_opd->jabatan) ?>
			<br>
			<br>
			<br>
			<br>
			<?php echo strtoupper($ref_opd->nama) ?><br>
			<?php echo strtoupper($ref_opd->nip) ?>
		</td>
	</tr>
</table>