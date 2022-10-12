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
    <h1><?php _e("Faktor Penghambat")?></h1>
</div>
<div class="panel">
    <div id="select2container" class="panel-body">
        <div class="row">
             

             

             <div class="col-md-2">
                <a class="btn btn-success" href="#" data-toggle="modal" data-target="#modal-pendorong">Tambah Item Penghambat</a>
            </div>
        </div>
    </div>
</div>

<div class="table-light table-responsive">                             
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Faktor Penghambat </th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($pendorong as $key => $value): ?>
            <tr>
                <td><?= $key+1 ?></td>
                <td>
                    <a href="#" id="pendorong" data-type="textarea" data-pk="<?= $value->id ?>" data-url="<?= base_url('evaluasi/rpjm/update_penghambat') ?>" data-title="pendorong"><?= $value->penghambat ?></a>
                </td>
               

                <td>
                    <button name="hapus" data-id="<?= $value->id ?>" type="button" class="btn btn-sm btn-primary" aria-label="Left Align" >Hapus <i class="fa fa-trash" aria-hidden="true"></i></button>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>
<div id="modal-pendorong" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Form Input Faktor Pendorong - Triwulan </h4> </div>
            <div class="modal-body">
                <form name="form_penghambat">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Faktor Pendorong</label>
                        <textarea class="form-control"  name="Pendorong"></textarea>
                    </div>
                    <!-- 
                    <div class="form-group">
                        <label for="message-text" class="control-label">Rencana Tindak Lanjut</label>
                        <textarea class="form-control" name="tindak_lanjut"></textarea>
                    </div> 
                    -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger waves-effect waves-light" name="form_pendorong_simpan">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    init.push(function () {
       
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

         $('a#pendorong').editable({
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
                        url: '<?= base_url('evaluasi/rpjm/hapus_penghambat') ?>',
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


         
        

        $('button[name="form_pendorong_simpan"]').click(function() {
            $.ajax({
                url: '<?= base_url('evaluasi/rpjm/add_penghambat') ?>',
                type: 'POST',
                data: {
                    penghambat      : $('textarea[name="Pendorong"]').val(),
                    // tindak_lanjut   : $('textarea[name="tindak_lanjut"]').val(),
                    Triwulan        : $('select[name="Triwulan"]').val(),
                    hash            : $('#select_unit').val()
                },
            })
            .done(function(response) {
                if (response.status == true) {
                    location.reload();
                }else{
                    alert('terjadi kesalahan')
                }
            })
            
            
        });
    });
</script>