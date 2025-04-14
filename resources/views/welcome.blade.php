<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Page - Login</title>

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            height: 100%;
        }

        #hero {
            padding: 15% 0%;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            box-sizing: border-box;
        }

        .container {
            max-width: 1450px;
            width: 100%;
        }

        .fixed-top {
            position: fixed;
            top: 30px;
            right: 0;
            left: 0;
            z-index: 1030;
        }

        .forgot-password {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">
            <h1 class="logo me-auto"><a href="index.html">My Agenda</a></h1>
            <nav id="navbar" class="navbar">
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>

    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1">
                    <h1>Solusi Pintar untuk Agenda Sekolah</h1>
                    <h2>Aplikasi manajemen agenda untuk sekolah yang lebih teratur dan efektif.</h2>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="{{ route('login') }}" class="btn-get-started scrollto">Login</a> &nbsp; &nbsp;
                        <a href="{{ route('register') }}" class="btn-get-started scrollto">Register</a>
                    </div>
                    <!-- <div class="forgot-password d-flex justify-content-start ms-5 ps-3">
                        <a href="{{ route('password.request') }}" style="font-size: 14px; color:rgb(222, 213, 171);">Lupa Password?</a>
                    </div> -->

                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img">
                    <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section>
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Tentang Kami</h2>
            </div>

            <div class="row content">
                <div class="col-lg-6">
                    <p>
                        MyAgenda adalah solusi digital untuk mengelola dan mendokumentasikan berbagai kegiatan sekolah dengan mudah dan efisien.
                    </p>
                    <ul>
                        <li><i class="ri-check-double-line"></i> Mencatat dan mengelola agenda sekolah secara terstruktur</li>
                        <li><i class="ri-check-double-line"></i> Menyediakan fitur unggah foto dan video untuk dokumentasi</li>
                        <li><i class="ri-check-double-line"></i> Memastikan setiap kegiatan tercatat dengan baik</li>
                    </ul>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0">
                    <p>
                        Dengan MyAgenda, setiap kegiatan sekolah dapat terdokumentasi dengan baik, sehingga transparansi dan efektivitas dalam manajemen sekolah semakin meningkat.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>