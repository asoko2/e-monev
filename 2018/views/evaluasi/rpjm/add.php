<?php if ($this->session->flashdata('status_input') != NULL): ?>
    <script type="text/javascript">
        init.push(function () {
            $.growl.notice({ title: "Status", message: "<?php echo $this->session->flashdata('status_input') ?>" });
        });
    </script>
<?php endif ?>
<div class="page-header">
    <h1><?php _e('Tambah ' . $page_title . ' ' . Widget::namaOpd($hash), 'Data Master')?></h1>
</div>

<!-- <pre>
    
</pre> -->

<?php echo form_open('evaluasi/rpjm/tambah_kegiatan'); ?>
<div class="row">
    <div class="col-md-6">
        <button type="submit" class="btn btn-success pull-left">Simpan</button>
        <a href="<?php echo site_url('evaluasi/rpjm/?hash=' .base64_encode($hash)) ?>" class="btn btn-warning pull-right">Kembali</a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6">
        <div class="table-light table-responsive">                             
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode Rekening</th>
                        <th>Urusan/Bidang Urusan Pemerintahan Daerah Dan Program/Kegiatan</th>
                        <th>Pilih ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($data) > 0): ?>
                        <?php foreach ($data as $key => $urusan): ?><!-- #URUSAN -->
                            <?php $key = explode('|', $key) ?>
                            <tr bgcolor="#cdcdcd">
                                <td><?php _e($key[0]) ?></td>
                                <td><?php _e($key[1]) ?></td>
                                <td></td>
                            </tr>
                            <?php foreach ($urusan as $key => $bidang): ?><!-- #BIDANG -->
                                <?php $key = explode('|', $key) ?>
                                <tr bgcolor="#dedede">
                                    <td><?php _e($key[0]) ?></td>
                                    <td><?php _e($key[1]) ?></td>
                                    <td></td>
                                </tr>
                                <?php foreach ($bidang as $key): ?><!-- #PROGRAM -->
                                    <?php $kode = $key['kode_program'] ?>
                                    <tr bgcolor="#eee">
                                        <td><?php _e($key['kode_program']) ?></td>
                                        <td><?php _e($key['nama_program']) ?></td>
                                        <td><?php echo make_switchbox("$kode", $key['program_id'],0,FALSE) ?></td>
                                    </tr>
                                <?php endforeach ?><!-- #PROGRAM -->
                            <?php endforeach ?><!-- #BIDANG -->
                        <?php endforeach ?><!-- #URUSAN -->
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<input type="hidden" name="kode_subunit" value="<?php echo $hash ?>">
<div class="row">
    <div class="col-md-6">
        <button type="submit" class="btn btn-success pull-left">Simpan</button>
        <a href="<?php echo site_url('evaluasi/rpjm/?hash=' .base64_encode($hash)) ?>" class="btn btn-warning pull-right">Kembali</a>
    </div>
</div>
<?php echo form_close(); ?>


<script type="text/javascript">
    init.push(function () {
        // $.fn.editable.defaults.mode = 'inline';
        $('.myswitch').switcher({
            theme: 'square',
            on_state_content: '<span class="fa fa-check"></span>',
            off_state_content: '<span class="fa fa-times"></span>'
        });
    });
</script>

