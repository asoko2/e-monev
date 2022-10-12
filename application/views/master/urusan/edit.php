<div class="page-header">
    <h1><?php _e($page_title, 'Data Master')?></h1>
</div>
<?php echo form_open('master/urusan/edit', ['class'=>'panel form-horizontal']); ?>
    <div class="panel-heading">
        <span class="panel-title">Ubah <?php _e($page_title, 'Data Master') ?></span>
    </div>
    <div class="panel-body">
        <div class="row form-group">
            <label class="col-sm-4 control-label">Kode Urusan</label>
            <div class="col-sm-8">
                <input readonly="readonly" type="number" value="<?php _e($data['kode_urusan']) ?>" name="kode_urusan" class="form-control">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-4 control-label">Nama Urusan</label>
            <div class="col-sm-8">
                <input type="text" value="<?php _e($data['nama_urusan']) ?>" name="nama_urusan" class="form-control">
            </div>
        </div>
    </div>
    <div class="panel-footer text-right">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
<?php echo form_close(); ?>
