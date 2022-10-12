<?php if ($this->session->flashdata('status_input') != NULL): ?>
    <script type="text/javascript">
        init.push(function () {
            $.growl.notice({ title: "Status", message: "<?php echo $this->session->flashdata('status_input') ?>" });
        });
    </script>
<?php endif ?>
<div class="page-header">
    <h1><?php _e($page_title, 'Data Master')?></h1>
</div>
<a href="<?php echo site_url('master/misi/add') ?>" class="btn btn-success">Tambah</a>
<br>
<br>
<div class="table-light table-responsive">                             
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Kode Misi</th>
                <th>Uraian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $value): ?>
                <tr>
                   <td><?= $value['kd_misi'] ?></td>  
                   <td><?= $value['uraian'] ?></td>  
                    <td><?php echo $value['aksi'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>


