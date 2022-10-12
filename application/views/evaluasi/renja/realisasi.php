<?php if ($this->session->flashdata("status_input") != NULL): ?>
    <script type="text/javascript">
        init.push(function () {
            $.growl.notice({ title: "Status", message: "<?php echo $this->session->flashdata("status_input") ?>" });
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
<script type="text/javascript">
    init.push(function () {

        accounting.settings = {
            currency: {
                symbol : "Rp.",   // default currency symbol is "$"
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
<div class="page-header">
    <h1><?php _e($page_title . " " . Widget::namaOpd($hash), "Data Master")?></h1>
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
                <th rowspan="2">Kode <br>Rekening</th>
                <th rowspan="2">Urusan/Bidang Urusan<br> Pemerintahan Daerah <br>Dan Program/Kegiatan</th>
                <th rowspan="2">Indikator Kinerja</th>
                <th rowspan="2">Target Renstra <br> Akhir Periode</th>
                <th rowspan="2">TARGET DPA <br>Pada Tahun <?php _e($tahun) ?></th>
                <th colspan="12">Realisasi pada TRIWILAN Ke</th>
            </tr>
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($data) > 0): ?>
            <?php foreach ($data as $key => $urusan): ?><!-- #URUSAN -->
                <?php $key = explode("|", $key) ?>
                <tr bgcolor="#cdcdcd">
                    <td></td>
                    <td><?php _e($key[0]) ?></td>
                    <td colspan="8"><?php _e($key[1]) ?></td>
                </tr>
                <?php foreach ($urusan as $key => $bidang): ?><!-- #BIDANG -->
                    <?php $key = explode("|", $key) ?>
                    <tr bgcolor="#dedede">
                        <td></td>
                        <td><?php _e($key[0]) ?></td>
                        <td colspan="8"><?php _e($key[1]) ?></td>
                    </tr>
                    <?php foreach ($bidang as $key => $program): ?><!-- #PROGRAM -->
                        <?php $key = explode("|", $key) ?>
                        <?php $capaian = array_filter($indikator_capaian, function($x) use ($key){
                            return $x["program_id"] == $key[2];
                        }) ?>
                        <tr bgcolor="#eee">
                            <td><?php _e($program[0]["sasaran_program"]) ?></td>
                            <td><?php _e($key[0]) ?></td>
                            <td colspan="8"><?php _e($key[1]) ?></td>
                        </tr>
                        <?php foreach ($capaian as $cap): ?>
                            <tr>
                                <td colspan="3" class="text-right">
                                   
                                </td>
                                <td><?php _e($cap["indikator"]) ?> (<?php _e($cap["satuan"]) ?>)</td>
                                <td class="text-right"><?php _e(_n($cap["t_renstra_0"])) ?></td>
                                <td class="text-right"><?php make_editable($cap, "realisasi_capaian_0", ["pk"=>$cap["id"], "val"=>"t_tahun_$tahunkey"]) ?></td>
                                <?php for ($i=5; $i < 9; $i++) : ?>
                                <?php $cap_class = "realisasi_capaian_".$i; ?>
                                <?php $cap_val = "r_tahun_".$tahunkey."_b".$i; ?>
                                <td class="text-right"><?php make_editable($cap, $cap_class, ["pk"=>$cap["id"], "val"=>$cap_val]) ?></td>
                               <?php endfor ?>
                            </tr>
                        <?php endforeach ?>
                        <?php foreach ($program as $kegiatan): ?><!-- #KEGIATAN -->
                            <?php $keluaran = array_filter($indikator_keluaran, function($x) use ($kegiatan){
                                return $x["kegiatan_id"] == $kegiatan["kegiatan_id"];
                            }) ?>
                            <tr>
                                <td></td>
                                <td><?php _e($kegiatan["kode_kegiatan"]) ?></td>
                                <td colspan="2"><?php _e($kegiatan["nama_kegiatan"]) ?></td>
                               <td class="text-right"><?php _e(_n($kegiatan["t_renstra_0"])) ?></td>
                               <td class="text-right"><?php make_editable($kegiatan, "realisasi_keuangan_0", ["pk"=>$kegiatan["kegiatan_id"], "val"=>"t_tahun_$tahunkey"]) ?></td>
                               <?php for ($i=5; $i < 9; $i++) : ?>
                                <?php $keg_class = "realisasi_keuangan_".$i; ?>
                                <?php $keg_val = "r_tahun_".$tahunkey."_b".$i; ?>
                               <td class="text-right"><?php make_editable($kegiatan, $keg_class, ["pk"=>$kegiatan["kegiatan_id"], "val"=>$keg_val]) ?></td>
                               <?php endfor ?>
                            </tr>
                            <?php foreach ($keluaran as $kel): ?>
                                <tr>
                                    <td colspan="3" class="text-right">
                                       
                                    </td>
                                    <td><?php _e($kel["indikator"]) ?> (<?php _e($kel["satuan"]) ?>)</td>
                                    <td class="text-right"><?php _e(_n($kel["t_renstra_0"])) ?></td>
                                    <td class="text-right"><?php make_editable($kel, "realisasi_keluaran_0", ["pk"=>$kel["id"], "val"=>"t_tahun_$tahunkey"]) ?></td>
                                    <?php for ($i=5; $i < 9; $i++) : ?>
                                    <?php $kel_class = "realisasi_keluaran_".$i; ?>
                                    <?php $kel_val = "r_tahun_".$tahunkey."_b".$i; ?>
                                    <td class="text-right"><?php make_editable($kel, $kel_class, ["pk"=>$kel["id"], "val"=>$kel_val]) ?></td>
                                   <?php endfor ?>
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

        // $(".fnumber").each(function() {
        //     // console.log($(this).text());
        //     $(this).text(accounting.formatNumber($(this).text()));
        // });

        $(".s-tooltip").tooltip();
        

        $(".hapus-kegiatan").on("click", function () {
            console.log($(this).data("pk"));    
        });
        // $.fn.editable.defaults.mode = "inline";

        $("#select_unit").select2({
            placeholder: "Pilih Sub Unit"
        });
        $("#select_unit").on("change", function(e) {
            console.log(e.val)
            window.location.href = "<?php echo(site_url("evaluasi/renja/realisasi?hash=")) ?>" + e.val
        });

        <?php for ($i=0; $i < 13; $i++) : ?>

        <?php $keg_class = "realisasi_keuangan_".$i; ?>
        <?php $keg_val = "realisasi_keuangan_r_tahun_".$tahunkey."_b".$i; ?>
        <?php $kel_class = "realisasi_keluaran_".$i; ?>
        <?php $kel_val = "realisasi_keluaran_r_tahun_".$tahunkey."_b".$i; ?>
        <?php $cap_class = "realisasi_capaian_".$i; ?>
        <?php $cap_val = "realisasi_capaian_r_tahun_".$tahunkey."_b".$i; ?>

        <?php if ($i == 0 ): ?>
            <?php $keg_val = "realisasi_keuangan_t_tahun_".$tahunkey; ?>
            <?php $kel_val = "realisasi_keluaran_t_tahun_".$tahunkey; ?>
            <?php $cap_val = "realisasi_capaian_t_tahun_".$tahunkey; ?>
        <?php endif ?>

        <?php if (($i != app('triwulan_aktif_4')+4 && $i != app('triwulan_aktif_3')+4  && $i != app('triwulan_aktif_2')+4 && $i != app('triwulan_aktif_1')+4) || app('tahun_aktif') != $tahunkey) : ?>
        $(".e_<?php echo $keg_class ?>").each(function() {
            $(this).text(accounting.formatNumber($(this).text()));
        });
        $(".e_<?php echo $kel_class ?>").each(function() {
            $(this).text(accounting.formatNumber($(this).text()));
        });
        $(".e_<?php echo $cap_class ?>").each(function() {
            $(this).text(accounting.formatNumber($(this).text()));
        });
        <?php else: ?>                                                
        $(".e_<?php echo $keg_class ?>").editable({
            type: "text",
            mode: "inline",
            name: "<?php echo $keg_val ?>" ,
            url: "<?php echo site_url("bypass") ?>",
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
        $(".e_<?php echo $kel_class ?>").editable({
            type: "text",
            mode: "inline",
            name: "<?php echo $kel_val ?>" ,
            url: "<?php echo site_url("bypass") ?>",
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
        $(".e_<?php echo $cap_class ?>").editable({
            type: "text",
            mode: "inline",
            name: "<?php echo $cap_val ?>" ,
            url: "<?php echo site_url("bypass") ?>",
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

