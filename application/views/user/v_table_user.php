    <!-- <link rel="stylesheet" href="<?= base_url('assets/datatable//css/jquery.dataTables.min.css') ?>"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <!-- Content Header (Page header) -->
    <div class="row">
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header bg-success">
                    <strong>
                        <!-- <h1 style="line-height: 0; padding-top: 30px;">SIMPAS LITE</h1>
                        <h5 style="padding-top: 10px; color: white;">Sistem Informasi Paketan Gasek</h5> -->
                        <img width="300px" src="<?= base_url('assets/img/logo-sympas-lite.png') ?>" alt="simpas">
                    </strong>
                </div> 
                <div class="card-body">
 
                    <div class="table table-responsive">   
                      <!-- /.content-header -->
                        <table id="table_resi_user" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal Terima</th>
                                    <th>Nama</th>
                                    <th>HP</th>
                                    <th>Penerima</th>
                                    <th>Pengambil</th>
                                    <th>Jumlah Paket</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($data_asc as $dt): ?>
                                <tr>
                                    <td><?= $dt["tgl_terima"] ?></td>
                                    <td><?= $dt["nama_paket"] ?></td>
                                    <td><?= $dt["hp"] ?></td>
                                    <td><?= $dt["penerima"] ?></td>
                                    <td id="user_ambil"><?= $dt["pengambil"] ?></td>
                                    <td><?= $dt["jml_paket"] ?></td>
                                    <td><?= $dt["jenis_kirim"] ?></td>
                                    <td>
                                        <?php  
                                            if($dt['status_ambil'] == ""):
                                        ?>
                                            <button class="btn btn-danger btn-sm" onclick="modalPengambil($dt['id_paket'])" href="">Belum Diambil</a>
                                        <?php else: ?>
                                            <button class="btn btn-success btn-sm" disabled>Sudah Diambil</button>
                                            <div>
                                                <span><?= $dt["tgl_ambil"] ?></span>
                                            </div>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>     
                            </tbody>
                        </table> 

                    </div>
                </div>
           </div>
        </div>
    </div>

    
    <!-- == -->
    <input type="hidden" id="tgl_ambil" value="<?= date('d-m-Y H:i:s')?>">                                                
  <script src="<?= base_url('assets/datatable/datatables/jquery.dataTables.js') ?>"></script>


    <script>
    var table_resi_detail_user = $('#table_resi_user').DataTable(
        {
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": site_url = "http://"+ window.location.host +"/cek-paketan-ci/user/ajax_list",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": true, //set not orderable
        },
        ],
    }
    ); 
    //modal ambil paket
    function modalPengambil(id) {
        // alert(id)
        var tgl_ambil = $('#tgl_ambil').val()
        // alert(tgl_ambil)
        var modalPengambil = $('#modalPengambil').modal()
        var save = $('#savePengambil').on('click', function(){
            var pengambil = $('#pengambil').val()
            $.ajax({
                url: '<?= base_url('admin/updateNamaPengambil/') ?>' + id,
                type: "POST",
                dataType: 'JSON',
                data: {pengambil: pengambil, id_paket: id, tgl_ambil: tgl_ambil},
                success: function(res){
                    console.log(res)
                    //pemanggilan function untuk table paket bukan detail
                    // tampilPaketBukanDetail()
                    $('#modalPengambil').modal('hide')
                    $('#pengambilTd').html(res.pengambil)
                    $("#pengambil").val("")
                    $("#user_ambil").val(res.pengambil)
                    table_resi_detail_user.ajax.reload(null, false);
                }
            })
        //pemanggilan function untuk table paket bukan detail
            // tampilPaketBukanDetail()
        })
    }
  </script>


