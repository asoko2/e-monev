
<div class="page-header">
    <h1><?php _e($page_title . " " . Widget::namaOpd($hash), "Data Master")?></h1>
</div>



<div class="panel">
   
    <div class="panel-body">
        <!-- Default tabs -->
        <ul class="nav nav-tabs nav-tabs-simple">

            <li class="active">
                <a href="#tw-1" data-toggle="tab">Triwulan 1</a>
            </li>
            <li class="">
                <a href="#tw-2" data-toggle="tab">Triwulan 2</a>
            </li>
            <li class="">
                <a href="#tw-3" data-toggle="tab">Triwulan 3</a>
            </li> 
            <li class="">
                <a href="#tw-4" data-toggle="tab">Triwulan 4</a>
            </li>
        </ul> <!-- / .nav -->
        <!-- / Default tabs -->
        <div class="tab-content tab-content">
            
            <div class="tab-pane fade active in" id="tw-1">
                <table id="user" class="table table-bordered table-striped" style="clear: both">
                    <tbody>
                         <tr>
                            <td width="25%">Kode Program</td>
                            <td width="65%"><?= $rkpd->kode_urusan.'.'.$rkpd->kode_bidang.'.'.$rkpd->kode_program ?></td>
                        </tr>
                        <tr>
                            <td width="25%">Nama Program</td>
                            <td width="65%"><?= $rkpd->nama_program?></td>
                        </tr>
                        <tr>
                            <td width="25%">Indikator</td>
                            <td width="65%"><?= $rkpd->indikator ?></td>
                        </tr>
                        <tr>
                            <td width="25%">Target Tahun Ke <?= $tahunkey ?></td>
                            <td width="65%"><?=  $rkpd->{'t_tahun_'.$tahunkey} ?></td>
                        </tr>

                        <tr>
                            <td width="25%">Realisasi</td>
                            <td width="65%"><?= $rkpd->{'r_tahun_'.$tahunkey."_b5"}  ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Isikan Keterangan Di Bawah
                                <button class="btn btn-success pull-right" id="simpan" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> sedang menyimpan"> Simpan</button>
                            </td>
                          
                        </tr>
                        <tr>
                            <td colspan="2">
                            	<div id="note-tw1"><?= (isset($pendukung->note_tw1)) ? $pendukung->note_tw1 : '' ;  ?></div>
                                 
                            </td>
                        </tr> 
                    </tbody>
                </table>
            </div> <!-- / .tab-pane -->

            <div class="tab-pane fade in" id="tw-2">
                <table id="user" class="table table-bordered table-striped" style="clear: both">
                    <tbody>
                        <tr>
                            <td width="25%">Kode Program</td>
                            <td width="65%"><?= $rkpd->kode_urusan.'.'.$rkpd->kode_bidang.'.'.$rkpd->kode_program ?></td>
                        </tr>
                        <tr>
                            <td width="25%">Nama Program</td>
                            <td width="65%"><?= $rkpd->nama_program?></td>
                        </tr>
                        <tr>
                            <td width="25%">Indikator</td>
                            <td width="65%"><?= $rkpd->indikator ?></td>
                        </tr>
                        <tr>
                            <td width="25%">Target Tahun Ke <?= $tahunkey ?></td>
                            <td width="65%"><?=  $rkpd->{'t_tahun_'.$tahunkey} ?></td>
                        </tr>

                        <tr>
                            <td width="25%">Realisasi</td>
                            <td width="65%"><?= $rkpd->{'r_tahun_'.$tahunkey."_b6"}  ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Isikan Keterangan Di Bawah
                            <button class="btn btn-success pull-right" id="simpan" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> sedang menyimpan"> Simpan</button>
                        </td>
                          
                        </tr>
                        <tr>
                            <td colspan="2">
                            	<div id="note-tw2"><?= (isset($pendukung->note_tw2)) ? $pendukung->note_tw2 : '' ;  ?></div>
                                 
                            </td>
                        </tr> 
                    </tbody>
                </table>
            </div> <!-- / .tab-pane -->

            <div class="tab-pane fade in" id="tw-3">
                <table id="user" class="table table-bordered table-striped" style="clear: both">
                    <tbody>
                        <tr>
                            <td width="25%">Kode Program</td>
                            <td width="65%"><?= $rkpd->kode_urusan.'.'.$rkpd->kode_bidang.'.'.$rkpd->kode_program ?></td>
                        </tr>
                        <tr>
                            <td width="25%">Nama Program</td>
                            <td width="65%"><?= $rkpd->nama_program?></td>
                        </tr>
                        <tr>
                            <td width="25%">Indikator</td>
                            <td width="65%"><?= $rkpd->indikator ?></td>
                        </tr>
                        <tr>
                            <td width="25%">Target Tahun Ke <?= $tahunkey ?></td>
                            <td width="65%"><?=  $rkpd->{'t_tahun_'.$tahunkey} ?></td>
                        </tr>

                        <tr>
                            <td width="25%">Realisasi</td>
                            <td width="65%"><?= $rkpd->{'r_tahun_'.$tahunkey."_b7"}  ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Isikan Keterangan Di Bawah
                                 <button class="btn btn-success pull-right" id="simpan" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> sedang menyimpan"> Simpan</button>
                            </td>
                          
                        </tr>
                        <tr>
                            <td colspan="2">
                            	<div id="note-tw3"><?= ($pendukung->note_tw3) ? $pendukung->note_tw3 : '' ;  ?></div>
                                
                            </td>
                        </tr> 
                    </tbody>
                </table>
            </div> <!-- / .tab-pane -->

             <div class="tab-pane fade in" id="tw-4">
                <table id="user" class="table table-bordered table-striped" style="clear: both">
                    <tbody>
                         <tr>
                            <td width="25%">Kode Program</td>
                            <td width="65%"><?= $rkpd->kode_urusan.'.'.$rkpd->kode_bidang.'.'.$rkpd->kode_program ?></td>
                        </tr>
                        <tr>
                            <td width="25%">Nama Program</td>
                            <td width="65%"><?= $rkpd->nama_program?></td>
                        </tr>
                        <tr>
                            <td width="25%">Indikator</td>
                            <td width="65%"><?= $rkpd->indikator ?></td>
                        </tr>
                        <tr>
                            <td width="25%">Target Tahun Ke <?= $tahunkey ?></td>
                            <td width="65%"><?=  $rkpd->{'t_tahun_'.$tahunkey} ?></td>
                        </tr>

                        <tr>
                            <td width="25%">Realisasi</td>
                            <td width="65%"><?= $rkpd->{'r_tahun_'.$tahunkey."_b8"}  ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                            Isikan Keterangan Di Bawah
                            <button class="btn btn-success pull-right" id="simpan" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> sedang menyimpan"> Simpan</button>
                        </td>
                          
                        </tr>
                        <tr>
                            <td colspan="2">
                            	<div id="note-tw4"><?=  ($pendukung->note_tw4) ?  $pendukung->note_tw4 : '' ; ?></div>
                            </td>
                        </tr> 
                    </tbody>
                </table>
                <input type="hidden" name="id_indikator" value="<?= $rkpd->id ?>">
                <input type="hidden" name="tahun_ke" value="<?= $tahunkey ?>">
            </div> <!-- / .tab-pane -->
          
        </div> <!-- / .tab-content -->
    </div>
</div>

<script>
	$(document).ready(function() {
		$('#note-tw1').summernote({
		    placeholder: 'Isikan data pendukung disini',
		    tabsize: 5,
		    height: 600
	  	});
	  	$('#note-tw2').summernote({
		    placeholder: 'Isikan data pendukung disini',
		    tabsize: 5,
		    height: 600
	  	});
	  	$('#note-tw3').summernote({
		    placeholder: 'Isikan data pendukung disini',
		    tabsize: 5,
		    height: 600
	  	});
	  	$('#note-tw4').summernote({
		    placeholder: 'Isikan data pendukung disini',
		    tabsize: 5,
		    height: 600
	  	});

        $('button#simpan').on('click', function(event) {
            var button = $(this);
            button.button('loading');
           $.ajax({
               url: '<?= base_url('evaluasi/renja/data_pendukung') ?>',
               type: 'Post',
               data: {
                        id      : $('input[name="id_indikator"]').val(),
                        tahun_ke      : $('input[name="tahun_ke"]').val(),
                        note_tw1 : $('#note-tw1').summernote('code'),
                        note_tw2 : $('#note-tw2').summernote('code'),
                        note_tw3 : $('#note-tw3').summernote('code'),
                        note_tw4 : $('#note-tw4').summernote('code')
                    },
           })
           .done(function(response) {
               button.button('reset');
               Swal.fire({
                     position: 'top-end',
                      icon: 'success',
                      title: 'data pendukung berhasil disimpan',
                      showConfirmButton: false,
                      timer: 1500
                })
           });
           
           
        });
	  	
	});
 
</script>

<script type="text/javascript"> 
    $(document).ready(function() {
        <?php for ($x=1; $x <= 4; $x++):  ?>
           $('input[name="upload_tw_<?= $x ?>"]').fileupload({
                beforeSend: function(xhr, data) {
                    console.log('sksks');
                    xhr.setRequestHeader('Access-Control-Allow-Origin', '*');
                    xhr.setRequestHeader('Access-Control-Allow-Methods', 'GET,HEAD,OPTIONS,POST,PUT');
                    xhr.setRequestHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept, Authorization');
                },
                send : function (e, data) {
                    
                    $(this).parent().children('.progress').css('display', 'block');
                    $(this).parent().children('input[type="text"]').css('display', 'none');
                    $(this).parent().children('.progress div').css('width', '0%');
                    
                },
                done: function (e, data) {
                   response = data._response.result;
                  
                   if (response.status === true) {
                     
                     console.log('sss');
                   }else{
                        alert(response.message.error);
                   }
                },
                progress : function (e, data) {
                    progress = parseInt(data.loaded / data.total * 100, 10);
                    console.log(progress)
                   
                }
             });

            $('#upload_tw_<?= $x ?>').click(function() {
                $('input[name="upload_tw_<?= $x ?>"]').trigger('click');
            });
        <?php endfor  ?>
        

        
    });
</script>
