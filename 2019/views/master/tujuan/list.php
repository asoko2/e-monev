<?php if ($this->session->flashdata('status_input') != NULL): ?>
    <script type="text/javascript">
        init.push(function () {
            $.growl.notice({ title: "Status", message: "<?php echo $this->session->flashdata('status_input') ?>" });
        });
    </script>
<?php endif ?>

<?php if ($this->session->flashdata('status_add_indikator') != NULL): ?>
    <script type="text/javascript">
        init.push(function () {
            $.growl.notice({ title: "Status", message: "<?php echo $this->session->flashdata('status_add_indikator') ?>" });
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
    <h1><?php _e($page_title, 'Data Master')?></h1>
</div>



<div class="table-light table-responsive">                             
    <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2" style="min-width: 40px">#</th>
                <th rowspan="2">Misi</th>
                <th rowspan="2">Uraian Tujuan / indikator Tujuan</th>
                <th rowspan="2">Jenis Indikator</th>
                <th rowspan="2">Satuan</th>
                <th rowspan="1" colspan="7">Target</th>
                <th rowspan="1" colspan="5">Realisasi</th> 
                <th rowspan="2">aksi</th>
            </tr>
            <tr>
                <th>Tahun Awal</th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>Tahun Akhir</th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
            </tr>
            
             
             

        </thead>
        <tbody>
        <?php if (count($data['tujuan']) > 0): ?>

            <?php foreach ($data['tujuan'] as $k_tujuan => $v_tujuan): ?><!-- #URUSAN -->
                 
                <tr bgcolor="#cdcdcd">
                    <td>
                         <a href="<?php echo site_url('evaluasi/rpjm/hapus_program/' . $v_tujuan->kd_tujuan) ?>" data-toggle="tooltip" data-placement="right"  data-pk="<?php echo $v_tujuan->kd_tujuan ?>" title="" data-original-title="Hapus <?php echo $v_tujuan->kd_tujuan ?>" class="btn btn-danger btn-xs s-tooltip data-program hapus-data"><i class="fa fa-times"></i></a>
                    </td>
                    <td>
                        <?= $v_tujuan->urai_misi ?> 

                    </td>
                    <td colspan="16" >
                        <?= $v_tujuan->uraian ?> 
                          <a data-toggle="tooltip" data-placement="left"  data-pk="<?php echo $v_tujuan->kd_tujuan ?>" title="Tambah indikator" data-original-title="Tambah indikator" class="btn btn-success btn-xs s-tooltip tambah-Indikator" href="<?php echo site_url('master/tujuan/tambah_indikator/' . $v_tujuan->kd_tujuan) ?>"><i class="fa fa-plus"></i></a>

                        
                    </td>
                </tr>

                <?php foreach ($v_tujuan->indikator as $key => $value): ?>
                    <tr>
                        <td>
                             <a href="<?php echo site_url('evaluasi/rpjm/hapus_program/' . $value->kd_indikator) ?>" data-toggle="tooltip" data-placement="right"  data-pk="<?php echo $v_tujuan->kd_tujuan ?>" title="" data-original-title="Hapus <?php echo $v_tujuan->kd_tujuan ?>" class="btn btn-danger btn-xs s-tooltip data-program hapus-data"><i class="fa fa-times"></i></a>
                        </td>
                         <td></td>
                        <td style="padding-left: 5rem"> 
                            <?php make_editable((array) $value, 'indikator_tujuan', ['pk'=>$value->kd_indikator, 'val'=>'uraian']) ?>
                        </td>
                        <td>
                            
                             <?php make_editable((array) $value, 'jenis_indikator', ['pk'=>$value->kd_indikator, 'val'=>'status']) ?>   
                            
                        </td>
                        <td>
                             <?php make_editable((array) $value, 'target_tujuan_satuan', ['pk'=>$value->kd_indikator, 'val'=>'satuan']) ?>
                        </td>
                        <td> <?php make_editable((array) $value, 'vol_awal', ['pk'=>$value->kd_indikator, 'val'=>'vol_awal']) ?> </td>
                        <td> <?php make_editable((array) $value, 'vol_1', ['pk'=>$value->kd_indikator, 'val'=>'vol_1']) ?>   </td>
                        <td> <?php make_editable((array) $value, 'vol_2', ['pk'=>$value->kd_indikator, 'val'=>'vol_2']) ?>    </td>
                        <td> <?php make_editable((array) $value, 'vol_3', ['pk'=>$value->kd_indikator, 'val'=>'vol_3']) ?>  </td>
                        <td> <?php make_editable((array) $value, 'vol_4', ['pk'=>$value->kd_indikator, 'val'=>'vol_4']) ?>   </td>
                        <td> <?php make_editable((array) $value, 'vol_5', ['pk'=>$value->kd_indikator, 'val'=>'vol_5']) ?>   </td>
                        <td> <?php make_editable((array) $value, 'vol_akhir', ['pk'=>$value->kd_indikator, 'val'=>'vol_akhir']) ?> </td>
                        <td> <?php make_editable((array) $value, 'rvol_1', ['pk'=>$value->kd_indikator, 'val'=>'rvol_1']) ?>  </td>
                        <td> <?php make_editable((array) $value, 'rvol_2', ['pk'=>$value->kd_indikator, 'val'=>'rvol_2']) ?>   </td>
                        <td> <?php make_editable((array) $value, 'rvol_3', ['pk'=>$value->kd_indikator, 'val'=>'rvol_3']) ?>    </td>
                        <td> <?php make_editable((array) $value, 'rvol_4', ['pk'=>$value->kd_indikator, 'val'=>'rvol_4']) ?>   </td>
                        <td> <?php make_editable((array) $value, 'rvol_5', ['pk'=>$value->kd_indikator, 'val'=>'rvol_5']) ?>    </td>
                    </tr>
                <?php endforeach ?>
                 
            <?php endforeach ?><!-- #URUSAN -->
        <?php endif ?>
        </tbody>
    </table>
</div>


<script type="text/javascript">
    var misi = <?= json_encode($data['misi']) ?>;
    var jenis_indikator = <?= json_encode($data['jenis_indikator']) ?>;

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

         $('.e_indikator_tujuan').editable({
            type: 'text',
            mode: 'inline',
            name: 'indikator_tujuan_target_uraian',
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
            name: 'tujuan_jenis_indikator',
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

         $('.e_target_tujuan_satuan').editable({
            type: 'text',
            mode: 'inline',
            name: 'indikator_tujuan_target_satuan',
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            }
        });

        $('.e_vol_awal').editable({
            type: 'text',
            mode: 'inline',
            name: 'indikator_tujuan_target_vol_awal' ,
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            },
            display: function(value) {
                if (isNaN(value)) {
                    $(this).text( value);
                }else{
                    
                    $(this).text(accounting.formatNumber(value));
                }
            }
        });

        $('.e_vol_akhir').editable({
            type: 'text',
            mode: 'inline',
            name: 'indikator_tujuan_target_vol_akhir' ,
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            },
            display: function(value) {
                if (isNaN(value)) {
                    $(this).text( value);
                }else{
                    
                    $(this).text(accounting.formatNumber(value));
                }
            }
        });


        <?php for ($i=0; $i < 6 ; $i++) : ?>
        $('.e_vol_<?php echo $i ?>').editable({
            type: 'text',
            mode: 'inline',
            name: 'indikator_tujuan_target_vol_<?php echo $i ?>' ,
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            },
            display: function(value) {
                if (isNaN(value)) {
                    $(this).text( value);
                }else{
                    
                    $(this).text(accounting.formatNumber(value));
                }
            }
        });

         $('.e_rvol_<?php echo $i ?>').editable({
            type: 'text',
            mode: 'inline',
            name: 'indikator_tujuan_realisasi_rvol_<?php echo $i ?>' ,
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            },
            display: function(value) {
                if (isNaN(value)) {
                    $(this).text( value);
                }else{
                    
                    $(this).text(accounting.formatNumber(value));
                }
            }
        });

        <?php endfor ?>

    })

    
</script>

