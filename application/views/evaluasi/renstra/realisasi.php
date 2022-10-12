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
                <th rowspan="2" style="min-width: 40px">#</th>
                <th rowspan="2">Sasaran</th>
                <th rowspan="2">Kode Rekening</th>
                <th rowspan="2">Urusan/Bidang Urusan Pemerintahan Daerah Dan Program/Kegiatan</th>
                <th rowspan="2">Indikator Kinerja</th>
                <th colspan="5">Realisasi RPJMD/RENSTRA Pada RKPD/RENJA Tahun Ke-</th>
            </tr>
            <tr>
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
                    <td></td>
                    <td><?php _e($key[0]) ?></td>
                    <td colspan="9"><?php _e($key[1]) ?></td>
                </tr>
                <?php foreach ($urusan as $key => $bidang): ?><!-- #BIDANG -->
                    <?php $key = explode('|', $key) ?>
                    <tr bgcolor="#dedede">
                        <td>
                            
                        </td>
                        <td></td>
                        <td><?php _e($key[0]) ?></td>
                        <td colspan="9"><?php _e($key[1]) ?></td>
                    </tr>
                    <?php foreach ($bidang as $key => $program): ?><!-- #PROGRAM -->
                        <?php $key = explode('|', $key) ?>
                        <?php $capaian = array_filter($indikator_capaian, function($x) use ($key){
                            return $x['program_id'] == $key[2];
                        }) ?>
                        <tr bgcolor="#eee">
                            <td>
                                
                            </td>
                            <td><?php make_editable($program[0], 'sasaran_program', ['pk'=>$key[2], 'val'=>'sasaran_program']) ?></td>
                            <td><?php _e($key[0]) ?></td>
                            <td colspan="9"><?php _e($key[1]) ?> </td>
                        </tr>
                        <?php foreach ($capaian as $cap): ?>
                            <tr>
                                <td colspan="4" class="text-right">
                                </td>
                                <td><?php make_editable($cap, 'target_capaian_indikator', ['pk'=>$cap['id'], 'val'=>'indikator']) ?> (<?php make_editable($cap, 'target_capaian_satuan', ['pk'=>$cap['id'], 'val'=>'satuan']) ?>)</td>
                                <td class="text-right"><?php make_editable($cap, 'target_capaian_1', ['pk'=>$cap['id'], 'val'=>'r_renstra_1']) ?></td>
                                <td class="text-right"><?php make_editable($cap, 'target_capaian_2', ['pk'=>$cap['id'], 'val'=>'r_renstra_2']) ?></td>
                                <td class="text-right"><?php make_editable($cap, 'target_capaian_3', ['pk'=>$cap['id'], 'val'=>'r_renstra_3']) ?></td>
                                <td class="text-right"><?php make_editable($cap, 'target_capaian_4', ['pk'=>$cap['id'], 'val'=>'r_renstra_4']) ?></td>
                                <td class="text-right"><?php make_editable($cap, 'target_capaian_5', ['pk'=>$cap['id'], 'val'=>'r_renstra_5']) ?></td>
                            </tr>
                        <?php endforeach ?>
                        <?php foreach ($program as $kegiatan): ?><!-- #KEGIATAN -->
                            <?php $keluaran = array_filter($indikator_keluaran, function($x) use ($kegiatan){
                                return $x['kegiatan_id'] == $kegiatan['kegiatan_id'];
                            }) ?>
                            <tr>
                                <td> </td>
                                <td></td>
                                <td><?php _e($kegiatan['kode_kegiatan']) ?></td>
                                <td colspan="2"><?php _e($kegiatan['nama_kegiatan']) ?> </td>
                               
                                <td class="text-right"><?php make_editable($kegiatan, 'target_keuangan_1', ['pk'=>$kegiatan['kegiatan_id'], 'val'=>'r_renstra_1']) ?></td>
                                <td class="text-right"><?php make_editable($kegiatan, 'target_keuangan_2', ['pk'=>$kegiatan['kegiatan_id'], 'val'=>'r_renstra_2']) ?></td>
                                <td class="text-right"><?php make_editable($kegiatan, 'target_keuangan_3', ['pk'=>$kegiatan['kegiatan_id'], 'val'=>'r_renstra_3']) ?></td>
                                <td class="text-right"><?php make_editable($kegiatan, 'target_keuangan_4', ['pk'=>$kegiatan['kegiatan_id'], 'val'=>'r_renstra_4']) ?></td>
                                <td class="text-right"><?php make_editable($kegiatan, 'target_keuangan_5', ['pk'=>$kegiatan['kegiatan_id'], 'val'=>'r_renstra_5']) ?></td>
                            </tr>
                            <?php foreach ($keluaran as $kel): ?>
                                <tr>
                                    <td colspan="4" class="text-right">
                                       
                                    </td>
                                    <td><?php make_editable($kel, 'target_keluaran_indikator', ['pk'=>$kel['id'], 'val'=>'indikator']) ?> (<?php make_editable($kel, 'target_keluaran_satuan', ['pk'=>$kel['id'], 'val'=>'satuan']) ?>)</td>
                                    <td class="text-right"><?php make_editable($kel, 'target_keluaran_1', ['pk'=>$kel['id'], 'val'=>'r_renstra_1']) ?></td>
                                    <td class="text-right"><?php make_editable($kel, 'target_keluaran_2', ['pk'=>$kel['id'], 'val'=>'r_renstra_2']) ?></td>
                                    <td class="text-right"><?php make_editable($kel, 'target_keluaran_3', ['pk'=>$kel['id'], 'val'=>'r_renstra_3']) ?></td>
                                    <td class="text-right"><?php make_editable($kel, 'target_keluaran_4', ['pk'=>$kel['id'], 'val'=>'r_renstra_4']) ?></td>
                                    <td class="text-right"><?php make_editable($kel, 'target_keluaran_5', ['pk'=>$kel['id'], 'val'=>'r_renstra_5']) ?></td>
                                </tr>
                            <?php endforeach ?>
                        <?php endforeach ?><!-- #KEGIATAN -->
                    <?php endforeach ?><!-- #PROGRAM -->
                <?php endforeach ?><!-- #BIDANG -->
            <?php endforeach ?><!-- #URUSAN -->
        <?php endif ?>
        </tbody>
    </table>
</div>


<script type="text/javascript">
    init.push(function () {


        console.log(<?php $this->session->flashdata('status_add_indikator'); ?>)

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
        

        $('.hapus-kegiatan').on('click', function () {
            console.log($(this).data('pk'));    
        });
        // $.fn.editable.defaults.mode = 'inline';

        $("#select_unit").select2({
            placeholder: "Pilih Sub Unit"
        });
        $('#select_unit').on("change", function(e) {
            console.log(e.val)
            window.location.href = '<?php echo(site_url("evaluasi/renstra/realisasi?hash=")) ?>' + e.val
        });

        

        
        <?php if (app('ubah_renstra') == 0 ) : ?>
            $('.hapus-data').remove();
            $('.tambah-data').remove();
        <?php endif ?>
        
        <?php if (app('hapus_renstra_indikator') == 0 ) : ?>
            $('.hapus-data-indikator').remove();
        <?php endif ?>
        
        <?php if (app('tambah_renstra_indikator') == 0 ) : ?>
            $('.tambah-data-indikator').remove();
        <?php endif ?>
        
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

        <?php if (app('ubah_renstra_indikator') == 1 ) : ?>
        

        $('.e_realisasi_capaian_0').editable({
            type: 'text',
            mode: 'inline',
            name: 'realisaisi_capaian_r_renstra_0' ,
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
        $('.e_realisasi_keluaran_0').editable({
            type: 'text',
            mode: 'inline',
            name: 'realisasi_keluaran_r_renstra_0' ,
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
        <?php endif ?>
        <?php if (app('ubah_renstra_keuangan') == 1 ) : ?>
        $('.e_realisasi_keuangan_0').editable({
            type: 'text',
            mode: 'inline',
            name: 'realisasi_keuangan_r_renstra_0' ,
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
        <?php endif ?>
        <?php for ($i=0; $i < 6 ; $i++) : ?>
        <?php if (app('ubah_renstra_indikator') == 1 ) : ?>
        $('.e_target_capaian_<?php echo $i ?>').editable({
            type: 'text',
            mode: 'inline',
            name: 'target_capaian_r_renstra_<?php echo $i ?>' ,
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
            name: 'target_keluaran_r_renstra_<?php echo $i ?>' ,
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
        <?php endif ?>
        <?php if (app('ubah_renstra_keuangan') == 1 ) : ?>
        $('.e_target_keuangan_<?php echo $i ?>').editable({
            type: 'text',
            mode: 'inline',
            name: 'target_keuangan_r_renstra_<?php echo $i ?>' ,
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
        <?php endif ?>
        <?php endfor ?>
    });
</script>

