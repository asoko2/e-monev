<style type="text/css">
    .editable-click, a.editable-click, a.editable-click:hover {
        color:#e35442!important;
        border-bottom: dashed 0px !important;
    }

    th {
        vertical-align: middle !important;
    }
</style>
<div class="page-header">
    <h1><?php _e($page_title . " " . Widget::namaOpd($hash), "Laporan")?></h1>
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
<?php if ($hash !=''): ?>
<div class="table-responsive" style="overflow-x:auto;">                             
    <table class="table table-hover">
        <thead>
            <tr>
                <th colspan="3">Nama Laporan</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td colspan="3">Laporan RPJMD</td>
            </tr>
            <tr>
                <td width="45px" class="text-right">-</td>
                <td colspan="2">
                    Laporan E.58
                    <?= "<a target='_blank' href='".base_url()."laporan/print_e58' class='btn btn-xs btn-labeled btn-success'><span class='btn-label icon fa fa-print'></span>Print</a>" ?>
                    <?= "<a target='_blank' href='".base_url()."laporan/print_e58/xls' class='btn btn-xs btn-labeled btn-primary'><span class='btn-label icon fa fa-file-excel-o'></span>Excel</a>" ?>
                    
                </td>
            </tr>
            <tr>
                <td colspan="3">Laporan Renja</td>
            </tr>
            <tr>
                <td width="45px" class="text-right">-</td>
                <td colspan="2">Laporan Renja Triwulan</td>
            </tr>
            <?php for ($i=1; $i < 5; $i++) : ?>
                <?php $url = site_url('evaluasi/laporan/triwulan/'.$hash.'/'.$i) ?>
                <?php $url_full = site_url('evaluasi/laporan/triwulan_full/'.$hash.'/'.$i) ?>
            <tr>
                <td width="45px" class="text-right"></td>
                <td width="45px" class="text-right">-</td>
                <td>Laporan Renja Triwulan <?php _e($i) ?> <?php make_button($url, 'all') ?> 
                <?php if ($this->ion_auth->is_admin()): ?>
                <?= "<a target='_blank' href='".$url_full."/print' class='btn btn-xs btn-labeled btn-success'><span class='btn-label icon fa fa-print'></span>Print full</a>" ?>
                    
                </td>
                <?php endif ?>
            </tr>
            <?php endfor ?>
            <!-- <tr>
                <td colspan="3">Laporan Renstra <?php make_button(site_url('evaluasi/laporan/renstra/'.$hash), 'all') ?></td>
            </tr> -->
            <?php if ($this->ion_auth->is_admin()): ?>
            <tr>
                <td width="45px" class="text-right">-</td>
                <td colspan="2">Laporan RKPD Triwulan</td>
            </tr>
            <?php for ($i=1; $i < 5; $i++) : ?>
                <?php $url = site_url('evaluasi/laporan/rkpd/'.$hash.'/'.$i) ?>
            <tr>
                <td width="45px" class="text-right"></td>
                <td width="45px" class="text-right">-</td>
                <td>Laporan RKPD Triwulan <?php _e($i) ?> <?php make_button($url, 'all') ?></td>
            </tr>
            <?php endfor ?>
            
            <tr>
                <td colspan="3">Laporan RPJMD <?php make_button(site_url('evaluasi/laporan/rpjmd'), 'all') ?></td>
            </tr>
            <?php endif ?>
        </tbody>
    </table>
</div>
    
<?php endif ?>

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
       
        $("#select_unit").select2({
            placeholder: "Pilih Sub Unit"
        });

        $('#select_unit').on("change", function(e) {
            console.log(e.val)
            window.location.href = '<?php echo(site_url("evaluasi/laporan/index?hash=")) ?>' + e.val
        });
    });
</script>
