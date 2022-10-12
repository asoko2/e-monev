<div class="panel">

	<div class="panel-body">
		<?php echo $content; ?>
	</div>
</div>
<script type="text/javascript">
jQuery(document).on("xcrudafterrequest",function(event,container){
    if(Xcrud.current_task == 'save')
    {
        <?php if (isset($kembali)) : ?>
        window.location.href = '<?php echo $kembali; ?>';
        <?php else :?>
        $window.location.reload();
        <?php endif ?>
    }
});
</script>
