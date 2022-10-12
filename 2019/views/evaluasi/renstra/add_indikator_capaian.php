<?php if ($this->session->flashdata('status_input') != NULL): ?>
    <script type="text/javascript">
        init.push(function () {
            $.growl.notice({ title: "Status", message: "<?php echo $this->session->flashdata('status_input') ?>" });
        });
    </script>
<?php endif ?>
<div class="page-header">
    <h1><?php _e('Tambah Indikator Kegiatan <b>' . $program .'</b>')?></h1>
</div>

<!-- <pre>
    
</pre> -->

<?php echo form_open('evaluasi/dpa/tambah_indikator_program/'.$hash); ?>
<div class="row form-group">
    <label class="col-sm-2 control-label">Indikator</label>
    <div class="col-sm-4">
        <input type="text" name="indikator" class="form-control">
    </div>
</div>
<div class="row form-group">
    <label class="col-sm-2 control-label">satuan</label>
    <div class="col-sm-4">
        <input type="text" name="satuan" class="form-control">
    </div>
</div>
<input type="hidden" name="kode" value="<?php echo $hash ?>">
<div class="row">
    <div class="col-md-6">
        <button type="submit" class="btn btn-success pull-left">Simpan</button>
        <a href="<?php echo site_url('evaluasi/dpa/?hash=' .base64_encode($hash)) ?>" class="btn btn-warning pull-right">Kembali</a>
    </div>
</div>
<?php echo form_close(); ?>


<script type="text/javascript">
    init.push(function () {
        // $.fn.editable.defaults.mode = 'inline';
        $('.myswitch').switcher();
    });
</script>

