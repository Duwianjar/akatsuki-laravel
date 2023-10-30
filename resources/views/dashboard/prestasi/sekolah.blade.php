@extends('dashboard.layout')

@section('konten')

<!-- ======= Hero Section ======= -->
<section id="hero2"></section>


<!--=======Section Prestasi=======-->
<section id="prestasi" class="prestasi section-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Prestasi Sekolah</h2>
            <p>SMA kami dikenal dengan prestasi yang yang sangat banyak dan membanggakan daerah kami. Inilah
                beberapa prestasi besar yang pernah SMA kami dapatkan.</p>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
                    <div class="pic"><img src="{{  asset('dashboard') }}/assets/img/prestasi/presS1.jpg" class="img-fluid" alt="" /></div>
                    <div class="member-info">
                        <br><br>
                        <h4>TERAKREDITASI</h4>
                        <span>Terakreditasi A</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mt-4 mt-lg-0">
                <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="200">
                    <div class="pic"><img src="{{  asset('dashboard') }}/assets/img/prestasi/presS2.jpg" class="img-fluid" alt="" /></div>
                    <div class="member-info">
                        <h4>SEKOLAH PENGGERAK</h4>
                        <span>Menjadi salah satu sekolah penggerak.</span>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- End Section Prestasi -->


@endsection