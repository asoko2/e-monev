		</div> <!-- / #content-wrapper -->
		<div id="main-menu-bg"></div>
	</div> <!-- / #main-wrapper -->


    <script src="<?php echo base_url() ?>javascripts/accounting.min.js"></script>

    <script src="<?php echo base_url() ?>javascripts/pixel-admin.min.js"></script>
    <script src="<?php echo base_url() ?>javascripts/sweetalert2.all.min.js"></script>
    <script src="<?= base_url() ?>javascripts/fileupload/js/vendor/jquery.ui.widget.js"></script>
    <script src="<?= base_url() ?>javascripts/fileupload/js/jquery.fileupload.js"></script>
    <script src="<?= base_url() ?>javascripts/fileupload/js/jquery.fileupload-process.js"></script>
    <script src="<?= base_url() ?>javascripts/fileupload/js/jquery.fileupload-validate.js"></script>

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

	<script type="text/javascript">
		window.PixelAdmin.start(init);
	</script>
   </script>
	<?php if (isset($js)): ?>
		<?php $this->load->view('partial/js/' . $js); ?>
	<?php endif ?>
    <script type="text/javascript">
        jQuery(document).on("xcrudbeforerequest", function(event, container) {
            if (container) {
                jQuery(container).find("select.select4").css("width", "100%").select2("destroy");
            } else {
                jQuery(".xcrud").find("select.select4").css("width", "100%").select2("destroy");
            }
        });
        jQuery(document).on("ready xcrudafterrequest", function(event, container) {
            if (container) {
                jQuery(container).find("select.select4").css("width", "100%").select2();
            } else {
                jQuery(".xcrud").find("select.select4").css("width", "100%").select2();
            }
        });
        jQuery(document).on("xcrudbeforedepend", function(event, container, data) {
            jQuery(container).find('select[name="' + data.name + '"]').css("width", "100%").select2("destroy");
        });
        jQuery(document).on("xcrudafterdepend", function(event, container, data) {
            jQuery(container).find('select[name="' + data.name + '"]').css("width", "100%").select2();
        });
    </script>
</body>
</html>
