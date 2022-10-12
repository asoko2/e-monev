<?php 
$me = get_instance()->ion_auth->user;
$opd = get_detil_opd($me->unit);

$query = "SELECT
        s.nama_subunit,
        SUM(IFNULL(k.r_tahun_5_b1,0)) as b1,
        SUM(IFNULL(k.r_tahun_5_b2,0)) as b2,
        SUM(IFNULL(k.r_tahun_5_b3,0)) as b3,
        SUM(IFNULL(k.r_tahun_5_b4,0)) as b4,
        SUM(IFNULL(k.r_tahun_5_b5,0)) as b5,
        SUM(IFNULL(k.r_tahun_5_b6,0)) as b6,
        SUM(IFNULL(k.r_tahun_5_b7,0)) as b7,
        SUM(IFNULL(k.r_tahun_5_b8,0)) as b8
        FROM
        kegiatan AS k
        INNER JOIN program AS p ON p.id = k.program_id
        INNER JOIN master_subunit AS s ON s.kode_urusan = p.kode_urusan AND s.kode_bidang = p.kode_bidang AND s.kode_unit = p.kode_unit AND s.kode_subunit = p.kode_subunit
        WHERE concat(lpad(`s`.`kode_urusan`,1,0),lpad(`s`.`kode_bidang`,2,0),lpad(`s`.`kode_unit`,2,0),lpad(`s`.`kode_subunit`,2,0)) = ". $me->unit;
    $chart = $this->db->query($query)->row();
    // var_dump ($chart);
    // die();

?>
<script>
    init.push(function () {
        // Visits Chart Data
        // var visitsChartData = [{
        //     label: 'Target Anggaran',
        //     data: [
        //         [1, <?= $chart->b1 ?>],[2, <?= $chart->b2 ?>],[3, <?= $chart->b3 ?>],[4, <?= $chart->b4 ?>]
        //     ]
        // }, {
        //     label: 'Realisasi Anggaran',
        //     data: [
        //         [1, <?= $chart->b5 ?>],[2, <?= $chart->b6 ?>],[3, <?= $chart->b7 ?>],[4, <?= $chart->b8 ?>]
        //     ],
        //     filledPoints: true // Fill points
        // }];
        

        // // Init Chart
        // $('#jq-flot-graph').pixelPlot(visitsChartData, {
        //     series: {
        //         points: {
        //             show: true
        //         },
        //         lines: {
        //             show: true
        //         }
        //     },
        //     xaxis: {
        //         tickDecimals: 0
        //     },
        //     yaxis: {
        //         tickSize: 1000
        //     }
        // }, {
        //     height: 205,
        //     tooltipText: "'Rp. ' + y + ' Pada Triwulan ' + x"
        // });
    });
</script>
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Tutorial Pengisian E-monev</span>
    </div>
    <div class="panel-body">
        <iframe width="1038px" height="600px" src="https://www.youtube.com/embed/videoseries?list=PLMMnBvnNr0mdn-gz_IVCxiBZ-PI8yh8Mw" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>

<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">Dashboard</span>
    </div>
    <div class="panel-body">
        <!-- Default tabs -->
        <ul class="nav nav-tabs nav-tabs-simple">
<!--             <li class="active">
                <a href="#tabs-home" data-toggle="tab">Statistik</a>
            </li> -->
            <li class="active">
                <a href="#tabs-chart" data-toggle="tab">Grafik OPD Anda</a>
            </li>
            <li>
                <a href="#tabs-profil" data-toggle="tab">Profil Anda</a>
            </li>
            <li>
                <a href="#tabs-opd" data-toggle="tab">Profil OPD Anda</a>
            </li>
        </ul> <!-- / .nav -->
        <!-- / Default tabs -->
        <div class="tab-content tab-content">
            <div class="tab-pane fade active in" id="tabs-chart">
                <div class="graph-container">
                    <div id="jq-flot-graph"></div>
                </div>
            </div> 
            <div class="tab-pane fade" id="tabs-profil">
                <table id="user" class="table table-bordered table-striped" style="clear: both">
                    <tbody>
                        <tr>
                            <td width="25%">username</td>
                            <td width="65%">
                                <?= $me->username?>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">nama</td>
                            <td width="65%">
                                <a href="#" class="e_users" data-type="text" data-pk="<?php echo $me->id; ?>" data-name="users_nama" data-title="Masukkan nama"><?= $me->nama?></a>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">email</td>
                            <td width="65%">
                                <a href="#" class="e_users" data-type="text" data-pk="<?php echo $me->id; ?>" data-name="users_email" data-title="Masukkan email"><?= $me->email?></a>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">level</td>
                            <td width="65%">
                                <?= $me->level?>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">OPD</td>
                            <td width="65%">
                                <?= get_nama_opd($me->unit) ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">Ganti Password ?</td>
                            <td width="65%">
                                <button data-toggle="modal" data-target="#change-pass" class="btn btn-success btn-sm" >Klik untuk ganti password</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> <!-- / .tab-pane -->
            <div class="tab-pane fade" id="tabs-opd">
                <table id="user" class="table table-bordered table-striped" style="clear: both">
                    <tbody>
                        <tr>
                            <td width="25%">Kode OPD</td>
                            <td width="65%">
                                <?= $opd->id?>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">Nama OPD</td>
                            <td width="65%">
                                <?= $opd->nama?>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">Nama Kepala</td>
                            <td width="65%">
                                <a href="#" class="e_opd" data-type="text" data-pk="<?php echo $opd->id; ?>" data-name="opd_nama_kepala" data-title="Masukkan nama kepala"><?= $opd->nama_kepala?></a>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">NIP Kepala OPD</td>
                            <td width="65%">
                                <a href="#" class="e_opd" data-type="text" data-pk="<?php echo $opd->id; ?>" data-name="opd_nip_kepala" data-title="Masukkan nip_kepala"><?= $opd->nip_kepala?></a>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">Pangkat Kepala OPD</td>
                            <td width="65%">
                                <a href="#" class="e_opd" data-type="text" data-pk="<?php echo $opd->id; ?>" data-name="opd_jabatan_kepala" data-title="Masukkan jabatan_kepala"><?= $opd->jabatan_kepala?></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> <!-- / .tab-pane -->
        </div> <!-- / .tab-content -->
    </div>
</div>

<!-- Modal -->
<div id="change-pass" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Ubah Password</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="jq-validation-form">
                    <div class="form-group">
                        <label for="password_lama" class="col-sm-3 control-label">Password Lama</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Password Lama">
                            <p class="help-block">Masukkan Password Lama anda</p>
                        </div>
                    </div>
                    <input type="hidden" name="name" value="ganti_password">
                    <input type="hidden" name="id" value="<?= $me->username ?>">
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Password Baru</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <p class="help-block">Masukkan Password Baru</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_baru" class="col-sm-3 control-label">Konfirmasi Password Baru</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password_baru" name="password_baru" placeholder="Confirm password">
                            <p class="help-block">Ulangi Password Baru</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div> <!-- / .modal-body -->
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div> <!-- /.modal -->
<!-- / Modal -->

<script type="text/javascript">
    init.push(function () {

        $('.e_users').editable({
            type: 'text',
            mode: 'inline',
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            }
        });
        $("#jq-validation-form").submit(function(e) {

            var url = "<?php echo site_url("bypass") ?>"; // the script where you handle the form input.

            e.preventDefault(); // avoid to execute the actual submit of the form.
            $.ajax({
                   type: "POST",
                   url: url,
                   data: $("#jq-validation-form").serialize(), // serializes the form's elements.
                   success: function(data)
                   {
                       bootbox.alert({
                            message: "Sukses",
                            callback: function() {
                                window.location.reload();
                            },
                            className: "bootbox-sm"
                        }); // show response from the php script.
                   }, 
                   error: function(data)
                   {
                       bootbox.alert({
                            message: data.value,
                            className: "bootbox-sm"
                        }); // show response from the php script.
                   }
                 });

        });

        $("#jq-validation-form").validate({
            ignore: '.ignore, .select2-input',
            focusInvalid: false,
            rules: {
                'password_lama': {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },
                'password': {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },
                'password_baru': {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                }
            }
        });

        $('.e_opd').editable({
            type: 'text',
            mode: 'inline',
            url: '<?php echo site_url("bypass") ?>',
            success: function(response, newValue) {
                var res = $.parseJSON(response);
                if (res.status == false) 
                    return res.message

                return {newValue: res.value}
            }
        });
    });
</script>
