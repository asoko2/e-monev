<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- START LOOP BIDANG -->
<?php foreach ($per_bidang as $bidang => $per_opd) :?>
	<tr bgcolor="#FFAB91">
		<td></td>
		<td colspan="24"><?php echo $master_bidang[$bidang] ?></td>
	</tr>
	<?php include 'opd.php'; ?>
<?php endforeach ?>
<!-- END BIDANG -->