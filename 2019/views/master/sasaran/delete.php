<div class="page-header">
    <h1><?php _e($page_title, 'Data Master')?></h1>
</div>
<?php echo form_open('master/sasaran/delete', ['class'=>'panel form-horizontal']); ?>
    <div class="panel-heading">
        <span class="panel-title">Konfirmasi Hapus <?php _e($page_title, 'Data Master') ?></span>
    </div>
    <div class="panel-body">
        <div class="row form-group">
            <label class="col-sm-4 control-label">Kode Sasaran</label>
            <div class="col-sm-8">
                <input readonly="readonly" type="number" value="<?php _e($data['kode_sasaran']) ?>" name="kode_sasaran" class="form-control">
            </div>
        </div>
         <div class="row form-group">
            <label class="col-sm-4 control-label">Uraian</label>
            <div class="col-sm-8">
                <input readonly="readonly" type="text" value="<?php _e($data['uraian']) ?>" name="uraian" class="form-control">
            </div>
        </div>
    </div>
    <div class="panel-footer text-right">
        <a href="<?php echo site_url('master/kegiatan') ?>" class="btn btn-primary">Batal</a>&nbsp;&nbsp;<button type="submit" class="btn btn-danger">Hapus</button>
    </div>
<?php echo form_close(); ?>
