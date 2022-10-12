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
    <h1><?php _e( " " . Widget::namaOpd($hash), "Data Master")?></h1>
</div>
<div class="panel">
    <div id="select2container" class="panel-body">
        <div class="row">
            <div class="col-md-2">
                <select id="select_unit" class="form-control">
                    <?php echo(Widget::selectSubunit([$user->unit], $hash)) ?>
                </select>
            </div>

            <div class="col-md-2">
                <select id="Triwulan" name="Triwulan" class="form-control">
                    <option value="1" <?= ($tw == 1) ? 'selected' : '' ;  ?> >Triwulan 1</option>
                    <option value="2" <?= ($tw == 2) ? 'selected' : '' ;  ?> >Triwulan 2</option>
                    <option value="3" <?= ($tw == 3) ? 'selected' : '' ;  ?> >Triwulan 3</option>
                    <option value="4" <?= ($tw == 4) ? 'selected' : '' ;  ?> >Triwulan 4</option>
                </select>
            </div>

             <div class="col-md-2">
                <a class="btn btn-success" href="#" data-toggle="modal" data-target="#modal-penghambat">Tambah Item Penghambat</a>
            </div>
        </div>
    </div>
</div>

<div class="table-light table-responsive">                             
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Permasalahan </th>
               
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($penghambat as $key => $value): ?>
            <tr>
                <td><?= $key+1 ?></td>
                <td>
                    <a href="#" id="penghambat" data-type="textarea" data-pk="<?= $value->id ?>" data-url="<?= base_url('evaluasi/permasalahan/update_penghambat') ?>" data-title="Penghambat"><?= $value->penghambat ?></a>
                </td>
               

                <td>
                    <button name="hapus" data-id="<?= $value->id ?>" type="button" class="btn btn-sm btn-primary" aria-label="Left Align" >Hapus <i class="fa fa-trash" aria-hidden="true"></i></button>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>
<div id="modal-penghambat" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Form Input Faktor Penghambat - Triwulan </h4> </div>
            <div class="modal-body">
                <?php echo form_open('', array( 'name' => 'form_penghambat'));?>
               
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Faktor Penghambat</label>
                        <textarea class="form-control"  name="Penghambat"></textarea>
                    </div>
                    
                <?php echo form_close();?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger waves-effect waves-light" name="form_penghambat_simpan">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    init.push(function () {
        $("#select_unit").on("change", function(e) {

            window.location.href = "<?php echo(site_url("evaluasi/permasalahan/penghambat?hash=")) ?>" + $(this).val() + '&tw=' + $('select[name="Triwulan"]').val();
        });
         // $('a#penghambat').each(function(index, el) {
         //     $(this).editable();
         // });

         $('a#tindak_lanjut').editable({
            url: function(params) {
                var d = new $.Deferred();
                if(params.status === false) {
                    return d.reject('gagal memperbarui'); //returning error via deferred object
                } else {
                    //async saving data in js model
                    someModel.asyncSaveMethod({
                      
                       success: function(){
                          d.resolve();
                       }
                    }); 
                    return d.promise();
                }
            }
         });

         $('a#penghambat').editable({
            url: function(params) {
                var d = new $.Deferred();
                if(params.status === false) {
                    return d.reject('gagal memperbarui'); //returning error via deferred object
                } else {
                    //async saving data in js model
                    someModel.asyncSaveMethod({
                      
                       success: function(){
                          d.resolve();
                       }
                    }); 
                    return d.promise();
                }
            }
         });


         $('button[name="hapus"]').click(function() {
            
            var id = $(this).data('id');
             Swal.fire({
                title: 'Hapus',
                text: "Data yang di hapus tidak akan bisa di kembalikan",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url('evaluasi/permasalahan/hapus_penghambat') ?>',
                        type: 'Post',
                        data: {id: id},
                    })
                    .done(function(response) {
                       if (response.status == true) {
                        
                        location.reload();
                       }else{
                        Swal.fire(
                            'gagal!',
                            response.message,
                            'success'
                        )
                       }
                    })
                    .fail(function(err) {
                        Swal.fire(
                            'terdapat error!',
                            err.responseText,
                            'success'
                        )
                    })
                    
                    
                    
                 }
            })
            
            
         });
         
        $('select[name="Triwulan"]').on("change", function(e) {

            window.location.href = "<?php echo(site_url("evaluasi/permasalahan/penghambat?hash=")) ?>" + $("#select_unit").val() + '&tw=' + $('select[name="Triwulan"]').val();
        });

        $('button[name="form_penghambat_simpan"]').click(function() {
            $.ajax({
                url: '<?= base_url('evaluasi/permasalahan/add_penghambat') ?>',
                type: 'POST',
                data: {
                    Penghambat      : $('textarea[name="Penghambat"]').val(),
                    simoneva2019_csrf_token   : $('input[name="simoneva2019_csrf_token"]').val(),
                    Triwulan        : $('select[name="Triwulan"]').val(),
                    hash            : $('#select_unit').val()
                },
                cache: false,
            })
            .done(function(response) {
                if (response.status == true) {
                    // window.location.href = "<?php echo(site_url("evaluasi/permasalahan/penghambat?hash=")) ?>" + $("#select_unit").val() + '&tw=' + $('select[name="Triwulan"]').val();
                }else{
                    alert('terjadi kesalahan')
                }
            })
            .fail(function(err) {
                console.log(err);
            })
            
            
        });
    });
</script>