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
        .form-container {
            border-radius: 10px;
            /* Biar sudutnya agak melengkung */
            backdrop-filter: blur(10px);
            /* Efek blur kaca */
            -webkit-backdrop-filter: blur(10px);
            /* Support Safari */
            background: rgba(255, 255, 255, 0);
            /* Transparan tapi ada sedikit opacity */
        }

        .custom-input {
            border-radius: 20px;
            /* Bikin inputan lebih smooth */
            border: 1px solid rgba(255, 255, 255, 0.3);
            /* Border transparan */
            background: rgba(255, 255, 255, 0.08);
            /* Background input transparan */
            padding: 10px 15px;
            color: #fff;
            /* Warna teks putih */
        }

        .custom-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
            /* Warna placeholder biar samar */
        }

        .custom-input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.7);
            /* Warna border saat fokus */
            background: rgba(255, 255, 255, 0.3);
        }

        .custom-input-button {
            border-radius: 20px;
            /* Bikin inputan lebih smooth */
            border: 1px solid rgba(255, 255, 255, 0.3);
            /* Border transparan */
            background: rgba(116, 144, 152, 0.9);
            /* Background input transparan */
            padding: 10px 15px;
            color: #fff;
            /* Warna teks putih */
        }

        .custom-input-button::placeholder {
            color: rgba(255, 255, 255, 0.6);
            /* Warna placeholder biar samar */
        }

        .custom-input-button:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.7);
            /* Warna border saat fokus */
            background: rgba(255, 255, 255, 0.3);
        }

        button {
            border-radius: 20px;
            /* Tombol juga dibikin smooth */
        }

        .hidden {
            display: none;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            height: 100%;
        }

        #hero {
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

        .swal2-container {
            position: fixed !important;
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
                    <div class="form-container">
                        <hr> <!-- Garis pemisah -->
                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <input id="myagenda_user_email_login" type="email" class="form-control custom-input @error('myagenda_user_email') is-invalid @enderror" name="myagenda_user_email" value="{{ old('myagenda_user_email') }}" required autocomplete="email" placeholder="Email Sekolah">

                                    @error('myagenda_user_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <input id="myagenda_user_password_login" type="password" class="form-control custom-input @error('myagenda_user_password') is-invalid @enderror" name="myagenda_user_password" required autocomplete="current-password" placeholder="Password">

                                    @error('myagenda_user_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn w-100 form-control custom-input-button">
                                {{ __('Login') }}
                            </button>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img">
                    <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section>


    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK',
                position: 'center',
                backdrop: 'rgba(0, 0, 0, 0.5)',
                didOpen: () => {
                    document.body.style.overflow = 'hidden';
                },
                didClose: () => {
                    document.body.style.overflow = '';
                }
            });
        });
    </script>
    @endif
</body>

</html>