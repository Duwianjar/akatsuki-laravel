
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Team Akatsuki</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="{{  asset('dashboard') }}/assets/img/akatsuki.png" rel="icon" />
    <link href="{{  asset('dashboard') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="{{  asset('dashboard') }}/assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="{{  asset('dashboard') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{  asset('dashboard') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="{{  asset('dashboard') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="{{  asset('dashboard') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="{{  asset('dashboard') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="{{  asset('dashboard') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
    <!-- Template Main CSS File -->
    <link href="{{  asset('dashboard') }}/assets/css/style.css?<?php echo time(); ?>" rel="stylesheet" />
    <link href="{{  asset('dashboard') }}/assets/css/login.css?<?php echo time(); ?>" rel="stylesheet" />

</head>

<body>

<!-- Start Header Navbar -->
<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <h1 class="logo me-auto"><a href="index.html">Akatsuki</a></h1>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="javascript:void(0);" onclick="navigateHome()">Home</a></li>
                <li><a class="nav-link scrollto" href="javascript:void(0);" onclick="navigateAbout()">About</a></li>
                <li><a class="nav-link scrollto" href="javascript:void(0);" onclick="navigateInfrastruktur()">Infrastruktur</a></li>

                <li class="dropdown">
                    <a href="#"><span>Informasi</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a class="nav-link scrollto" href="/berita">Berita</a></li>
                        <li><a class="nav-link scrollto" href="/pengumuman">Pengumuman
                                Sekolah</a> </li>
                        <li><a class="nav-link scrollto" href="/agenda">Agenda
                                Sekolah</a></li>
                        <li><a class="nav-link scrollto" href="/struktur">Struktur Organisasi</a></li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#"><span>Prestasi</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="/prestasi/sekolah">Sekolah</a></li>
                        <li><a href="/prestasi/siswa">Siswa</a></li>
                    </ul>
                </li>
                <li><a class="getstarted scrollto" href="http://portal.sman1bgs.test">Portal Akademik</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->
    </div>
</header>
<!-- End Header -->

@yield('konten')

<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-newsletter">
        <div class="container">
            <div class="row justify-content-center"></div>
        </div>
    </div>
    <div class="container footer-bottom clearfix">
        <div class="copyright">
            &copy; Copyright 2023 <strong><span>Akatsuki</span></strong>. All Rights Reserved
        </div>
        <div class="credits">Designed by @Akatsuki</div>
    </div>
</footer>
<!-- End Footer -->

<!-- Script Pesan dan kesan -->
<script>
const scriptURL =
    "https://script.google.com/macros/s/AKfycbxJB32YoyZNECjciPOiasIT78TYhx8pvd8kI3M68QfkZJV6HrebROnTLU48snwWuTAe/exec";
const form = document.forms["ditz-contact-form"];
const btnKirim = document.querySelector(".btn-kirim");
const btnLoading = document.querySelector(".btn-loading");
const myAlert = document.querySelector(".my-alert");

form.addEventListener("submit", (e) => {
    e.preventDefault();
    //ketika tombol submit di klik
    //tampilkan loading hilangkan kirim
    btnLoading.classList.toggle("d-none");
    btnKirim.classList.toggle("d-none");
    fetch(scriptURL, {
            method: "POST",
            body: new FormData(form)
        })
        .then((response) => {
            //tampilkan kirim hilangkan loading
            btnLoading.classList.toggle("d-none");
            btnKirim.classList.toggle("d-none");
            //tampilkan alert
            myAlert.classList.toggle("d-none");
            //reset form
            form.reset();
            console.log("Success!", response);
        })
        .catch((error) => console.error("Error!", error.message));
});

function navigateHome() {
    // Mengecek URL saat ini
    var currentURL = window.location.pathname;

    // Mengarahkan ke "/" jika URL saat ini bukan "/"
    if (currentURL !== "/") {
        window.location.href = "/";
    } else {
        var element = document.getElementById('hero');
        if (element) {
            element.scrollIntoView({
                behavior: 'smooth'
            });
            return false; // Menghentikan eksekusi href
        }
    }
}
function navigateAbout() {
    // Mengecek URL saat ini
    var currentURL = window.location.pathname;

    // Mengarahkan ke "/" jika URL saat ini bukan "/"
    if (currentURL !== "/") {
        window.location.href = "/about";
    } else {
        var element = document.getElementById('about');
        if (element) {
            element.scrollIntoView({
                behavior: 'smooth'
            });
            return false; // Menghentikan eksekusi href
        }
    }
}
function navigateInfrastruktur() {
    // Mengecek URL saat ini
    var currentURL = window.location.pathname;

    // Mengarahkan ke "/" jika URL saat ini bukan "/"
    if (currentURL !== "/") {
        window.location.href = "/infrastruktur";
    } else {
        var element = document.getElementById('portfolio');
        if (element) {
            element.scrollIntoView({
                behavior: 'smooth'
            });
            return false; // Menghentikan eksekusi href
        }
    }
}
document.addEventListener("DOMContentLoaded", function() {
    var currentURL = window.location.pathname;
    if (currentURL === "/about") {
        var element = document.getElementById('about');
        if (element) {
            element.scrollIntoView({
                behavior: 'smooth'
            });
        }
    }
    if (currentURL === "/infrastruktur") {
        var element = document.getElementById('portfolio');
        if (element) {
            element.scrollIntoView({
                behavior: 'smooth'
            });
        }
    }
});



</script>



<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{  asset('dashboard') }}/assets/vendor/aos/aos.js"></script>
<script src="{{  asset('dashboard') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{  asset('dashboard') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="{{  asset('dashboard') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="{{  asset('dashboard') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="{{  asset('dashboard') }}/assets/vendor/waypoints/noframework.waypoints.js"></script>
<script src="{{  asset('dashboard') }}/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="{{  asset('dashboard') }}/assets/js/main.js"></script>
</body>

</html>
