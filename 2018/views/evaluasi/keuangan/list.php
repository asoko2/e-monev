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

<div class="panel">
    <div id="select2container" class="panel-body">
        <div class="row">
            <div class="col-md-2">
                <select id="select_unit" class="form-control">
                    <?php echo(Widget::selectSubunit([$user->unit], $hash)) ?>
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
                <th rowspan="2">Sasaran</th>
                <th rowspan="2">Kode Rekening</th>
                <th rowspan="2">Urusan/Bidang Urusan Pemerintahan Daerah Dan Program/Kegiatan</th>
                <th rowspan="2">Indikator Kinerja Program (outcome)/ Kegiatan (output)</th>
                <th colspan="2" rowspan="2">Target Renstra Akhir Periode 2015 - 2019</th>
                <th colspan="2" rowspan="2">Realisasi Capaian Kinerja Renstra s/d Tahun Lalu</th>
                <th colspan="2" rowspan="2">Target Kinerja dan Anggaran Renja Tahun Berjalan 2017</th>
                <th colspan="8">Realisasi Kinerja Pada Triwulan</th>
                <th colspan="2" rowspan="2">Realisasi Capaian Kinerja dan Anggaran Renja</th>
                <th colspan="2" rowspan="2">Tingkat Capaian Kinerja dan Anggaran Renja Tahun 2017</th>
                <th colspan="2" rowspan="2">Realisasi Kinerja dan Anggaran Renstra s/d Tahun 2017</th>
                <th colspan="2" rowspan="2">Tingkat Capaian Kinerja dan Anggaran Renstra s/d Tahun 2017</th>
                <th rowspan="2">Penanggung Jawab</th>
            </tr>
            <tr>
                <th colspan="2">I</th>
                <th colspan="2">II</th>
                <th colspan="2">III</th>
                <th colspan="2">IV</th>
            </tr>
            <tr>
                <th rowspan="2">1</th>
                <th rowspan="2">2</th>
                <th rowspan="2">3</th>
                <th rowspan="2">4</th>
                <th rowspan="2">5</th>
                <th colspan="2">6</th>
                <th colspan="2">7</th>
                <th colspan="2">8</th>
                <th colspan="2">9</th>
                <th colspan="2">10</th>
                <th colspan="2">11</th>
                <th colspan="2">12</th>
                <th colspan="2">13</th>
                <th colspan="2">14</th>
                <th colspan="2">15</th>
                <th colspan="2">16</th>
                <th rowspan="2">17</th>
            </tr>
            <tr>
                <th>K</th>
                <th>RP</th>
                <th>K</th>
                <th>RP</th>
                <th>K</th>
                <th>RP</th>
                <th>K</th>
                <th>RP</th>
                <th>K</th>
                <th>RP</th>
                <th>K</th>
                <th>RP</th>
                <th>K</th>
                <th>RP</th>
                <th>K</th>
                <th>RP</th>
                <th>K</th>
                <th>RP</th>
                <th>K</th>
                <th>RP</th>
                <th>K</th>
                <th>RP</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($data) > 0): ?>
            <?php foreach ($data['kegiatan'] as $key => $urusan): ?>
                <!-- #URUSAN -->
                <?php $key = explode('|', $key) ?>
                <tr bgcolor="#ddd">
                    <td></td>
                    <td></td>
                    <td><?php _e($key[0]) ?></td>
                    <td colspan="25"><?php _e($key[1]) ?></td>
                </tr>
                <!-- #BIDANG -->
                <?php foreach ($urusan as $key => $bidang): ?>
                    <?php $key = explode('|', $key) ?>
                    <tr bgcolor="#e5e5e5">
                        <td></td>
                        <td></td>
                        <td><?php _e($key[0]) ?></td>
                        <td colspan="25"><?php _e($key[1]) ?></td>
                    </tr>
                    <!-- #PROGRAM -->
                    <?php foreach ($bidang as $key => $program): ?>
                        <?php $key = explode('|', $key) ?>
                        <?php 
                            $capaian = isset($data['capaian'][$key[0]]) ? $data['capaian'][$key[0]] : [];
                            if (count($capaian) == 0) {
                                continue;
                            }
                        ?>
                        <tr bgcolor="#ededed">
                            <td></td>
                            <td></td>
                            <td><?php _e($key[0]) ?></td>
                            <td><?php _e($key[1]) ?></td>
                            <td><?php indiSatuan($capaian[0]) ?></td>
                            <td><?php arr_num($capaian[0],'target_renstra') ?></td>
                            <td></td>
                            <td><?php arr_num($capaian[0],'realisasi_renstra') ?></td>
                            <td></td>
                            <td><?php arr_num($capaian[0],'target_th') ?></td>
                            <td></td>
                            <td><?php arr_num($capaian[0],'realisasi_tw1') ?></td>
                            <td></td>
                            <td><?php arr_num($capaian[0],'realisasi_tw2') ?></td>
                            <td></td>
                            <td><?php arr_num($capaian[0],'realisasi_tw3') ?></td>
                            <td></td>
                            <td><?php arr_num($capaian[0],'realisasi_tw4') ?></td>
                            <td colspan="10"></td>
                        </tr>
                        <!-- #KEGIATAN -->
                        <?php foreach ($program as $kegiatan): ?>
                            <tr bgcolor="#ffffff">
                                <td></td>
                                <td></td>
                                <td><?php _e($kegiatan['kode_kegiatan']) ?></td>
                                <td><?php _e($kegiatan['nama_kegiatan']) ?></td>
                                <td colspan="24"><?php _e($kegiatan['nama_kegiatan']) ?></td>
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

        // $('#select_unit').on("change", function(e) {
        //     console.log(e.val)
        //     window.location.href = '<?php echo(site_url("evaluasi/dpa/index?hash=")) ?>' + e.val
        // });

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
