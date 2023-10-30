@extends('dashboard.layout')

@section('konten')

<!-- ======= Hero Section ======= -->
<section id="hero2"></section>



<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="index.php">Home</a></li>
                <li>Pengumuman Details</li>
            </ol>
            <h2>Pengumuman Details</h2>
        </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Berita Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-wrapper align-items-center">
                            <div class="swiper-slide">
                                <img src="{{  asset('dashboard') }}/assets/img/lulus.jpg" alt="" />
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="berita">
                        <h2>PENGUMUMAN KELULUSAN PESERTA DIDIK SMA NEGERI 1 BAGAN SINEMBAH TAHUN PELAJARAN 2022/2023
                        </h2>
                        <p>
                            Hai adik-adik peserta didik di SMA NEGERI 1 BAGAN SINEMBAH, penasaran ya dengan hasil
                            belajar selama 3 tahun di SMA tercinta ?
                            <br /><br />Kami berharap adik-adik semua tidak melupakan jasa para guru-guru dan juga
                            para karyawan di SMA NEGERI 1 BAGAN SINEMBAH. Kami juga berharap kelak ke depan
                            adik-adik dapat menggapai cita-cita yang selama ini
                            diinginkan. Tunjukkan alumni SMA NEGERI 1 BAGAN SINEMBAH bisa bersaing, berkarya untuk
                            mewujudkan keinginan cita-cita luhur. Jangan lupa pula tetap berbakti kepada orang tua,
                            karena jasa mereka tak akan pernah terbalaskan.
                            Doa kami, semoga semua sehat, bahagia dan sukses selalu...!!! Aamiinn.<br /><br />Untuk
                            mengetahui hasilnya, silakan klik tautan di bawah ini : <br /><br />
                            <a href="#">Lihat Pengumuman</a> <br /><br /> Terimakasih...!!!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Berita Details Section -->
</main>
<!-- End #main -->



@endsection