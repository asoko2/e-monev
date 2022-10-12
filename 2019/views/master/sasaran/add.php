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

<?php echo form_open('master/sasaran/add', ['class'=>'panel form-horizontal']); ?>
    <div class="panel-heading">
        <span class="panel-title">Tambah <?php _e($page_title, 'Data Master') ?></span>
    </div>
    <div class="panel-body">
        <div class="row form-group <?php _e($error_class) ?>">
            <label class="col-sm-4 control-label">Kode Sasaran</label>
            <div class="col-sm-8">
                <input type="number" value="<?php _e($data['kode_sasaran']) ?>" name="kode_sasaran" class="form-control">
                <?php _e($error_text) ?>
            </div>
        </div>
         
        <div class="row form-group">
            <label class="col-sm-4 control-label">Uraian Sasaran</label>
            <div class="col-sm-8">
                <input type="text" value="<?php _e($data['uraian']) ?>" name="uraian" class="form-control">
            </div>
        </div>
    </div>
    <div class="panel-footer text-right">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
<?php echo form_close(); ?>

