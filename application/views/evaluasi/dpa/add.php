<?php if ($this->session->flashdata('status_input') != NULL): ?>
    <script type="text/javascript">
        init.push(function () {
            $.growl.notice({ title: "Status", message: "<?php echo $this->session->flashdata('status_input') ?>" });
        });
    </script>
<?php endif ?>
<div class="page-header">
    <h1><?php _e('Tambah' . $page_title, 'Data Master')?></h1>
</div>

<!-- <pre>
    
</pre> -->

<?php echo form_open('evaluasi/dpa/tambah_kegiatan'); ?>
<div class="row">
    <div class="col-md-6">
        <button type="submit" class="btn btn-success pull-left">Simpan</button>
        <a href="<?php echo site_url('evaluasi/dpa/?hash=' .base64_encode($hash)) ?>" class="btn btn-warning pull-right">Kembali</a>
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
                    <?php foreach ($data as $kp => $val): ?>
                        <tr class="text-bold" style="background: #ededed">
                            <td><?php echo $kp ?></td>
                            <td colspan="2"><?php echo $val[0]['nama_program'] ?></td>
                        </tr>
                        <?php foreach ($val as $keg): ?>
                            <tr style="background: #ffffff">
                                <td><?php echo $keg['kode_kegiatan'] ?></td>
                                <td><?php echo $keg['nama_kegiatan'] ?></td>
                                <td><?php echo make_switchbox('kode', $keg['kode_kegiatan'], $keg['pilih']) ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<input type="hidden" name="kode_subunit" value="<?php echo $hash ?>">
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

