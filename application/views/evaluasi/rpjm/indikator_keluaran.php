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
    <h1><?php _e($page_title . ' <b>' . $kegiatan . '</b>', 'Data Master')?></h1>
</div>

<div class="panel">
    <div id="select2container" class="panel-body">
        <div class="row">
            <div class="col-md-2">
                <a class="btn btn-success" href="<?php echo site_url('evaluasi/dpa/tambah_indikator_kegiatan/'.$kode) . '?__=' . base64_encode($kegiatan) ?>">Tambah</a> <a class="btn btn-warning" href="<?php echo site_url('evaluasi/dpa/index?hash='.$hash) ?>">Kembali</a>
            </div>
        </div>
    </div>
</div>

<div class="table-light table-responsive">                             
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Indikator</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $v): ?>
                <tr class="text-bold" style="background: #ededed">
                    <td>
                        <a data-toggle="tooltip" data-placement="right" title="" data-original-title="Hapus Indikator Kegiatan <?php echo $v['indikator'] ?>" class="btn btn-danger btn-xs s-tooltip" href="<?php echo site_url('evaluasi/dpa/hapus_indikator_kegiatan/' . $v['pk'].'/'.base64_encode($v['pk'])) ?>"><i class="fa fa-times"></i></a>
                    </td>
                    <td><a class="indikator" data-pk="<?php echo $v['pk'] ?>" ><?php echo $v['indikator'] ?></a></td>
                    <td><a class="satuan" data-pk="<?php echo $v['pk'] ?>" ><?php echo $v['satuan'] ?></a></td>
                    
                </tr>
                
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

