<?php if ($this->session->flashdata('status_input') != NULL): ?>
    <script type="text/javascript">
        init.push(function () {
            $.growl.notice({ title: "Status", message: "<?php echo $this->session->flashdata('status_input') ?>" });
        });
    </script>
<?php endif ?>
<style type="text/css">
    .editable-click, a.editable-click, a.editable-click:hover {
        color:#e35442!important;
        border-bottom: dashed 0px !important;
    }
</style>
<div class="page-header">
    <h1><?php _e($page_title . ' ' . Widget::namaOpd($hash), 'Data Master')?></h1>
</div>

<div class="panel">
    <div id="select2container" class="panel-body">
        <div class="row">
            <div class="col-md-2">
                <select id="select_unit" class="form-control">
                    <?php echo(Widget::selectSubunit([$user->unit], $hash)) ?>
                </select>
            </div>
            <div class="col-md-2">
                <a class="btn btn-success" href="<?php echo site_url('evaluasi/dpa/tambah/'.$hash) ?>">Tambah</a>
            </div>
        </div>
    </div>
</div>

<div class="table-light table-responsive">                             
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Kode Rekening</th>
                <th>Urusan/Bidang Urusan Pemerintahan Daerah Dan Program/Kegiatan</th>
                <th>Anggaran</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $kp => $val): ?>
                <tr class="text-bold" style="background: #ededed">
                    <td class="text-right">
                        <a data-toggle="tooltip" data-placement="right" title="" data-original-title="Daftar Indikator Kegiatan <?php echo $val[0]['nama_program'] ?>" class="btn btn-success btn-xs s-tooltip" href="<?php echo site_url('evaluasi/dpa/indikator_program/' . $hash .'.'. $kp.'/'.base64_encode($hash)) ?>"><i class="fa fa-list-ul"></i></a>
                    </td>
                    <td><?php echo $kp ?></td>
                    <td colspan="2"><?php echo $val[0]['nama_program'] ?></td>
                </tr>
                <?php foreach ($val as $keg): ?>
                    <tr style="background: #ffffff">
                        <?php if ($keg['kode_status'] == 1) : ?>
                            <td><a data-toggle="tooltip" data-placement="right" title="" data-original-title="Daftar Indikator Kegiatan <?php echo $keg['nama_kegiatan'] ?>" class="btn btn-info btn-xs s-tooltip" href="<?php echo site_url('evaluasi/dpa/indikator_kegiatan/' . $hash.'.'.$keg['kode_kegiatan'].'/'.base64_encode($hash)) ?>"><i class="fa fa-list-ul"></i></a></td>
                        <?php else : ?>
                        <td>
                            <a data-toggle="tooltip" data-placement="right" title="" data-original-title="Hapus Kegiatan <?php echo $keg['nama_kegiatan'] ?>" class="btn btn-danger btn-xs s-tooltip" href="<?php echo site_url('evaluasi/dpa/hapus_kegiatan/' . $hash.'.'.$keg['kode_kegiatan'].'/'.base64_encode($hash)) ?>"><i class="fa fa-times"></i></a>
                            <a data-toggle="tooltip" data-placement="right" title="" data-original-title="Daftar Indikator Kegiatan <?php echo $keg['nama_kegiatan'] ?>" class="btn btn-info btn-xs s-tooltip" href="<?php echo site_url('evaluasi/dpa/indikator_kegiatan/' . $hash.'.'.$keg['kode_kegiatan'].'/'.base64_encode($hash)) ?>"><i class="fa fa-list-ul"></i></a>
                        </td>
                        <?php endif ?>
                        <td><?php echo $keg['kode_kegiatan'] ?></td>
                        <td><?php echo $keg['nama_kegiatan'] ?></td>
                        <td class="text-right">
                            <?php if ($keg['kode_status'] == 1) : ?>
                               <span class="text-success"><?php echo $keg['pagu_anggaran'] ?></span> 
                            </td>
                            <?php else : ?>
                            <a class="anggaran" data-pk="<?php echo $hash . '.'. $keg['kode_kegiatan'] ?>" ><?php echo $keg['pagu_anggaran'] ?></a>
                            <?php endif ?>
                    </tr>
                <?php endforeach ?>
            <?php endforeach ?>
        </tbody>
    </table>
</div>


<script type="text/javascript">
    init.push(function () {

        accounting.settings = {
            currency: {
                symbol : "Rp.",   // default currency symbol is '$'
                format: "%s %v", // controls output: %s = symbol, %v = value/number (can be object: see below)
                decimal : ".",  // decimal point separator
                thousand: ",",  // thousands separator
                precision : 2   // decimal places
            },
            number: {
                precision : 2,  // default precision on numbers is 0
                thousand: ",",
                decimal : "."
            }
        }

        $('.s-tooltip').tooltip();
        // $.fn.editable.defaults.mode = 'inline';

        $("#select_unit").select2({
            placeholder: "Pilih Sub Unit"
        });
        $('#select_unit').on("change", function(e) {
            console.log(e.val)
            window.location.href = '<?php echo(site_url("evaluasi/dpa/index?hash=")) ?>' + e.val
        });

        $('.anggaran').editable({
            type: 'text',
            mode: 'inline',
            name: 'pagu_anggaran_murni',
            title: 'Masukkan Pagu Anggaran',
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            },
            display: function(value) {
                $(this).text(accounting.formatMoney(value));
            }
        });
    });
</script>

