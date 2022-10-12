<style type="text/css">
    @media print
    {
      table { page-break-after:auto }
      tr    { page-break-inside:avoid; page-break-after:auto }
      td    { page-break-inside:avoid; page-break-after:auto }
      thead { display:table-header-group }
      tfoot { display:table-footer-group }
    }
    @page {
        size: 33cm 21.5cm;
        margin: 10mm 10mm 10mm 10mm; /* change the margins as you want them to be. */
    }
    * {
        font-family: "Arial Narrow", Arial, Tahoma, sans-serif;
        font-size: 8pt;
        line-height: 9pt;
    }
    table {
        border-collapse: collapse;
        border: 0.5pt;
        page-break-inside:auto;
    }
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }
    tfoot { display:table-footer-group }
    th{
        border: 0.5pt solid #252525 !important;
        font-size: 11pt;
        line-height: 13pt;
        font-weight: 700;
        vertical-align:top; 
    }
    td{
        border: 0.5pt solid #252525 !important;
        vertical-align:top; 
        /*word-wrap: break-word;*/
    }

    .noborder {
        border: 0pt !important;
    }

    .text-right {
        text-align: right;
    }
    .tc {
        text-align: center;
    }
</style>

<?php 
    $tc = "style='text-align:center;'";
    function _col($v=1)
    {
        $width = 5*$v;
        echo " style='width:".$width."mm; ' ";
    }

    $opdPrint = Widget::detOpd($opd);

    $verif = Widget::detOpd('4.3.1.1');
?>
<table border="0.5pt" style="width:310mm" >
    <thead>
        <tr>
            <th colspan="20">FORMULIR 1. EVALUASI HASIL RENJA SKPD KABUPATEN BOJONEGORO</th>
        </tr>
        <tr>
            <th colspan="20">PERIODE TRIWULAN <?php _romawi($tw) ?></th>
        </tr>
        <tr>
            <th colspan="20">&nbsp;</th>
        </tr>
        <tr>
            <th style="text-align: left;" colspan="20">OPD : <?php _e(Widget::namaOpd($opd)) ?></th>
        </tr>
        <tr>
            <th style="text-align: left;" colspan="20">&nbsp;</th>
        </tr>
        <tr>
            <th rowspan="2" <?php _col(1) ?>>No</th>
            <th rowspan="2" <?php _col(5) ?>>Sasaran</th>
            <th rowspan="2" <?php _col(8) ?>>Program/Kegiatan</th>
            <th rowspan="2" <?php _col(9) ?>>Indikator Kinerja</th>
            <th rowspan="2" <?php _col(5) ?>>Target RPJMD SKPD pada Tahun <?php _e($list_renstra[5]) ?> (Akhir periode renstra SKPD)</th>
            <th rowspan="2" <?php _col(5) ?>>Realisasi capaian kinerja RPJMD SKPD sampai dengan Tahun <?php _e($list_renstra[$tahunkey]) ?></th>
            <th rowspan="2" <?php _col(5) ?>>Target Kinerja SKPD Tahun Berjalan (Tahun <?php _e($list_renstra[$tahunkey]) ?>) yang dievaluasi</th>
            <th colspan="4" <?php _col(16) ?>>Realisasi Kinerja Pada Triwulan</th>
            <th rowspan="2" <?php _col(5) ?>>Realisasi Capaian Kinerja dan Anggaran RKPD SKPD <?php _e($list_renstra[$tahunkey]) ?> yang dievaluasi</th>
            <th rowspan="2" <?php _col(2) ?>>Tingkat Capaian   Kinerja dan Realissasi Anggaran RKPD <?php _e($list_renstra[$tahunkey]) ?> yang dievaluasi (%)</th>
            <th rowspan="2" <?php _col(5) ?>>Realisasi Kinerja RPJMD SKPD s/d Tahun <?php _e($list_renstra[$tahunkey]) ?></th>
            <th rowspan="2" <?php _col(2) ?>>Tingkat Capaian Kinerja RPJMD SKPD s/d Tahun <?php _e($list_renstra[$tahunkey]) ?> (%)</th>
            <th rowspan="2" <?php _col(2) ?>>SKPD Penanggung Jawab</th>
            <th rowspan="2" <?php _col(2) ?>>Ket.</th>
        </tr>
        <tr>
            <th <?php _col(4) ?>>I</th>
            <th <?php _col(4) ?>>II</th>
            <th <?php _col(4) ?>>III</th>
            <th <?php _col(4) ?>>IV</th>
        </tr>
        <tr>
            <th <?php _col(1) ?>>1</th>
            <th <?php _col(5) ?>>2</th>
            <th <?php _col(8) ?>>3</th>
            <th <?php _col(9) ?>>4</th>
            <th <?php _col(5) ?>>5</th>
            <th <?php _col(5) ?>>6</th>
            <th <?php _col(5) ?>>7</th>
            <th <?php _col(4) ?>>8</th>
            <th <?php _col(4) ?>>9</th>
            <th <?php _col(4) ?>>10</th>
            <th <?php _col(4) ?>>11</th>
            <th <?php _col(5) ?>>12</th>
            <th <?php _col(2) ?>>13</th>
            <th <?php _col(5) ?>>14</th>
            <th <?php _col(2) ?>>15</th>
            <th <?php _col(2) ?>>16</th>
            <th <?php _col(2) ?>>17</th>
        </tr>
    </thead>
    <tbody>
       <?php if (count($data) > 0): ?>
            <?php  
                $f_jml_program = 0;
                $f_total_7 = []; 
                $f_total_8 = []; 
                $f_total_9 = []; 
                $f_total_10 = []; 
                $f_total_11 = []; 
                $f_total_12 = []; 
                $f_rata_anggaran = []; 
                $f_rata_kinerja = [];
                $f_rata_anggaran2 = []; 
                $f_rata_kinerja2 = []; 
            ?>
            <?php foreach ($data as $key => $urusan): ?><!-- #URUSAN -->
               <?php $key = explode("|", $key) ?>
               <tr bgcolor="#cdcdcd">
                   <td></td>
                   <td></td>
                   <td colspan="15"><?php _e($key[0]) ?> - <?php _e($key[1]) ?></td>
               </tr>
               <?php foreach ($urusan as $key => $bidang): ?><!-- #BIDANG -->
                   <?php $key = explode("|", $key) ?>
                   <tr bgcolor="#dedede">
                       <td></td>
                       <td></td>
                       <td colspan="15"><?php _e($key[0]) ?> - <?php _e($key[1]) ?></td>
                   </tr>
                   <?php foreach ($bidang as $key => $program): ?><!-- #PROGRAM -->
                       <?php $key = explode("|", $key) ?>
                       <?php  
                            $p_rata_anggaran = []; 
                            $p_rata_anggaran2 = []; 
                            $p_rata_kinerja = [];
                            $p_rata_kinerja2 = [];
                            $f_jml_program++;
                        ?>
                       <?php $capaian = array_filter($indikator_capaian, function($x) use ($key){
                           return $x["program_id"] == $key[2];
                       }) ?>
                       <tr bgcolor="#eee">
                           <td></td>
                           <td><?php _e($program[0]["sasaran_program"]) ?></td>
                           <td colspan="15"><?php _e($key[0]) ?> - <?php _e($key[1]) ?></td>
                       </tr>
                       <?php foreach ($capaian as $cap): ?>
                           <tr>
                               <td class="text-right"></td>
                               <td class="text-right"></td>
                               <td class="text-right"></td>
                               <td><?php _e($cap["indikator"]) ?> (<?php _e($cap["satuan"]) ?>)</td>
                               <?php for ($i=1; $i < 12; $i++) : ?>
                                <?php if ($i == 9 || $i == 11): ?>
                               <td class="text-right"><?php arr_num($cap, "col$i",2) ?> %</td>
                                <?php else: ?>
                               <td class="text-right"><?php arr_num($cap, "col$i",2) ?></td>
                                <?php endif ?>
                              <?php endfor ?>
                               <td class="text-right"></td>
                               <td class="text-right"></td>
                           </tr>
                       <?php endforeach ?>
                       <?php foreach ($program as $kegiatan): ?><!-- #KEGIATAN -->
                           <?php $keluaran = array_filter($indikator_keluaran, function($x) use ($kegiatan){
                               return $x["kegiatan_id"] == $kegiatan["kegiatan_id"];
                           }) ?>
                            <?php  
                                array_push($f_total_7, $kegiatan['col3']);
                                array_push($f_total_8, $kegiatan['col4']);
                                array_push($f_total_9, $kegiatan['col5']);
                                array_push($f_total_10, $kegiatan['col6']);
                                array_push($f_total_11, $kegiatan['col7']);
                                array_push($f_total_12, $kegiatan['col8']);
                                array_push($f_rata_anggaran, $kegiatan['col9']);
                                array_push($f_rata_anggaran2, $kegiatan['col11']);
                                array_push($p_rata_anggaran, $kegiatan['col9']);
                                array_push($p_rata_anggaran2, $kegiatan['col11']);
                            ?>
                           <tr>
                               <td></td>
                               <td></td>
                               <td colspan="2"><?php _e($kegiatan["kode_kegiatan"]) ?> - <?php _e($kegiatan["nama_kegiatan"]) ?></td>
                              <?php for ($i=1; $i < 12; $i++) : ?>
                              <?php if ($i == 9 || $i == 11): ?>
                               <td class="text-right"><?php arr_num($kegiatan, "col$i",2) ?> %</td>
                                <?php else: ?>
                               <td class="text-right">Rp. <?php arr_num($kegiatan, "col$i",2) ?></td>
                                <?php endif ?>
                              <?php endfor ?>
                              <td class="text-right"></td>
                              <td class="text-right"></td>
                           </tr>
                           <?php foreach ($keluaran as $kel): ?>
                            <?php 
                                array_push($f_rata_kinerja, $kel['col9']);
                                array_push($f_rata_kinerja2, $kel['col11']);
                                array_push($p_rata_kinerja, $kel['col9']);
                                array_push($p_rata_kinerja2, $kel['col11']);
                            ?>
                               <tr>
                                   <td></td>
                                   <td></td>
                                   <td></td>
                                   <td><?php _e($kel["indikator"]) ?> (<?php _e($kel["satuan"]) ?>)</td>
                                   <?php for ($i=1; $i < 12; $i++) : ?>
                                    <?php if ($i == 9 || $i == 11): ?>
                                   <td class="text-right"><?php arr_num($kel, "col$i",2) ?> %</td>
                                    <?php else: ?>
                                   <td class="text-right"><?php arr_num($kel, "col$i",2) ?></td>
                                    <?php endif ?>
                                  <?php endfor ?>
                                   <td class="text-right"></td>
                                   <td class="text-right"></td>
                               </tr>
                           <?php endforeach ?>
                       <?php endforeach ?><!-- #KEGIATAN -->
                       <tr style="font-weight: 700; text-align: right">
                           <td colspan="12">Rata-rata Capaian Anggaran</td>
                           <td><?php echo persen(array_avg($p_rata_anggaran)); ?></td>
                           <td></td>
                           <td><?php echo persen(array_avg($p_rata_anggaran2)); ?></td>
                           <td></td>
                           <td></td>
                       </tr>
                       <tr style="font-weight: 700; text-align: right">
                           <td colspan="12">Predikat Capaian Anggaran</td>
                           <td><?php echo predikat(array_avg($p_rata_anggaran)); ?></td>
                           <td></td>
                           <td><?php echo predikat(array_avg($p_rata_anggaran2)); ?></td>
                           <td></td>
                           <td></td>
                       </tr>
                       <tr style="font-weight: 700; text-align: right">
                           <td colspan="12">Rata-rata Capaian Kinerja</td>
                           <td><?php echo persen(array_avg($p_rata_kinerja)); ?></td>
                           <td></td>
                           <td><?php echo persen(array_avg($p_rata_kinerja2)); ?></td>
                           <td></td>
                           <td></td>
                       </tr>
                       <tr style="font-weight: 700; text-align: right">
                           <td colspan="12">Predikat Capaian Kinerja</td>
                           <td><?php echo predikat(array_avg($p_rata_kinerja)); ?></td>
                           <td></td>
                           <td><?php echo predikat(array_avg($p_rata_kinerja2)); ?></td>
                           <td></td>
                           <td></td>
                       </tr>
                   <?php endforeach ?><!-- #PROGRAM -->
               <?php endforeach ?><!-- #BIDANG -->
           <?php endforeach ?><!-- #URUSAN -->
           <tr style="font-weight: 700; text-align: right">
               <td colspan="6">JUMLAH ANGGARAN DAN REALISASI DARI SELURUH PROGRAM</td>
               <td><?php echo nilai(array_sum($f_total_7)); ?></td>
               <td><?php echo nilai(array_sum($f_total_8)); ?></td>
               <td><?php echo nilai(array_sum($f_total_9)); ?></td>
               <td><?php echo nilai(array_sum($f_total_10)); ?></td>
               <td><?php echo nilai(array_sum($f_total_11)); ?></td>
               <td><?php echo nilai(array_sum($f_total_12)); ?></td>
               <td colspan="5"></td>
           </tr>
           <tr style="font-weight: 700; text-align: right">
               <td colspan="12">Total Rata-rata Capaian Anggaran Dari Seluruh Program ( 1 s/d <?php echo $f_jml_program?>)</td>
               <td><?php echo persen(array_avg($f_rata_anggaran)); ?></td>
               <td></td>
               <td><?php echo persen(array_avg($f_rata_anggaran2)); ?></td>
               <td></td>
               <td></td>
           </tr>
           <tr style="font-weight: 700; text-align: right">
               <td colspan="12">Predikat Capaian Anggaran Seluruh Program ( 1 s/d <?php echo $f_jml_program?>)</td>
               <td><?php echo predikat(array_avg($f_rata_anggaran)); ?></td>
               <td></td>
               <td><?php echo predikat(array_avg($f_rata_anggaran2)); ?></td>
               <td></td>
               <td></td>
           </tr>
           <tr style="font-weight: 700; text-align: right">
               <td colspan="12">Total Rata-rata Capaian Kinerja Seluruh Program ( 1 s/d <?php echo $f_jml_program?>)</td>
               <td><?php echo persen(array_avg($f_rata_kinerja)); ?></td>
               <td></td>
               <td><?php echo persen(array_avg($f_rata_kinerja2)); ?></td>
               <td></td>
               <td></td>
           </tr>
           <tr style="font-weight: 700; text-align: right">
               <td colspan="12">Predikat Capaian Kinerja Seluruh Program ( 1 s/d <?php echo $f_jml_program?>)</td>
               <td><?php echo predikat(array_avg($f_rata_kinerja)); ?></td>
               <td></td>
               <td><?php echo predikat(array_avg($f_rata_kinerja2)); ?></td>
               <td></td>
               <td></td>
           </tr>
           <tr class="noborder">
               <td class="noborder" colspan="17">&nbsp;</td>
           </tr>
           <tr class="noborder">
               <td class="noborder" colspan="12">&nbsp;</td>
               <td class="noborder" colspan="5">Bojonegoro, <?php echo date('j F Y') ?></td>
           </tr>
           <tr class="noborder">
               <td class="noborder tc" colspan="9">Verifikator</td>
               <td class="noborder tc" colspan="8"><?php _e(Widget::namaOpd($opd)) ?></td>
           <tr class="noborder">
               <td class="noborder" colspan="17">&nbsp;</td>
           </tr>
           <tr class="noborder">
               <td class="noborder" colspan="17">&nbsp;</td>
           </tr>
           <tr class="noborder">
               <td class="noborder tc" colspan="9">
                <b><?= app('nama_verifikator') ?></b> <br>
                NIP. <?= app('nip_verifikator') ?> <br>
                <?= app('pangkat_verifikator') ?> <br>
               </td>
               <td class="noborder tc" colspan="8"> 
                <b><?= $opdPrint['nama_kepala'] ?></b> <br>
                NIP. <?= $opdPrint['nip_kepala'] ?> <br>
                <?= $opdPrint['jabatan_kepala'] ?> <br>
                </td>
           </tr>
       <?php endif ?>
    </tbody>
</table>
<script type="text/javascript">
    window.onload = function() { window.print(); }
</script>

