@extends('dashboard.layout')

@section('konten')

<!-- ======= Hero Section ======= -->
<section id="hero2"></section>


<!-- ======= Section Prestasi ======= -->
<section id="prestasi" class="prestasi section-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <br /><br />
            <h2>Prestasi Siswa</h2>
            <p>Berikut adalah sebagian prestasi yang sudah di raih oleh siswa/siswi kami</p>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
                    <div class="pic"><img src="{{  asset('dashboard') }}/assets/img/prestasi/presis1.jpg" class="img-fluid" alt="" /></div>
                    <div class="member-info">
                        <h4>JUARA 1</h4>
                        <span>Musically Akustik</span>
                        <p>Didapatkan dengan nilai sempurna oleh juri</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mt-4 mt-lg-0">
                <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="200">
                    <div class="pic"><img src="{{  asset('dashboard') }}/assets/img/prestasi/presis2.jpg" class="img-fluid" alt="" /></div>
                    <div class="member-info">
                        <h4>JUARA 1</h4>
                        <span>Voli Putri</span>
                        <p>Didapatkan 4 kali berturut-turut</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mt-4">
                <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="300">
                    <div class="pic"><img src="{{  asset('dashboard') }}/assets/img/prestasi/presis3.jpg" class="img-fluid" alt="" /></div>
                    <div class="member-info">
                        <h4>JUARA 1</h4>
                        <span>Bulu tangkis ganda putra</span>
                        <p>Didapatkan 6 kali berturut-turut</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mt-4">
                <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="400">
                    <div class="pic"><img src="{{  asset('dashboard') }}/assets/img/prestasi/presis4.jpg" class="img-fluid" alt="" /></div>
                    <div class="member-info">
                        <h4>JUARA 2</h4>
                        <span>ATLETIK NASIONAL</span>
                        <p>Berhasil menjadi juara 2 pada perlombaan nasional</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Section Prestasi -->


@endsection