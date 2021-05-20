<link rel="stylesheet" href="<?= base_url('assets/autocomplete/jquery-ui.css') ?>">
<script src="<?= base_url('assets/autocomplete/jquery-ui.js') ?>"></script>


<?php
  $nama_pk = [];
  foreach($nama_paket as $pk){
      $nama = $pk["nama_paket"];
      $hp = $pk["hp"];
      $nama_pk[] = $nama ." - " . $hp;
  }

  $data_paket = implode(",",$nama_pk); 

  $hp_pk = [];
  foreach($nama_paket as $hp){
      $hp = $hp["hp"];
      $hp_pk[] = $hp;
  }

  $data_hp = implode(",",$hp_pk);

  // $hp_g_nama = [$nama_pk, $hp_pk];
  
  // echo json_encode($hp_g_nama); 
?>

  
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header bg-success text-center"><strong><h1>Tambah Data</strong></div>
          <div class="card-body">

            <form id="tambah" class="mt-3 mb-3" action="<?= base_url('admin/tambah_aksi') ?>" method="POST">
                <input type="hidden" value="<?= date("d-m-Y h:i:s") ?>" name="tgl_terima">
                <div class="form-group">
                    <div style="color: red; display: none;" id="error_no_hp">Kosong</div>
                    <label for="no_hp">Hp</label>
                    <input id="no_hp" class="form-control" type="number" name="no_hp" placeholder="085">
                </div>

                <div class="form-group">
                  <div style="color: red; display: none;" id="error_nama_paket">Kosong</div>
                    <label for="nama_paket">Nama Paketan</label>
                    <input id="nama_paket" class="form-control" type="text" name="nama_paket" >
                </div>
                
                <div class="form-group">
                    <label for="penerima">Penerima</label>
                    <select id="penerima" class="form-control" name="penerima">
                      <option value="Gasmul">Gasmul</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jml_paket">Jumlah Paket</label>
                    <select id="jml_paket" class="form-control" name="jml_paket">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                    </select>
                </div>
                
                <div class="form-group">
                  <label for="jenis_kirim">Jenis</label>
                  <p>
                    <input type="radio" name="jenis_kirim" value="Langsung" checked="checked" /> Langsung
                    <input type="radio" name="jenis_kirim" value="COD"> COD
                  </p>
                </div>

                <div>
                    <!-- <button id="add" class="btn btn-success btn-sm" type="submit" name="add">Tambah Resi</button> -->
                    <a class="btn btn-sm btn-danger"  id="add">Tambah Data</a>
                </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    
    <!-- <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script> -->
<script>

  
  $('#no_hp').on('change', function() {
    var no_hp = $('#no_hp').val()
    console.log(no_hp)
    $.ajax({
      url: "<?= base_url('admin/filter_hp')?>",
      type: "POST",
      data: {no_hp: no_hp},
      dataType: "JSON",
      success: function(data) {
        console.log(data)
        $('#nama_paket').val(data.nama_hp.nama_paket)
      }
    })
  })

  $('#nama_paket').on('change', function() {
    var nama_paket = $('#nama_paket').val()
    var panjang_awal = nama_paket.length - 15
    var panjang_akhir = nama_paket.length
    var potong = nama_paket.substring(nama_paket, panjang_awal, panjang_akhir)
    $('#nama_paket').val(potong)
    console.log(nama_paket)
    $.ajax({
      url: "<?= base_url('admin/filter_nama_paket')?>",
      type: "POST",
      data: {nama_paket: potong},
      dataType: "JSON",
      success: function(data) {
        console.log(data)
        $('#no_hp').val(data.nama_paket.hp)
      }
    })
  })

  var data_paket = <?= json_encode($nama_pk) ?>;
  $("#nama_paket").autocomplete({
    source: data_paket
  });
  
  var data_hp = <?= json_encode($hp_pk) ?>;
  $("#no_hp").autocomplete({
    source: data_hp
  });

  $('#add').on('click', function(){ 
    // alert('dad')
    var nama_paket = $('#nama_paket').val()
    var no_hp = $('#no_hp').val()
    var data = $('#tambah').serialize()
    // alert(data)
    var validasi_angka = /^[0-9]+$/;


    if(no_hp < 11){
      alert("Masukan Nomor Hp Yang Valid")
    }

    if(!no_hp.match(validasi_angka)){
      alert("Massukan Angka")
    }

    if(no_hp.length > 13) {
      alert("No Hp Lebih Dari 13 Angka")
    }

    if(nama_paket == ""){
      $('#error_nama_paket').show()
      $('html, body').animate({scrollTop:0}, 'slow');
    }else{
      $('#error_nama_paket').hide()
    }
    if(no_hp == ""){
      $('#error_no_hp').show()
      $('html, body').animate({scrollTop:0}, 'slow');
    }
    else{
      $('#error_no_hp').hide()
    }
    if(nama_paket != "" && no_hp != "") {
      $.ajax({
        url: '<?= base_url('admin/tambah_aksi') ?>',
        type: 'POST',
        data : data,
        dataType: 'JSON',
        success: function(data) {
          var id_akhir = data.id_akhir['id_paket']
          var tgl_terima = data.tgl_terima
          var name_paket = data.nama_paket
          var no_hp = data.hp
          var penerima = data.penerima
          var jenis_kirim = data.jenis_kirim
          var jml_paket = data.jml_paket
          var html = "<tr><td>"+ tgl_terima +"</td><td>"+ nama_paket +"</td><td>"+ penerima +"</td><td  style='text-align: center;'><button dissable class='btn btn-sm btn-danger'>Belum Diambil</button></td></tr>"
          var html_detail = "<tr><td>" + tgl_terima + "</td><td>"+ nama_paket +"</td><td>"+ no_hp +"</td><td>"+ penerima +"</td><td>"+ jenis_kirim +"</td><td></td><td>"+jml_paket+"</td><td style='text-align: center;'><a class='btn btn-danger btn-sm' onclick='userInput("+id_akhir+")' href=''>Belum Diambil</a><div><span></span></div></td><td><a class='btn btn-sm btn-danger' onclick='return confirm('Yakin Hapus '"+ nama_paket + "'?')' href='<?= base_url('admin/hapus_data/') ?>"+id_akhir+"'><i class='fa fa-trash' aria-hidden='true'></i></a><a class='btn btn-sm btn-success' href='<?= base_url('admin/edit_data/') ?>"+id_akhir+"'><i class='fa fa-edit' aria-hidden='true'></i></a></td></tr>"
          $('#nama_paket').val('')
          $('#no_hp').val('')
          $('#tampil_data_paket').prepend(html)            
          $('#tampil_data_paket_detail').prepend(html_detail)   
          $('html, body').animate({scrollTop:0}, 'slow');
          $('.alert').show()  
        }
      })
    }
  })
</script>