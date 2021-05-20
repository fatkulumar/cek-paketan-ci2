<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SIMPAS - Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
  <script src="https://kit.fontawesome.com/f91d97296d.js" crossorigin="anonymous"></script>

  <!-- Template Main CSS File -->
  <!-- <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet"> -->
  <link href="<?= base_url('assets/css/style_copy3.css') ?>" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url('assets/datatable/css/dataTables.bootstrap4.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/datatable/css/jquery.dataTables.min.css') ?>">

  <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>

  <!-- =======================================================
  * Template Name: Bethany - v2.2.0
  * Template URL: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center bg">
    <div class="container">
      <div class="header-container d-flex align-items-center">
        <div class="logo mr-auto bg-success">
          <h1 class="text-light"><a href=""><span>SIMPAS</span></a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav class="nav-menu d-none d-lg-block">
          <ul>
            <li class="active"><a href="#header">Home</a></li>
            <li><a href="#table">Table</a></li>
            <li><a href="#grafik">Grafik</a></li>
            <!-- <li class="get-started"><a href="#about">Get Started</a></li> -->
          </ul>
        </nav><!-- .nav-menu -->
      </div><!-- End Header Container -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->   
  <section id="hero" class="align-items-center">
    <div class="container position-relative" data-aos="fade-in" data-aos-delay="200">
      <!-- include table  -->
      <div class="row">
        <div class="col-md-6 mb-5">
          <?php $this->load->view('admin/v_edit') ?>
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
      <div class="container position-relative" data-aos="fade-in" data-aos-delay="200">
        <!-- include table  -->
          <div class="col-lg-12">
            <?php $this->load->view('admin/v_table_detail_admin') ?>
          </div>
        </div>
      </div>
    </section><!-- End Hero -->
  <!-- <main> -->


    <!-- ======= Counts Section ======= -->


  <!-- ======= Footer ======= -->
  <footer id="footer">
	  
    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span>Bethany</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter bg-success"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook bg-success"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram bg-success"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus bg-success"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin bg-success"><i class="bx bxl-linkedin"></i></a>
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

  <script src="<?= base_url('assets/datatable/datatables/jquery.dataTables.js') ?>"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/js/main.js') ?>"></script>

</body>

</html> 