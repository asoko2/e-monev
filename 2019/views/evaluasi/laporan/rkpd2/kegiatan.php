<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- START LOOP PROGRAM -->
<!-- START LOOP KEGIATAN -->
<?php foreach ($per_kegiatan as $dpa) :?>
	<?php $jml_output = count($per_output[$opd][$dpa['kode_kegiatan']]);if ( $jml_output> 1) :?>
		<tr>
			<td></td>
			<td width=15><?php echo $dpa['nama_kegiatan'] ?></td>
			<td width=20>
				<?php echo $per_output[$opd][$dpa['kode_kegiatan']][0]['indikator'] ?>
				 (<?php echo $per_output[$opd][$dpa['kode_kegiatan']][0]['satuan'] ?>)	
			</td>
			<td width=10>
				<?php echo nilai($per_output[$opd][$dpa['kode_kegiatan']][0]['target_renstra']) ?>
			</td>
			<td width=13>
				<?php echo uang($dpa['target_renstra']) ?>
			</td>
			<td width=10>
				<?php echo nilai($per_output[$opd][$dpa['kode_kegiatan']][0]['realisasi_renstra']) ?>
			</td>
			<td width=13>
				<?php echo uang($dpa['realisasi_renstra']) ?>
			</td>
			<td width=10>
				<?php echo nilai($per_output[$opd][$dpa['kode_kegiatan']][0]['target_tahunan']) ?>
				
			</td>
			<td width=13>
				<?php echo uang($dpa['pagu_kegiatan']) ?>
			</td>
			<td>
				<?php echo $tw > 0 ? nilai($per_output[$opd][$dpa['kode_kegiatan']][0]['realisasi_tw1']) : '' ?>
			</td>
			<td width=13>
				<?php echo $tw > 0 ? uang($dpa['realisasi_tw1']) :''?>
			</td>
			<td>
				<?php echo $tw > 1 ? nilai($per_output[$opd][$dpa['kode_kegiatan']][0]['realisasi_tw2']) : ''?>
			</td>
			<td width=13>
				<?php echo $tw > 1 ? uang($dpa['realisasi_tw2']) :''?>
			</td>
			<td>
				<?php echo $tw > 2 ? nilai($per_output[$opd][$dpa['kode_kegiatan']][0]['realisasi_tw3']) : ''?>
			</td>
			<td width=13>
				<?php echo $tw > 2 ? uang($dpa['realisasi_tw3']) : '' ?>
			</td>
			<td>
				<?php echo $tw > 3 ? nilai($per_output[$opd][$dpa['kode_kegiatan']][0]['realisasi_tw4']) : '' ?>
			</td>
			<td width=13>
				<?php echo $tw > 3 ? uang($dpa['realisasi_tw4']) : '' ?>
			</td>
			<td width=10>
				<?php echo nilai($per_output[$opd][$dpa['kode_kegiatan']][0]["realisasi_th$tw"]) ?>
			</td>
			<td width=13>
				<?php echo uang($dpa["realisasi_th$tw"]) ?>
			</td>
			<td>
				<?php echo persentase($per_output[$opd][$dpa['kode_kegiatan']][0]["realisasi_th$tw"],$per_output[$opd][$dpa['kode_kegiatan']][0]['target_tahunan']) ?>
				<?php array_push($rata_rata_tahun_kegiatan, $per_output[$opd][$dpa['kode_kegiatan']][0]["realisasi_th$tw"]/$per_output[$opd][$dpa['kode_kegiatan']][0]['target_tahunan']) ?>
			</td>
			<td>
				<?php echo persentase($dpa["realisasi_th$tw"], $dpa['pagu_kegiatan']) ?>
			</td>
			<td width=10>
				<?php echo nilai($per_output[$opd][$dpa['kode_kegiatan']][0]["realisasi_th$tw"]+$per_output[$opd][$dpa['kode_kegiatan']][0]['realisasi_renstra']) ?>

			</td>
			<td width=13>
				<?php echo uang($dpa["realisasi_th$tw"] + $dpa['realisasi_renstra']) ?>
			</td>
			<td>
				<?php echo persentase(($per_output[$opd][$dpa['kode_kegiatan']][0]["realisasi_th$tw"]+$per_output[$opd][$dpa['kode_kegiatan']][0]['realisasi_renstra']),$per_output[$opd][$dpa['kode_kegiatan']][0]['target_renstra']) ?>
				<?php array_push($rata_rata_renstra_kegiatan, ($per_output[$opd][$dpa['kode_kegiatan']][0]["realisasi_th$tw"]+$per_output[$opd][$dpa['kode_kegiatan']][0]['realisasi_renstra'])/$per_output[$opd][$dpa['kode_kegiatan']][0]['target_renstra']) ?>
			</td>
			<td>
				<?php echo persentase(($dpa["realisasi_th$tw"] + $dpa['realisasi_renstra']), $dpa['target_renstra']) ?>
				
				
			</td>
		</tr>
		<?php else: ?>
		<tr>

			<td></td>
			<td width=15><?php echo $dpa['nama_kegiatan'] ?></td>
			<td width=20>
				<?php echo $per_output[$opd][$dpa['kode_kegiatan']][0]['indikator'] ?>
				 ( <?php echo $per_output[$opd][$dpa['kode_kegiatan']][0]['satuan'] ?> )	
			</td>
			<td width=10>
				<?php echo nilai($per_output[$opd][$dpa['kode_kegiatan']][0]['target_renstra']) ?>
			</td>
			<td width=13>
				<?php echo uang($dpa['target_renstra']) ?>
			</td>
			<td width=10>
				<?php echo nilai($per_output[$opd][$dpa['kode_kegiatan']][0]['realisasi_renstra']) ?>
			</td>
			<td width=13>
				<?php echo uang($dpa['realisasi_renstra']) ?>
			</td>
			<td width=10>
				<?php echo nilai($per_output[$opd][$dpa['kode_kegiatan']][0]['target_tahunan']) ?>
			</td>
			<td width=13>
				<?php echo uang($dpa['pagu_kegiatan']) ?>
			</td>
			<td>
				<?php echo $tw > 0 ? nilai($per_output[$opd][$dpa['kode_kegiatan']][0]['realisasi_tw1']) : '' ?>
			</td>
			<td width=13>
				<?php echo $tw > 0 ? uang($dpa['realisasi_tw1']) :''?>
			</td>
			<td>
				<?php echo $tw > 1 ? nilai($per_output[$opd][$dpa['kode_kegiatan']][0]['realisasi_tw2']) : ''?>
			</td>
			<td width=13>
				<?php echo $tw > 1 ? uang($dpa['realisasi_tw2']) :''?>
			</td>
			<td>
				<?php echo $tw > 2 ? nilai($per_output[$opd][$dpa['kode_kegiatan']][0]['realisasi_tw3']) : ''?>
			</td>
			<td width=13>
				<?php echo $tw > 2 ? uang($dpa['realisasi_tw3']) : '' ?>
			</td>
			<td>
				<?php echo $tw > 3 ? nilai($per_output[$opd][$dpa['kode_kegiatan']][0]['realisasi_tw4']) : '' ?>
			</td>
			<td width=13>
				<?php echo $tw > 3 ? uang($dpa['realisasi_tw4']) : '' ?>
			</td>
			<td width=10>
				<?php echo nilai($per_output[$opd][$dpa['kode_kegiatan']][0]["realisasi_th$tw"]) ?>
			</td>
			<td width=13>
				<?php echo uang($dpa["realisasi_th$tw"]) ?>
			</td>
			<td>
				<?php echo persentase($per_output[$opd][$dpa['kode_kegiatan']][0]["realisasi_th$tw"],$per_output[$opd][$dpa['kode_kegiatan']][0]['target_tahunan']) ?>
				<?php array_push($rata_rata_tahun_kegiatan, $per_output[$opd][$dpa['kode_kegiatan']][0]["realisasi_th$tw"]/$per_output[$opd][$dpa['kode_kegiatan']][0]['target_tahunan']) ?>
			</td>
			<td>
				<?php echo persentase($dpa["realisasi_th$tw"], $dpa['pagu_kegiatan']) ?>
			</td>
			<td>
				<?php echo ($per_output[$opd][$dpa['kode_kegiatan']][0]["realisasi_th$tw"]+$per_output[$opd][$dpa['kode_kegiatan']][0]['realisasi_renstra']) ?>
			</td>
			<td width=13>
				<?php echo uang($dpa["realisasi_th$tw"] + $dpa['realisasi_renstra']) ?>
			</td>
			<td>
				<?php echo persentase(($per_output[$opd][$dpa['kode_kegiatan']][0]["realisasi_th$tw"]+$per_output[$opd][$dpa['kode_kegiatan']][0]['realisasi_renstra']),$per_output[$opd][$dpa['kode_kegiatan']][0]['target_renstra']) ?>
				<?php array_push($rata_rata_renstra_kegiatan, ($per_output[$opd][$dpa['kode_kegiatan']][0]["realisasi_th$tw"]+$per_output[$opd][$dpa['kode_kegiatan']][0]['realisasi_renstra'])/$per_output[$opd][$dpa['kode_kegiatan']][0]['target_renstra']) ?> 
			</td>
			<td>
				<?php echo persentase(($dpa["realisasi_th$tw"] + $dpa['realisasi_renstra']), $dpa['target_renstra']) ?>
				
				
			</td>
		</tr>
		<?php endif; ?>
<?php endforeach ?>
<!-- END KEGIATAN -->