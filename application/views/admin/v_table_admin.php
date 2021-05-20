<!-- Content Header (Page header) -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success text-center">
                    <img width="300px" src="<?= base_url('assets/img/logo-sympas-lite.png') ?>" alt="simpas">
                </div>
                <div class="card-body">

                    <div class="table table-responsive">   
                      <!-- /.content-header -->
                        <table id="table_resi_admin" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal Terima</th>
                                    <th>Nama</th>
                                    <th>Penerima</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tampil_data_paket">
                            <?php
                                $no = 1;
                                foreach($data_desc as $dt):
                                $no++;
                            ?>
                            <!-- <tr>
                                    <td><?= $dt['tgl_terima']?></td>
                                    <td><?= $dt['nama_paket']?></td>
                                    <td><?= $dt['penerima']?></td>
                                    <td style="text-align: center;">
                                        <?php  
                                            if($dt['status_ambil'] == ""):
                                        ?>
                                            <button disabled class="btn btn-danger btn-sm" href="">Belum Diambil</button>
                                        <?php else: ?>
                                            <button class="btn btn-success btn-sm" disabled>Sudah Diambil</button>
                                            <div>
                                                <span><?= $dt["tgl_ambil"] ?></span>
                                            </div>
                                        <?php endif ?>
                                    </td>
                                    
                                    </td>
                                </tr>
                            <?php endforeach ?> -->
                            </tbody>
                        </table> 

                    </div>
                </div>
           </div>
        </div>
    </div>
   

<script >
    //pemanggilan function untuk table paket bukan detail
    tampilPaketBukanDetail()                                        

    function tampilPaketBukanDetail(){
        $.ajax({
            url: '<?= base_url('admin/selecLimitAllAjax') ?>',
            type: "GET",
            dataType: 'JSON',
            success: function(data){
                console.log(data)
                dataku = data.selecLimitAllAjax
                
                $(dataku).each(function(i){
                    if(data.selecLimitAllAjax[i].status_ambil == null){
                        var status_ambil = "<button disabled class='btn btn-danger btn-sm' href=''>Belum Diambil</button>"
                    }else{
                        var status_ambil = "<button class='btn btn-success btn-sm' disabled>Sudah Diambil</button><center>" + data.selecLimitAllAjax[i].status_ambil + "</center>"
                    }
                    console.log(data.selecLimitAllAjax[i].nama_paket)
                    var html = "<tr><td>"+ data.selecLimitAllAjax[i].tgl_terima +"</td><td>"+data.selecLimitAllAjax[i].nama_paket+"</td><td>"+data.selecLimitAllAjax[i].penerima+"</td><td>"+status_ambil+"</td></tr>"
                    $('#tampil_data_paket').append(html)
                })
            }
        })
    }
</script>
