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
<script src="<?= base_url('assets/cekmobile.js') ?>"></script>
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
            <li class="acvtive"><a href="<?= base_url('admin') ?>">Home</a></li>
            <li><a href="<?= base_url('admin/grafik_pisah')?>">Grafik</a></li>
            <li><a href="<?= base_url('admin/table_belum_ambil')?>">Belum</a></li>
            <li><a href="<?= base_url('admin/table_sudah_ambil')?>">Sudah</a></li>
            <li><a href="<?= base_url('admin/list_nama_paket')?>">List Nama</a></li>

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


  <!-- ======= Hero Section ======= -->   
  <section id="hero" class="align-items-center">
    <div class="container position-relative" data-aos="fade-in" data-aos-delay="200">
      <!-- include table  -->
      <div class="row">
        <div class="col-md-6 mb-5">
          <?php $this->load->view('admin/v_form_tambah') ?>
        </div> 
        <div class="col-md-6">
          <?php $this->load->view('admin/v_table_admin') ?>
        </div>
      </div> 
    </div>
  </section><!-- End Hero -->
	
  <!-- <main> -->
    <!-- ======= About Section ======= -->
    <section id="table" class="align-items-center">
      <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
        <!-- include table  -->
            <?php $this->load->view('admin/v_table_detail_admin') ?>
      </div>
    </section><!-- End Hero -->
  <!-- <main> -->


    <!-- ======= Counts Section ======= -->
    
  <!-- <main id="main"> -->
	
    <!-- ======= About Section ======= -->
    <!-- <section id="grafik" class="about">
      <div class="container">
      </div>
    </section> -->
    <!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    
  <!-- </main> -->
  <!-- End #main -->

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
        <!-- <a href="https://fatkulumar.wordpress.com/" class="google-plus bg-success" target="_blank"><i class="bx bxl-wordpress"></i></a> -->
        <!-- <a href="https://linkedin.com/in/fatkulumar" class="linkedin bg-success" target="_blank"><i class="bx bxl-linkedin"></i></a> -->
        <!-- <a href="https://fatkulumar.com/" class="linkedin bg-success" target="_blank"><i class="bx bxl-"></i></a> -->
      </div>
    </div> 
  </footer><!-- End Footer -->

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
        <label for="pengambil">Pengambil</label>
        <input class="form-control" type="text" id="pengambil" name="pengambil">
      </div>
      <div class="modal-footer">
        <button type="button" id="closePengambil" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="savePengambil" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal HapusPaket-->
<div class="modal fade" id="modalHapusPaket" tabindex="-1" role="dialog" aria-labelledby="modalHapusPaketLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalHapusPaketLabel">Hapus?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="tampilNamaPaket"></div>
      </div>
      <div class="modal-footer">
        <button type="button" id="closeHapusPaket" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="saveHapusPaket" class="btn btn-primary">Hapus</button>
      </div>
    </div>
  </div>
</div>

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


// function modalPengambil(id) {
//         // alert(id)
//         var tgl_ambil = $('#tgl_ambil').val()
//         var modalPengambil = $('#modalPengambil').modal()
//         var save = $('#savePengambil').on('click', function(){
//           var pengambil = $('#ppengambil').val()
//           $.ajax({
//                 url: '<?= base_url('admin/updateNamaPengambil/') ?>' + id,
//                 type: "POST",
//                 dataType: 'JSON',
//                 data: {pengambil: pengambil, id_paket: id, tgl_ambil: tgl_ambil},
//                 success: function(res){
//                     console.log(res.pengambil)
//                     $('#modalPengambil').modal('hide')
//                     // table_resi_detail_admin.ajax.reload(null, false);
//                 }
//             })
//         })

//         var close = $('#closePengambil').on('click', function(){
//             $('#modalPengambil').modal('hide')
//             table_resi_detail_admin.ajax.reload(null, false);
//         })
//     }

  </script>

</body>

</html> 