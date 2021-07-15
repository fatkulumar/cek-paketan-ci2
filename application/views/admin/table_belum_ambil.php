<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SIMPAS - Admin</title>
  <meta content="Cek Paketanmu" name="description">
  <meta content="simpas" name="keywords"> 

  <!-- Favicons -->
  <link href="<?= base_url('assets/img/logo_s.png')?>" rel="icon">
  <link href="<?= base_url('assets/img/logo_s.png')?>" rel="apple-touch-icon">

  <meta property="og:image" content="<?= base_url('assets/img/logo-sympas-lite.png')?>">
  <link itemprop="thumbnailUrl" href="<?= base_url('assets/img/logo-sympas-lite.png')?>">
  <span itemprop="thumbnail" itemscope itemtype="https://schema.org/ImageObject">
  <link itemprop="url" href="<?= base_url('assets/img/logo-sympas-lite.png')?>"> </span>
  <meta property="og:type" content="website" />
  <meta property="og:title" content="Cek Paketanmu">
  <meta property="og:description" content="Jangan numpuk">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/icofont/icofont.min.css') ?>" rel="stylesheet"> 
  <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/venobox/venobox.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/owl.carousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/aos/aos.css') ?>" rel="stylesheet">

  <!-- awesome -->
  <script src="<?= base_url('assets/awesome.js') ?>"></script>

  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets/css/style_copy6.css') ?>" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url('assets/datatable/css/jquery.dataTables.min.css') ?>">
  

  <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>

  <!-- font bebas-neue -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet"> 

  <!-- =======================================================
  * Template Name: Bethany - v2.2.0
  * Template URL: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body style="transform-origin: 0 0;">
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center bg">
    <div class="container">
      <div class="header-container d-flex align-items-center">
        <div class="logo mr-auto bg-success">
          <h1 class="text-light"><a href="<?= base_url('admin') ?>"><img src="<?= base_url('assets/img/logo_s.png') ?>" alt="simpas"></a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>
        <!-- text berjalan  -->
        <div class="running-text"><marquee behavior="" direction="left"><?php foreach($getWarning as $warning) {echo $warning["info"];} ?></marquee></div>
        <a onclick="myInfo()" class="fa fa-edit"></a>

        <nav class="nav-menu d-none d-lg-block">
          <ul>
            <li class="active"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li><a href="<?= base_url('admin/grafik_pisah')?>">Grafik</a></li>
            <li><a href="<?= base_url('admin/table_belum_ambil')?>">Belum</a></li>
            <!-- <li class="get-started"><a href="#about">Get Started</a></li> -->
          </ul>
        </nav><!-- .nav-menu -->
      </div>
      
      <div id="info" style="display: none;">
        <form action="<?= base_url('admin/updateInfo/')?>" method="post">
            <textarea class="form-control" name="info" cols="118" rows="10"><?php foreach($getWarning as $warning) {echo $warning["info"];} ?></textarea>

            <button class="btn btn-sm btn-success" type="submit" name="btn_info">Update</button>
        </form>
      </div>

        <script>
          function myInfo(){
            var x = document.getElementById('info');
            if (x.style.display === 'none') {
                x.style.display = 'block';
            } else {
                x.style.display = 'none';
            }
          }
        </script>

      <!-- End Header Container -->
      <div style="display: none;" class="alert alert-success blok-dismissible fade show" role="alert">
        <strong>Berhasil Tambah</strong> jaga amanatmu ya kak.. ;).
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </header><!-- End Header -->


  
    <!-- ======= Counts Section ======= -->
    
  <main id="hero">
	
    <!-- ======= About Section ======= -->
    <section id="grafik" class="align-items-center">
      <div class="container text-center">
          
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
                        <table id="table_resi_detail_admin_belum" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Kode</th>
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
                                    <td><?= $dt["id_paket"] ?></td>
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

    <!-- Modal Pengambil-->
    <div class="modal fade" id="modalPengambil" tabindex="-1" role="dialog" aria-labelledby="modalPengambilLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalPengambilLabel">Masukkan nama pengambil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <label for="pengambil"><b>Pengambil</b></label>
            <input class="form-control" type="text" id="pengambil" name="pengambil">
        </div>
        <div class="modal-footer">
            <button type="button" id="closePengambil" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="savePengambil" class="btn btn-primary">Save</button>
        </div>
        </div>
    </div>
    </div>

                                            
        <input type="hidden" id="tgl_ambil" value="<?= date('d-m-Y H:i:s')?>">

        <script src="<?= base_url('assets/datatable/datatables/jquery.dataTables.js') ?>"></script>

        <script>
            var table_resi_detail_admin_belum = $('#table_resi_detail_admin_belum').DataTable(
        {
        "processing": true, 
            "serverSide": true, 
            // "order": [], //Initial no order.
    
            "ajax": {
                "url": site_url = "http://"+ window.location.host +"/cek-paketan-ci/Admin/ajax_list_belum",
                "type": "POST"
            },
            //Set column
            // "columnDefs": [
            // { 
            //     "targets": [ 0 ], //first column / numbering column
            //     "orderable": false, //set not orderable
            // },
            // ],
        }
        );

        function modalPengambil(id) {
        // alert(id)
        var tgl_ambil = $('#tgl_ambil').val()
        var modalPengambil = $('#modalPengambil').modal()
        var save = $('#savePengambil').on('click', function(){
            var pengambil = $('#pengambil').val()
            $.ajax({
                url: '<?= base_url('admin/updateNamaPengambil/') ?>' + id,
                type: "POST",
                dataType: 'JSON',
                data: {pengambil: pengambil, id_paket: id, tgl_ambil: tgl_ambil},
                success: function(res){
                    //pemanggilan function untuk table paket bukan detail
                    tampilPaketBukanDetail()
                    $('#modalPengambil').modal('hide')
                    $('#pengambilTd').html(res.pengambil)
                    $("#pengambil").val("")
                    table_resi_detail_admin_belum.ajax.reload(null, false);
                }
            })
        //pemanggilan function untuk table paket bukan detail
            tampilPaketBukanDetail()
            })
        }
        </script>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
	  
    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright 2021 <strong><span>Gasek Multimedia</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/ -->
          Designed by <a href="https://www.ponpesgasek.id/">Gasek Multimedia</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
      <a href="https://twitter.com/ponpesgasek/" class="twitter bg-success" target="_blank"><i class="bx bxl-twitter"></i></a>
        <a href="https://facebook.com/ponpesgasek/" class="facebook bg-success" target="_blank"><i class="bx bxl-facebook"></i></a>
        <a href="https://instagram.com/ponpesgasek/" class="instagram bg-success" target="_blank"><i class="bx bxl-instagram"></i></a>
        <a href="https://www.youtube.com/c/PonpesgasekTV/" class="youtube bg-success" target="_blank"><i class="bx bxl-youtube"></i></a>
        <a href="https://www.ponpesgasek.id/" class="home bg-success" target="_blank"><i class="bx bx-home-alt"></i></a>
      </div>
    </div> 
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <!-- <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script> -->
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/jquery.easing/jquery.easing.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/php-email-form/validate.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/waypoints/jquery.waypoints.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/counterup/counterup.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/isotope-layout/isotope.pkgd.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/venobox/venobox.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/owl.carousel/owl.carousel.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/aos/aos.js') ?>"></script>

  <!-- <script src="<?= base_url('assets/datatable/datatables/jquery.dataTables.js') ?>"></script> -->

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/js/main.js') ?>"></script>
  
  <!-- typed -->
  <!-- <script src="<?= base_url('assets/typed/typed.js/typed.min.js')?>"></script>
  <script src="<?= base_url('assets/typed/main.js')?>"></script> -->

  <script>
  // $(document).ready(function() {
    // $(() => {

    


    // $('#table_resi_detail_admin').DataTable(
      // {
      // "processing": true, 
      //   "serverSide": true, 
      //   "order": [], //Initial no order.
 
      //   "ajax": {
      //       "url": site_url = "http://"+ window.location.host +"/cek-paketan-ci/Admin/ajax_list",
      //       "type": "POST"
      //   },
      //   //Set column
      //   "columnDefs": [
      //   { 
      //       "targets": [ 0 ], //first column / numbering column
      //       "orderable": false, //set not orderable
      //   },
      //   ],
      // }
    // ); 
      

// })
// })




  </script>

</body>

</html> 