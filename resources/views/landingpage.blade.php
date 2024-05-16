<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sistem Manajemen Inventory</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/logo-clean.png') }}" rel="icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('/template/frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('/template/frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/template/frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('/template/frontend/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/template/frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/template/frontend/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('/template/frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('/template/frontend/assets/css/style.css') }}" rel="stylesheet">


    <!-- =======================================================
  * Template Name: Vesperr
  * Template URL: https://bootstrapmade.com/vesperr-free-bootstrap-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <div class="logo">
                <h1><a href="index.html">TEKMT</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                    <li><a class="getstarted scrollto" href="/login">Login</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Sistem Manajemen Barang</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">Mengelola penyimpanan barang serta dapat memberikan
                        rekomendasi pemesanan barang.
                    </h2>
                    <div data-aos="fade-up" data-aos-delay="800">
                        <a href="/login" class="btn-get-started scrollto">Get Started</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
                    <img src="{{ asset('assets/img/landing.png') }}" class="img-fluid animated blurred-edge-img"
                        alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">


        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>About Us</h2>
                </div>

                <div class="row content">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
                        <p>
                            Sistem Informasi Manajemen Inventori adalah solusi komprehensif untuk pengelolaan stok
                            barang, yang dirancang untuk membantu bisnis mengoptimalkan operasi inventaris mereka.
                        </p>
                        <ul>
                            <li><i class="ri-check-double-line"></i> Pengelolaan stok barang secara real-time untuk
                                memantau ketersediaan barang</li>
                            <li><i class="ri-check-double-line"></i> Pemberian rekomendasi pemesanan barang berdasarkan
                                analisis data penjualan dan tren permintaan</li>
                            <li><i class="ri-check-double-line"></i> Integrasi dengan sistem API WhatsApp untuk
                                mempercepat dalam berkomunikasi dengan supplier</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
                        <p>
                            Sistem ini juga menyediakan laporan dan analisis mendalam untuk membantu pengambilan
                            keputusan yang lebih baik. Dengan fitur-fitur otomatisasi, bisnis dapat mengurangi kesalahan
                            manusia dan meningkatkan efisiensi operasional.
                        </p>
                        <a href="#" class="btn-learn-more">Pelajari Lebih Lanjut</a>
                    </div>
                </div>


            </div>
        </section><!-- End About Us Section -->


        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Services</h2>
                    <p>Menyediakan solusi terbaik untuk manajemen inventori yang efektif dan efisien</p>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                            <div class="icon"><i class="bx bxl-dribbble"></i></div>
                            <h4 class="title"><a href="">Rekomendasi Pemesanan Barang</a></h4>
                            <p class="description">Memberikan rekomendasi pemesanan barang berdasarkan analisis tren
                                penjualan dan permintaan</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                            <div class="icon"><i class="bx bx-file"></i></div>
                            <h4 class="title"><a href="">Safety Stock</a></h4>
                            <p class="description">Mengelola stok pengaman untuk menghindari kekurangan barang yang
                                kritis</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon"><i class="bx bx-tachometer"></i></div>
                            <h4 class="title"><a href="">Rekomendasi Order Kembali</a></h4>
                            <p class="description">Memberikan notifikasi dan rekomendasi kapan waktu terbaik untuk
                                melakukan pemesanan kembali</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon"><i class="bx bx-world"></i></div>
                            <h4 class="title"><a href="">Pencatatan Barang</a></h4>
                            <p class="description">Fasilitas pencatatan barang yang mudah dan terintegrasi untuk
                                mengelola stok secara efektif</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>



        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Contact Us</h2>
                </div>

                <div class="row">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="contact-about">
                            <h3>Manajemen Inventori</h3>
                            <p>Kami menyediakan solusi terbaik untuk manajemen inventori yang efektif dan efisien.
                                Hubungi kami untuk mengetahui lebih lanjut tentang layanan dan bagaimana kami dapat
                                membantu bisnis Anda.</p>
                            <div class="social-links">
                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
                        <div class="info">
                            <div>
                                <i class="ri-map-pin-line"></i>
                                <p>Jl. Raya No. 123<br>Jakarta, Indonesia 12345</p>
                            </div>

                            <div>
                                <i class="ri-mail-send-line"></i>
                                <p>info@manajemeninventori.com</p>
                            </div>

                            <div>
                                <i class="ri-phone-line"></i>
                                <p>+62 1234 5678 90</p>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12" data-aos="fade-up" data-aos-delay="300">
                        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Your Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Your Email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject"
                                    placeholder="Subject" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
                    </div>

                </div>

            </div>
        </section>


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-12 text-lg-left text-center">
                    <div class="copyright">
                        &copy; Copyright <strong>TEKMT</strong>. All Rights Reserved
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('template/frontend/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('template/frontend/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('template/frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('template/frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('template/frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('template/frontend/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('template/frontend/assets/js/main.js') }}"></script>

</body>

</html>
