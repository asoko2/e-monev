<style type="text/css">
    .editable-click, a.editable-click, a.editable-click:hover {
        color:#e35442!important;
        border-bottom: dashed 0px !important;
    }

    th {
        vertical-align: middle !important;
        text-align: center !important;
    }
</style>
<div class="page-header">
    <h1><?php _e($page_title . ' ' . Widget::namaOpd($hash), 'Data Master')?></h1>
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
    });
</script>
<?php
    $dt = $this->db->get('master_subunit',5)->result_array();
    $dt = array_map(function($x){
        $y = kode_subunit($x);
        return $y;
    }, $dt);
?>

<div class="panel">
    <div id="select2container" class="panel-body">
        <div class="row">
            <div class="col-md-2">
                <select id="select_unit" class="form-control">
                    <?php //echo(Widget::selectSubunit([], $hash)) ?>
                    <?php echo(Widget::selectSubunit($dt, $hash)) ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive" style="overflow-x:auto;">                             
    <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2">#</th>
                <th rowspan="2">Kode Rekening</th>
                <th rowspan="2">Urusan/Bidang Urusan Pemerintahan Daerah Dan Program/Kegiatan</th>
                <th rowspan="2">Realisasi Renstra Akhir Periode 2015 - 2019</th>
                <th colspan="12">Realisasi Kinerja Pada Bulan</th>
            </tr>
            <tr>
                <?php for ($ih=1; $ih < 13; $ih++) :?>
                <th><?php _e($ih) ?></th>
                <?php endfor ?>
            </tr>
        </thead>
        <tbody>
            <?php if (count($data)>0): ?>
            <?php foreach ($data['kegiatan'] as $key => $urusan): ?>
                <!-- #URUSAN -->
                <?php $key = explode('|', $key) ?>
                <tr bgcolor="#ddd">
                    <td></td>
                    <td><?php _e($key[0]) ?></td>
                    <td colspan="15"><?php _e($key[1]) ?></td>
                </tr>
                <!-- #BIDANG -->
                <?php foreach ($urusan as $key => $bidang): ?>
                    <?php $key = explode('|', $key) ?>
                    <tr bgcolor="#e5e5e5">
                        <td></td>
                        <td><?php _e($key[0]) ?></td>
                        <td colspan="14"><?php _e($key[1]) ?></td>
                    </tr>
                    <!-- #PROGRAM -->
                    <?php foreach ($bidang as $key => $program): ?>
                        <?php $key = explode('|', $key) ?>
                        <tr bgcolor="#ededed">
                            <td></td>
                            <td><?php _e($key[0]) ?></td>
                            <td><?php _e($key[1]) ?></td>
                            <td colspan="13"></td>
                        </tr>
                        <!-- #KEGIATAN -->
                        <?php foreach ($program as $kegiatan): ?>
                            <tr bgcolor="#ffffff">
                                <td></td>
                                <td><?php _e($kegiatan['kode_kegiatan']) ?></td>
                                <td><?php _e($kegiatan['nama_kegiatan']) ?></td>
                                <td class="text-right">
                                    <?php make_editable($data['keuangan'][$kegiatan['kode_kegiatan']][0], 'realisasi_renstra', [
                                        'pk' => $kegiatan['pk'],
                                        'val' => 'realisasi_renstra'
                                    ]) ?>
                                </td>
                                <?php for ($i=1; $i < 13; $i++) : ?>
                                    <script type="text/javascript">
                                        init.push(function () {
                                            $('.e_realisasi_b<?php echo $i ?>').editable({
                                                type: 'text',
                                                mode: 'inline',
                                                name: 'realisasi_keuangan_b<?php echo $i ?>',
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
                                <td class="text-right">
                                    <?php make_editable($data['keuangan'][$kegiatan['kode_kegiatan']][0], 'realisasi_b' .$i, [
                                        'pk' => $kegiatan['pk'],
                                        'val' => 'realisasi_b' .$i
                                    ]) ?>
                                </td>
                                <?php endfor ?>
                            </tr>
                        <?php endforeach ?>
                        <!-- #KEGIATAN_END -->
                    <?php endforeach ?>
                    <!-- #PROGRAM_END -->
                <?php endforeach ?>
                <!-- #BIDANG_END -->
            <?php endforeach ?>
            <!-- #URUSAN_END -->
            <?php endif ?>
        </tbody>
    </table>
</div>


<script type="text/javascript">
    init.push(function () {

        $('.s-tooltip').tooltip();
        // $.fn.editable.defaults.mode = 'inline';

        $("#select_unit").select2({
            placeholder: "Pilih Sub Unit"
        });

        $('#select_unit').on("change", function(e) {
            console.log(e.val)
            window.location.href = '<?php echo(site_url("evaluasi/keuangan/realisasi?hash=")) ?>' + e.val
        });

        $('.e_realisasi_renstra').editable({
            type: 'text',
            mode: 'inline',
            name: 'realisasi_keuangan_renstra',
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
