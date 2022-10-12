<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- START LOOP PROGRAM -->
<?php foreach ($per_program as $program => $per_kegiatan) :?>
	<?php $nomor_program++?>
	<?php $kd_program = explode('.', $program ) ?>
	<?php $jml_outcome = count($per_outcome[$opd][$program]);if ( $jml_outcome> 1) :?>
	<tr bgcolor="#FBE9E7">
		<td><?php echo $nomor_program ?></td>
		<td><?= $per_outcome[$opd][$program] [0] ['sasaran']?></td>
		<td><?= $kd_program[0] ?></td>
		<td><?= $kd_program[1] ?></td>
		<td><?= $kd_program[2] ?></td>
		<td></td>
		<td width=15><?php echo $master_program[$program] ?></td>
		<td width=20>
			<?php echo $per_outcome[$opd][$program][0]['indikator'] ?>
			 (<?php echo $per_outcome[$opd][$program][0]['satuan'] ?>)	
		</td>
		<td width=10>
			<?php echo nilai($per_outcome[$opd][$program][0]['target_renstra']) ?>
		</td>
		<td width=13>
			<?php echo uang(array_sum(array_column($per_kegiatan,'target_renstra'))) ?>
		</td>
		<td width=10>
			<?php echo nilai($per_outcome[$opd][$program][0]['realisasi_renstra']) ?>
		</td>
		<td width=13>
			<?php echo uang(array_sum(array_column($per_kegiatan,'realisasi_renstra'))) ?>
		</td>
		<td width=10>
			<?php echo nilai($per_outcome[$opd][$program][0]['target_tahunan']) ?>
		</td>
		<td width=13>
			<?php echo uang(array_sum(array_column($per_kegiatan,'pagu_kegiatan'))) ?>
		</td>
		<td>
			<?php echo $tw > 0 ? nilai($per_outcome[$opd][$program][0]['realisasi_tw1']) : '' ?>
		</td>
		<td>
			<?php echo $tw > 0 ? uang(array_sum(array_column($per_kegiatan,'realisasi_tw1'))) :''?>
		</td>
		<td>
			<?php echo $tw > 1 ? nilai($per_outcome[$opd][$program][0]['realisasi_tw2']) : ''?>
		</td>
		<td>
			<?php echo $tw > 1 ? uang(array_sum(array_column($per_kegiatan,'realisasi_tw2'))) :''?>
		</td>
		<td>
			<?php echo $tw > 2 ? nilai($per_outcome[$opd][$program][0]['realisasi_tw3']) : ''?>
		</td>
		<td>
			<?php echo $tw > 2 ? uang(array_sum(array_column($per_kegiatan,'realisasi_tw3'))) : '' ?>
		</td>
		<td>
			<?php echo $tw > 3 ? nilai($per_outcome[$opd][$program][0]['realisasi_tw4']) : '' ?>
		</td>
		<td>
			<?php echo $tw > 3 ? uang(array_sum(array_column($per_kegiatan,'realisasi_tw4'))) : '' ?>
		</td>
		<td width=10>
			<?php echo nilai($per_outcome[$opd][$program][0]["realisasi_th$tw"]) ?>
		</td>
		<td width=13>
			<?php echo uang(array_sum(array_column($per_kegiatan,"realisasi_th$tw"))) ?>
		</td>
		<td>
			<?php echo persentase($per_outcome[$opd][$program][0]["realisasi_th$tw"],$per_outcome[$opd][$program][0]['target_tahunan']) ?>
		</td>
		<td width=10>
			<?php echo persentase(array_sum(array_column($per_kegiatan,"realisasi_th$tw")), array_sum(array_column($per_kegiatan,'pagu_kegiatan'))) ?>
		</td>
		<td width=10>
			<?php echo nilai($per_outcome[$opd][$program][0]["realisasi_th$tw"]+$per_outcome[$opd][$program][0]['realisasi_renstra']) ?>
		</td>
		<td width=13>
			<?php echo uang(array_sum(array_column($per_kegiatan,"realisasi_th$tw")) + array_sum(array_column($per_kegiatan,'realisasi_renstra'))) ?>
		</td>
		<td>
			<?php echo persentase(($per_outcome[$opd][$program][0]["realisasi_th$tw"]+$per_outcome[$opd][$program][0]['realisasi_renstra']),$per_outcome[$opd][$program][0]['target_renstra']) ?>
		</td>
		<td>
			<?php echo persentase((array_sum(array_column($per_kegiatan,"realisasi_th$tw")) + array_sum(array_column($per_kegiatan,'realisasi_renstra'))), array_sum(array_column($per_kegiatan,'target_renstra'))) ?>
		</td>
	</tr>
	<?php else: ?>
	<tr bgcolor="#FBE9E7">
		<td><?php echo $nomor_program ?></td>
		
		<td><?= $per_outcome[$opd][$program] [0] ['sasaran']?></td>
		<td><?= $kd_program[0] ?></td>
		<td><?= $kd_program[1] ?></td>
		<td><?= $kd_program[2] ?></td>
		<td></td>
		<td width=15><?php echo $master_program[$program] ?></td>
		<td width=20>
			<?php echo $per_outcome[$opd][$program][0]['indikator'] ?>
			 ( <?php echo $per_outcome[$opd][$program][0]['satuan'] ?> )	
		</td>
		<td width=10>
			<?php echo nilai($per_outcome[$opd][$program][0]['target_renstra']) ?>
		</td>
		<td width=13>
			<?php echo uang(array_sum(array_column($per_kegiatan,'target_renstra'))) ?>
		</td>
		<td width=10>
			<?php echo nilai($per_outcome[$opd][$program][0]['realisasi_renstra']) ?>
		</td>
		<td width=13>
			<?php echo uang(array_sum(array_column($per_kegiatan,'realisasi_renstra'))) ?>
		</td>
		<td width=10>
			<?php echo nilai($per_outcome[$opd][$program][0]['target_tahunan']) ?>
		</td>
		<td width=13>
			<?php echo uang(array_sum(array_column($per_kegiatan,'pagu_kegiatan'))) ?>
		</td>
		<td>
			<?php echo $tw > 0 ? nilai($per_outcome[$opd][$program][0]['realisasi_tw1']) : '' ?>
		</td>
		<td>
			<?php echo $tw > 0 ? uang(array_sum(array_column($per_kegiatan,'realisasi_tw1'))) :''?>
		</td>
		<td>
			<?php echo $tw > 1 ? nilai($per_outcome[$opd][$program][0]['realisasi_tw2']) : ''?>
		</td>
		<td>
			<?php echo $tw > 1 ? uang(array_sum(array_column($per_kegiatan,'realisasi_tw2'))) :''?>
		</td>
		<td>
			<?php echo $tw > 2 ? nilai($per_outcome[$opd][$program][0]['realisasi_tw3']) : ''?>
		</td>
		<td>
			<?php echo $tw > 2 ? uang(array_sum(array_column($per_kegiatan,'realisasi_tw3'))) : '' ?>
		</td>
		<td>
			<?php echo $tw > 3 ? nilai($per_outcome[$opd][$program][0]['realisasi_tw4']) : '' ?>
		</td>
		<td>
			<?php echo $tw > 3 ? uang(array_sum(array_column($per_kegiatan,'realisasi_tw4'))) : '' ?>
		</td>
		<td width=10>
			<?php echo nilai($per_outcome[$opd][$program][0]["realisasi_th$tw"]) ?>
		</td>
		<td width=13>
			<?php echo uang(array_sum(array_column($per_kegiatan,"realisasi_th$tw"))) ?>
		</td>
		<td>
			<?php echo persentase($per_outcome[$opd][$program][0]["realisasi_th$tw"],$per_outcome[$opd][$program][0]['target_tahunan']) ?>
		</td>
		<td>
			<?php echo persentase(array_sum(array_column($per_kegiatan,"realisasi_th$tw")), array_sum(array_column($per_kegiatan,'pagu_kegiatan'))) ?>
		</td>
		<td width=10>
			<?php echo nilai($per_outcome[$opd][$program][0]["realisasi_th$tw"]+$per_outcome[$opd][$program][0]['realisasi_renstra']) ?>
		</td>
		<td width=13>
			<?php echo uang(array_sum(array_column($per_kegiatan,"realisasi_th$tw")) + array_sum(array_column($per_kegiatan,'realisasi_renstra'))) ?>
		</td>
		<td>
			<?php echo persentase(($per_outcome[$opd][$program][0]["realisasi_th$tw"]+$per_outcome[$opd][$program][0]['realisasi_renstra']),$per_outcome[$opd][$program][0]['target_renstra']) ?>
		</td>
		<td>
			<?php echo persentase((array_sum(array_column($per_kegiatan,"realisasi_th$tw")) + array_sum(array_column($per_kegiatan,'realisasi_renstra'))), array_sum(array_column($per_kegiatan,'target_renstra'))) ?>
		</td>
	</tr>
	<?php endif; ?>
	<?php $rata_rata_tahun_kegiatan = array(); $rata_rata_renstra_kegiatan = array(); ?>
	<?php include 'kegiatan2.php'; ?>
	<tr>
		<td align="right" colspan="24">
			Rata-rata Capaian Kinerja
		</td>
		<td><?php echo persentase(array_sum($rata_rata_tahun_kegiatan),count($rata_rata_tahun_kegiatan)) ?></td>
		<td><?php echo persentase(array_sum(array_column($per_kegiatan,"realisasi_th$tw")), array_sum(array_column($per_kegiatan,'pagu_kegiatan'))) ?></td>
		<td colspan="2"></td>
		<td><?php echo persentase(array_sum($rata_rata_renstra_kegiatan),count($rata_rata_renstra_kegiatan)) ?></td>
		<td><?php echo persentase((array_sum(array_column($per_kegiatan,"realisasi_th$tw")) + array_sum(array_column($per_kegiatan,'realisasi_renstra'))), array_sum(array_column($per_kegiatan,'target_renstra'))) ?></td>
	</tr>
	<tr>
		<td align="right" colspan="24">
			Rata-rata Capaian Kinerja
		</td>
		<td><?php echo predikats(array_sum($rata_rata_tahun_kegiatan)/count($rata_rata_tahun_kegiatan)) ?></td>
		<td><?php echo predikats(array_sum(array_column($per_kegiatan,"realisasi_th$tw"))/ array_sum(array_column($per_kegiatan,'pagu_kegiatan'))) ?></td>
		<td colspan="2"></td>
		<td><?php echo predikats(array_sum($rata_rata_renstra_kegiatan)/count($rata_rata_renstra_kegiatan)) ?></td>
		<td><?php echo predikats((array_sum(array_column($per_kegiatan,"realisasi_th$tw")) + array_sum(array_column($per_kegiatan,'realisasi_renstra')))/ array_sum(array_column($per_kegiatan,'target_renstra'))) ?></td>
	</tr>
	
<?php endforeach ?>
<!-- END PROGRAM -->