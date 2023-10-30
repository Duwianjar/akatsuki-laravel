
@extends('dashboard.layout')

@section('konten')
<section id="hero2"></section>

<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="index.html">Home</a></li>
                <li>Berita Details</li>
            </ol>
            <h2>Berita Details</h2>
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
                                <img src="{{  asset('dashboard') }}/assets/img/berita1.jpeg" alt="" />
                            </div>

                            <div class="swiper-slide">
                                <img src="{{  asset('dashboard') }}/assets/img/berita2.jpg" alt="" />
                            </div>

                            <div class="swiper-slide">
                                <img src="{{  asset('dashboard') }}/assets/img/berita3.jpg" alt="" />
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="berita">
                        <h2>SMA NEGERI 1 BAGAN SINEMBAH MENJALIN KERJASAMA DENGAN CAMAT BAGAN SINEMBAH DALAM RANGKA
                            MENUJU SEKOLAH ADIWIYATA TINGKAT PROVINSI</h2>
                        <p>
                            Udara merupakan salah satu unsur penting dalam kehidupan, namun seiring dengan
                            meningkatnya penggunaan alat transportasi terutama transportasi darat, kualitas udara
                            telah mengalami perubahan. Perubahan lingkungan udara pada umumnya disebabkan oleh
                            pencemaran
                            udara. Kehadiran bahan atau zat asing di dalam udara dalam jumlah tertentu serta berada
                            di udara dalam waktu yang cukup lama, akan dapat mengganggu kehidupan manusia, hewan dan
                            tumbuhan, maka dari itu SMAN 1 Bagan Sinembah
                            melakukan kunjungan dan pemberian bibit pohon kepada pihak Kecamatan bagan sinembah
                            sebagai bentuk kepedulian SMAN 1 Bagan Sinembah terhadap lingkungan sekitar sekaligus
                            menjalin kerjasama dengan pihak Kecamatan Bagan Sinembah
                            untuk menimbulkan kesadaran pentingnya menjaga keasrian lingkungan.
                        </p>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-wrapper align-items-center">
                            <div class="swiper-slide">
                                <img src="{{  asset('dashboard') }}/assets/img/berita5.jpg" alt="" />
                            </div>

                            <div class="swiper-slide">
                                <img src="{{  asset('dashboard') }}/assets/img/berita4.jpg" alt="" />
                            </div>

                            <div class="swiper-slide">
                                <img src="{{  asset('dashboard') }}/assets/img/berita2.jpg" alt="" />
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-description">
                        <h2>SMA NEGERI 1 BAGAN SINEMBAH MENJALIN KERJASAMA DENGAN CAMAT BAGAN SINEMBAH DALAM RANGKA
                            MENUJU SEKOLAH ADIWIYATA TINGKAT PROVINSI</h2>
                        <p>
                            Udara merupakan salah satu unsur penting dalam kehidupan, namun seiring dengan
                            meningkatnya penggunaan alat transportasi terutama transportasi darat, kualitas udara
                            telah mengalami perubahan. Perubahan lingkungan udara pada umumnya disebabkan oleh
                            pencemaran
                            udara. Kehadiran bahan atau zat asing di dalam udara dalam jumlah tertentu serta berada
                            di udara dalam waktu yang cukup lama, akan dapat mengganggu kehidupan manusia, hewan dan
                            tumbuhan, maka dari itu SMAN 1 Bagan Sinembah
                            melakukan kunjungan dan pemberian bibit pohon kepada pihak Kecamatan bagan sinembah
                            sebagai bentuk kepedulian SMAN 1 Bagan Sinembah terhadap lingkungan sekitar sekaligus
                            menjalin kerjasama dengan pihak Kecamatan Bagan Sinembah
                            untuk menimbulkan kesadaran pentingnya menjaga keasrian lingkungan.
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
