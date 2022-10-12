<div class="page-header">
    <h1><?php _e($page_title, 'Data Master')?></h1>
</div>
<?php echo form_open('master/bidang/delete', ['class'=>'panel form-horizontal']); ?>
    <div class="panel-heading">
        <span class="panel-title">Konfirmasi Hapus <?php _e($page_title, 'Data Master') ?></span>
    </div>
    <div class="panel-body">
        <div class="row form-group">
            <label class="col-sm-4 control-label">Kode Urusan</label>
            <div class="col-sm-8">
                <input readonly="readonly" type="number" value="<?php _e($data['kode_urusan']) ?>" name="kode_urusan" class="form-control">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-4 control-label">Kode bidang</label>
            <div class="col-sm-8">
                <input readonly="readonly" type="number" value="<?php _e($data['kode_bidang']) ?>" name="kode_bidang" class="form-control">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-4 control-label">Nama bidang</label>
            <div class="col-sm-8">
                <input readonly="readonly" type="text" value="<?php _e($data['nama_bidang']) ?>" name="nama_bidang" class="form-control">
            </div>
        </div>
    </div>
    <div class="panel-footer text-right">
        <a href="<?php echo site_url('master/bidang') ?>" class="btn btn-primary">Batal</a>&nbsp;&nbsp;<button type="submit" class="btn btn-danger">Hapus</button>
    </div>
<?php echo form_close(); ?>
