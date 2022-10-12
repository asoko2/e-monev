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
    <h1><?php _e("Laporan".$page_title )?></h1>
</div>

 
 
<div class="table-responsive" style="overflow-x:auto;">                             
    <table class="table table-hover">
        <thead>
            <tr>
                <th colspan="3">Nama Laporan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="3">Laporan E.58</td>
            </tr>
            <tr>
                <td width="45px" class="text-right">-</td>
                <td colspan="2">
                    Laporan Renja Triwulan 
                    <?= "<a target='_blank' href='".base_url()."laporan/print_e58' class='btn btn-xs btn-labeled btn-success'><span class='btn-label icon fa fa-print'></span>Print</a>" ?>
                    <?= "<a target='_blank' href='".base_url()."laporan/print_e58/xls' class='btn btn-xs btn-labeled btn-success'><span class='btn-label icon fa fa-print'></span>Excel</a>" ?>
                    
                </td>
            </tr>
             
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
       
        $("#select_unit").select2({
            placeholder: "Pilih Sub Unit"
        });

        $('#select_unit').on("change", function(e) {
            console.log(e.val)
            window.location.href = '<?php echo(site_url("evaluasi/laporan/index?hash=")) ?>' + e.val
        });
    });
</script>
