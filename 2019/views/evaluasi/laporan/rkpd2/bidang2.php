<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- START LOOP BIDANG -->
<?php foreach ($per_bidang as $bidang => $per_opd) :?>
	<?php 
	$kd_bidang = explode('.', $bidang);
	?>
	<tr bgcolor="#FFAB91">
		<td></td>
		<td></td>
		<td><?= $kd_bidang[0] ?></td>
		<td><?= $kd_bidang[1] ?></td>
		<td></td>
		<td></td>
		<td colspan="24"><?php echo $master_bidang[$bidang] ?></td>
	</tr>
	<?php include 'opd2.php'; ?>
<?php endforeach ?>
<!-- END BIDANG -->