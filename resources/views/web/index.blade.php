<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Cloud Desa</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="GIS" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="{{asset('web')}}/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{asset('web')}}/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('admin-lte')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Libraries CSS Files -->
  <link href="{{asset('web')}}/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="{{asset('web')}}/lib/animate/animate.min.css" rel="stylesheet">
  <link href="{{asset('web')}}/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="{{asset('web')}}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="{{asset('web')}}/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('admin-lte')}}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="shortcut icon" href="{{asset('favicon.png')}}">

  <!-- Main Stylesheet File -->
  <link href="{{asset('web')}}/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">

  <!-- =======================================================
    Theme Name: NewBiz
    Theme URL: https://bootstrapmade.com/newbiz-bootstrap-business-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>
  

  <!--==========================
  Header
  ============================-->
  <header id="header" class="fixed-top">
    <div class="container">

      <div class="logo float-left">
        <h2>DESA {{$desa->nama_desa}}</h2>
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li class="active"><a href="#intro">Home</a></li>
          <li><a href="#about">Deskripsi</a></li>
          <li><a href="#why-us">Penduduk</a></li>
          <li><a href="#portfolio">Kegiatan</a></li>
        </ul>
      </nav><!-- .main-nav -->
      
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix">
    <div class="container">

      <div class="intro-img">
        <img src="{{asset($desa->gambar_depan->gambar)}}" alt="" class="img-fluid" width="70%">
      </div>

      <div class="intro-info">
        <h2>Website Resmi Pemerintah<br>Desa {{$desa->nama_desa}}</h2>
        {{-- <div>
          <a href="#about" class="btn-get-started scrollto">Get Started</a>
          <a href="#services" class="btn-services scrollto">Our Services</a>
        </div> --}}
      </div>

    </div>
  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
      <div class="container">

        <header class="section-header">
          <h3>Tentang Desa {{$desa->nama_desa}}</h3>
          <p>{{$desa->deskripsi}}</p>
        </header>
      </div>
    </section><!-- #about -->

  

    <!--==========================
      Why Us Section
    ============================-->
    <section id="why-us" class="wow fadeIn">
      <div class="container">
        <header class="section-header">
          <h3>Penduduk Desa {{$desa->nama_desa}}</h3>
          <p>Laudem latine persequeris id sed, ex fabulas delectus quo. No vel partiendo abhorreant vituperatoribus.</p>
        </header>

        <div class="row row-eq-height justify-content-center">

          <div class="col-lg-4 mb-4">
            <div class="card wow bounceInUp">
                <i class="fa fa-diamond"></i>
              <div class="card-body">
                <h5 class="card-title">Corporis dolorem</h5>
                <p class="card-text">Deleniti optio et nisi dolorem debitis. Aliquam nobis est temporibus sunt ab inventore officiis aut voluptatibus.</p>
                <a href="#" class="readmore">Read more </a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mb-4">
            <div class="card wow bounceInUp">
                <i class="fa fa-language"></i>
              <div class="card-body">
                <h5 class="card-title">Voluptates dolores</h5>
                <p class="card-text">Voluptates nihil et quis omnis et eaque omnis sint aut. Ducimus dolorum aspernatur.</p>
                <a href="#" class="readmore">Read more </a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mb-4">
            <div class="card wow bounceInUp">
                <i class="fa fa-object-group"></i>
              <div class="card-body">
                <h5 class="card-title">Eum ut aspernatur</h5>
                <p class="card-text">Autem quod nesciunt eos ea aut amet laboriosam ab. Eos quis porro in non nemo ex. </p>
                <a href="#" class="readmore">Read more </a>
              </div>
            </div>
          </div>

        </div>

        <div class="row counters">

          <div class="col-lg-4 col-6 text-center">
            <span data-toggle="counter-up">{{$totalPenduduk}}</span>
            <p>Jumlah Penduduk</p>
          </div>

          <div class="col-lg-4 col-6 text-center">
            <span data-toggle="counter-up">{{$totalLaki}}</span>
            <p>Laki Laki</p>
          </div>

          <div class="col-lg-4 col-6 text-center">
            <span data-toggle="counter-up">{{$totalPerempuan}}</span>
            <p>Perempuan</p>
          </div>          
  
        </div>

      </div>
    </section>

    <!--==========================
      Portfolio Section
    ============================-->
    <section id="portfolio" class="clearfix">
      <div class="container">

        <header class="section-header">
          <h3 class="section-title">Kegiatan</h3>
        </header>

        <div class="row">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">Semua</li>
              <li data-filter=".filter-Berita">Berita</li>
              <li data-filter=".filter-Sosial">Sosial</li>
              <li data-filter=".filter-Lomba">Lomba</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container">
          @foreach($kegiatan as $key => $value):
            <div class="col-lg-4 col-md-6 portfolio-item filter-{{$value->kategori}}">
              <div class="portfolio-wrap">
                <img src="{{asset($value->foto_kegiatan)}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4><a href="#">{{$value->judul_kegiatan}}</a></h4>
                  <p>{{$value->kategori}}</p>
                  <div>
                    <a href="img/portfolio/app1.jpg" data-lightbox="portfolio" data-title="App 1" class="link-preview" title="Preview"><i class="ion ion-eye"></i></a>
                    <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach

        </div>

      </div>
    </section><!-- #portfolio -->

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact">
      <div class="container-fluid">

        <div class="section-header">
          <h3>Contact Us</h3>
        </div>

        <div class="row wow fadeInUp">

          <div class="col-lg-6">
            <div class="map mb-4 mb-lg-0">
                {!!$desa->peta!!}
            </div>
          </div>

          <div class="col-lg-6">
            <div class="row">
              <div class="col-md-5 info">
                <i class="ion-ios-location-outline"></i>
                <p>A108 Adam Street, NY 535022</p>
              </div>
              <div class="col-md-4 info">
                <i class="ion-ios-email-outline"></i>
                <p>info@example.com</p>
              </div>
              <div class="col-md-3 info">
                <i class="ion-ios-telephone-outline"></i>
                <p>+1 5589 55488 55</p>
              </div>
            </div>

            <div class="form">
              <div id="sendmessage">Your message has been sent. Thank you!</div>
              <div id="errormessage"></div>
              <form action="" method="post" role="form" class="contactForm">
                <div class="form-row">
                  <div class="form-group col-lg-6">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    <div class="validation"></div>
                  </div>
                  <div class="form-group col-lg-6">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                    <div class="validation"></div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                  <div class="validation"></div>
                </div>
                <div class="text-center"><button type="submit" title="Send Message">Send Message</button></div>
              </form>
            </div>
          </div>

        </div>

      </div>
    </section><!-- #contact -->

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-info">
            <h3>Dalung</h3>
            <p>{{$desa->deskripsi}}</p>
          </div>

        

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Desa {{$desa->nama_desa}}</h4>
            <p>
              {{$desa->alamat}} <br>
              Kuta Utara,<br>
              Badung, Bali <br>
              <strong>Email:</strong> {{$desa->email}}<br>    
              <strong>Telepon:</strong> {{$desa->telepon}}<br>         
            </p>

            {{-- <div class="social-links">
              <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
              <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
            </div> --}}

          </div>

          

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Pemerintah Kabupaten Badung</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=NewBiz
        -->
        {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  <!-- JavaScript Libraries -->
  <script src="{{asset('web')}}/lib/jquery/jquery.min.js"></script>
  <script src="{{asset('web')}}/lib/jquery/jquery-migrate.min.js"></script>
  <script src="{{asset('web')}}/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('web')}}/lib/easing/easing.min.js"></script>
  <script src="{{asset('web')}}/lib/mobile-nav/mobile-nav.js"></script>
  <script src="{{asset('web')}}/lib/wow/wow.min.js"></script>
  <script src="{{asset('web')}}/lib/waypoints/waypoints.min.js"></script>
  <script src="{{asset('web')}}/lib/counterup/counterup.min.js"></script>
  <script src="{{asset('web')}}/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="{{asset('web')}}/lib/isotope/isotope.pkgd.min.js"></script>
  <script src="{{asset('web')}}/lib/lightbox/js/lightbox.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="{{asset('web')}}/contactform/contactform.js"></script>
  <script src="{{asset('admin-lte')}}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- Template Main Javascript File -->
  <script src="{{asset('web')}}/js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDX5i1N1RR3DSQTIRu0ZbIyTgorg7Rhg_g&callback=initMap"></script>
</body>
</html>
