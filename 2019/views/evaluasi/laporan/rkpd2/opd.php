<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- START LOOP OPD -->
<?php foreach ($per_opd as $opd => $per_program) :?>
	<tr bgcolor="#FFCCBC">
		<td></td>
		<td colspan="24"><?php echo $master_opd[$opd] ?></td>
	</tr>
	<?php include 'program.php'; ?>
<?php endforeach ?>
<!-- END OPD -->