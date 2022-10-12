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
    th {
        text-align: center !important;
        vertical-align: middle !important;
    }
    tr:hover {
        background: #c4d2e4;
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

<div class="table-light table-responsive">                             
    <table class="table table-bordered">
        <thead>
            <tr>
                
                <th rowspan="2">Sasaran</th>
                <th rowspan="2">Kode Rekening</th>
                <th rowspan="2">Urusan/Bidang Urusan Pemerintahan Daerah Dan Program/Kegiatan</th>
                <th rowspan="2">Indikator Kinerja</th>
                <th colspan="5">Target RPJMD/RENSTRA Pada Tahun Ke-</th>
                <th colspan="5">Realisasi RPJMD/RENSTRA Pada Tahun Ke-</th>
                <th rowspan="2">Capaian Akhir Tahun </th>
            </tr>
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>

                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($data) > 0): ?>
            <?php foreach ($data as $key => $urusan): ?><!-- #URUSAN -->
                <?php $key = explode('|', $key) ?>
                <tr bgcolor="#cdcdcd">
                    <td></td>
                     
                    <td><?php _e($key[0]) ?></td>
                    <td colspan="13"><?php _e($key[1]) ?></td>
                </tr>
                <?php foreach ($urusan as $key => $bidang): ?><!-- #BIDANG -->
                    <?php $key = explode('|', $key) ?>
                    <tr bgcolor="#dedede">
                       
                        <td></td>
                        <td><?php _e($key[0]) ?></td>
                        <td colspan="13"><?php _e($key[1]) ?></td>
                    </tr>
                    <?php foreach ($bidang as $key => $program): ?><!-- #PROGRAM -->
                        <?php $key = explode('|', $key) ?>
                        <?php $capaian = array_filter($indikator_capaian, function($x) use ($key){
                            return $x['program_id'] == $key[2];
                        }) ?>
                        <tr bgcolor="#eee">
                             
                            <td><?=  $program[0] ['sasaran_program'] ?></td>
                            <td><?php _e($key[0]) ?></td>
                            <td colspan="2"><?php _e($key[1]) ?></td>
                            <td><?= $program[0]['t_rpjm_1'] ?></td>
                            <td><?= $program[0]['t_rpjm_2'] ?></td>
                            <td><?= $program[0]['t_rpjm_3'] ?></td>
                            <td><?= $program[0]['t_rpjm_4'] ?></td>
                            <td><?= $program[0]['t_rpjm_5'] ?></td>

                            <td class="text-right"><?php make_editable($program[0], 'realisasi_pagu_rpjm_1', ['pk'=>$key[2], 'val'=>'r_rpjm_1']) ?></td>
                            <td class="text-right"><?php make_editable($program[0], 'realisasi_pagu_rpjm_2', ['pk'=>$key[2], 'val'=>'r_rpjm_2']) ?></td>
                            <td class="text-right"><?php make_editable($program[0], 'realisasi_pagu_rpjm_3', ['pk'=>$key[2], 'val'=>'r_rpjm_3']) ?></td>
                            <td class="text-right"><?php make_editable($program[0], 'realisasi_pagu_rpjm_4', ['pk'=>$key[2], 'val'=>'r_rpjm_4']) ?></td>
                            <td class="text-right"><?php make_editable($program[0], 'realisasi_pagu_rpjm_5', ['pk'=>$key[2], 'val'=>'r_rpjm_5']) ?></td>
                            <td></td>
                        </tr>
                        <?php foreach ($capaian as $cap): ?>
                            <tr>
                                <td colspan="3" class="text-right">
                                
                                </td>

                                <td><?= $cap['indikator']  ?> (<?= $cap['satuan'] ?>)</td>
                                <!-- target -->
                                 
                                <td class="text-right"><?= $cap['t_rpjm_1'] ?></td>
                                <td class="text-right"><?= $cap['t_rpjm_2'] ?></td>
                                <td class="text-right"><?= $cap['t_rpjm_3'] ?></td>
                                <td class="text-right"><?= $cap['t_rpjm_4'] ?></td>
                                <td class="text-right"><?= $cap['t_rpjm_5'] ?></td>
                                
                                <td class="text-right"><?php make_editable($cap, 'target_realisasi_1', ['pk'=>$cap['id'], 'val'=>'r_rpjm_1']) ?></td>
                                <td class="text-right"><?php make_editable($cap, 'target_realisasi_2', ['pk'=>$cap['id'], 'val'=>'r_rpjm_2']) ?></td>
                                <td class="text-right"><?php make_editable($cap, 'target_realisasi_3', ['pk'=>$cap['id'], 'val'=>'r_rpjm_3']) ?></td>
                                <td class="text-right"><?php make_editable($cap, 'target_realisasi_4', ['pk'=>$cap['id'], 'val'=>'r_rpjm_4']) ?></td>
                                <td class="text-right"><?php make_editable($cap, 'target_realisasi_5', ['pk'=>$cap['id'], 'val'=>'r_rpjm_5']) ?></td>

                                <td class="text-right"><?php make_editable($cap, 'target_realisasi_6', ['pk'=>$cap['id'], 'val'=>'r_rpjm_6']) ?></td>
                            </tr>
                        <?php endforeach ?>
                        
                    <?php endforeach ?><!-- #PROGRAM -->
                <?php endforeach ?><!-- #BIDANG -->
            <?php endforeach ?><!-- #URUSAN -->
        <?php endif ?>
        </tbody>
    </table>
</div>


<script type="text/javascript">
    var sasaran = <?= json_encode($sasaran) ?>;
    var jenis_indikator = <?= json_encode($jenis_indikator) ?>;
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

        $('.hapus-data').click(function(e) {
            e.preventDefault();
            var that = $(this);
            bootbox.confirm({
                message: "Apakah Anda Yakin ingin " + that.data('original-title')+"?",
                callback: function(result) {
                    if (result) {
                        window.location.href = that.attr('href');
                    }
                },
                className: "bootbox-sm"
            });
        });

        $('.s-tooltip').tooltip();
        

        $('.hapus-kegiatan').on('click', function () {
            console.log($(this).data('pk'));    
        });
        // $.fn.editable.defaults.mode = 'inline';

        $("#select_unit").select2({
            placeholder: "Pilih Sub Unit"
        });
        $('#select_unit').on("change", function(e) {
            console.log(e.val)
            window.location.href = '<?php echo(site_url("evaluasi/rpjm/realisasi?hash=")) ?>' + e.val
        });

        $('.e_sasaran_program').editable({
            type: 'select',
            mode: 'inline',
            name: 'sasaran_program_rpjm',
            source : sasaran,
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            }
        });

        $('.e_jenis_indikator').editable({
            type: 'select',
            mode: 'inline',
            name: 'jenis_indikator',
            source : jenis_indikator,
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            }
        });

        $('.e_target_capaian_indikator').editable({
            type: 'text',
            mode: 'inline',
            name: 'target_capaian_indikator',
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            }
        });

        $('.e_target_capaian_satuan').editable({
            type: 'text',
            mode: 'inline',
            name: 'target_capaian_satuan',
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            }
        });
        

         

        $('.e_target_keluaran_indikator').editable({
            type: 'text',
            mode: 'inline',
            name: 'target_keluaran_indikator',
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            }
        });

        $('.e_target_keluaran_satuan').editable({
            type: 'text',
            mode: 'inline',
            name: 'target_keluaran_satuan',
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            }
        });

        $('.e_realisasi_capaian_0').editable({
            type: 'text',
            mode: 'inline',
            name: 'realisasi_capaian_r_rpjm_0' ,
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            },
            display: function(value) {
                $(this).text(accounting.formatNumber(value));
            }
        });
        $('.e_target_realisasi_6').editable({
            type: 'text',
            mode: 'inline',
            name: 'realisasi_capaian_r_rpjm_6' ,
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            },
            display: function(value) {
                $(this).text(accounting.formatNumber(value));
            }
        });
            
        <?php for ($i=0; $i < 6 ; $i++) : ?>
        $('.e_target_realisasi_<?php echo $i ?>').editable({
            type: 'text',
            mode: 'inline',
            name: 'realisasi_capaian_r_rpjm_<?php echo $i ?>' ,
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            },
            display: function(value) {
                $(this).text(accounting.formatNumber(value));
            }
        });

        $('.e_target_keluaran_<?php echo $i ?>').editable({
            type: 'text',
            mode: 'inline',
            name: 'target_keluaran_t_rpjm_<?php echo $i ?>' ,
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            },
            display: function(value) {
                $(this).text(accounting.formatNumber(value));
            }
        });

        $('.e_target_keuangan_<?php echo $i ?>').editable({
            type: 'text',
            mode: 'inline',
            name: 'target_keuangan_t_rpjm_<?php echo $i ?>' ,
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            },
            display: function(value) {
                $(this).text(accounting.formatNumber(value));
            }
        });


        $('.e_realisasi_pagu_rpjm_<?php echo $i ?>').editable({
            type: 'text',
            mode: 'inline',
            name: 'realisasi_pagu_r_rpjm_<?php echo $i ?>' ,
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            },
            display: function(value) {
                $(this).text(accounting.formatNumber(value));
            }
        });


        <?php endfor ?>
    });
</script>

