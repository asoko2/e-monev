<?php 
    if (isset($data['form_error'])) {
        $error_class = 'has-error';
        $error_text = '<p class="help-block">'.$data['form_error'].'</p>';
    } else {
        $error_class = '';
        $error_text = '';
    }
?>
    
<div class="page-header">
    <h1><?php _e($page_title, 'Data Master')?></h1>
</div>
<?php echo form_open('master/subunit/add', ['class'=>'panel form-horizontal']); ?>
    <div class="panel-heading">
        <span class="panel-title">Tambah <?php _e($page_title, 'Data Master') ?></span>
    </div>
    <div class="panel-body">
        <div class="row form-group <?php _e($error_class) ?>">
            <label class="col-sm-4 control-label">Kode Urusan</label>
            <div class="col-sm-8">
                <input type="number" value="<?php _e($data['kode_urusan']) ?>" name="kode_urusan" class="form-control">
                <?php _e($error_text) ?>
            </div>
        </div>
        <div class="row form-group <?php _e($error_class) ?>">
            <label class="col-sm-4 control-label">Kode bidang</label>
            <div class="col-sm-8">
                <input type="number" value="<?php _e($data['kode_bidang']) ?>" name="kode_bidang" class="form-control">
                <?php _e($error_text) ?>
            </div>
        </div>
        <div class="row form-group <?php _e($error_class) ?>">
            <label class="col-sm-4 control-label">Kode unit</label>
            <div class="col-sm-8">
                <input type="number" value="<?php _e($data['kode_unit']) ?>" name="kode_unit" class="form-control">
                <?php _e($error_text) ?>
            </div>
        </div>
        <div class="row form-group <?php _e($error_class) ?>">
            <label class="col-sm-4 control-label">Kode subunit</label>
            <div class="col-sm-8">
                <input type="number" value="<?php _e($data['kode_subunit']) ?>" name="kode_subunit" class="form-control">
                <?php _e($error_text) ?>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-4 control-label">Nama subunit</label>
            <div class="col-sm-8">
                <input type="text" value="<?php _e($data['nama_subunit']) ?>" name="nama_subunit" class="form-control">
            </div>
        </div>
    </div>
    <div class="panel-footer text-right">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
<?php echo form_close(); ?>
