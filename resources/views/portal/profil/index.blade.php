
@extends('portal.layout')

@section('konten')

<section id="services " class="services" style="background-color: #24395d !important;">

    <div class="container " data-aos="fade-up">
        @if (Session::has('success'))
                <div class="alert alert-success mt-5 text-center">
                    {!! Session::get('success') !!}
                </div>
        @endif
        <div id="add-row" class="container containerprofil  align-items-center" style="height: auto;">

                <div id="profile" class="col-md-4  mx-3 p-4 bg-white rounded rounded-3 head mt-5 shd-blue">
                    @if ($user->id_foto!='default.png')
                        <img src="{{ asset('foto') }}/{{ $user->id_foto }}"
                        class="profile-image rounded mx-auto d-block rounded-circle border border-dark border-1" alt="{{ $user->id_foto }}"
                        height="100" width="100">
                    @else
                        <img  src="{{ asset('foto') }}/default.png"
                        class="profile-image rounded mx-auto d-block rounded-circle border border-dark border-1" alt="default.img"
                        height="100" width="100">
                    @endif

                        <h1 class="text-capitalize mt-3 fw-bold fs-5 text-center text-white">{{ $user->fullname }} <br>(<span class="text-primary fw-normal fs-5"> {{ $user->role }} </span>) </h1>
                        <a href="/profil/edit">
                            <center class="text-white">
                                Edit Profil <i class="bi bi-pencil"></i>
                            </center>
                        </a>
                        <ul class="mt-4 kelompok">
                            @if ($user->role=='murid')
                                <a href="#info-pembayaran-spp" class="text-white space">
                                <li class="info p-2 rounded rounded-3">Info Pembayaran SPP
                                    <i class="fas fa-chevron-right"></i>
                                </li>
                                </a>
                                <a href="#jadwal-kelas" class="text-white space">
                                    <li class="info p-2 rounded rounded-3" >
                                    Jadwal Kelas
                                    <i class="fas fa-chevron-right" ></i>
                                    </li>
                                </a>
                                <a href="#praktek" class="text-white space">
                                    <li class="info p-2 rounded rounded-3" >Praktek
                                        <i class="fas fa-chevron-right" ></i>
                                    </li>
                                </a>
                                <a href="#uts-uas" class="text-white space">
                                    <li class="info p-2 rounded rounded-3">
                                    UTS & UAS
                                    <i class="fas fa-chevron-right"></i>
                                    </li>
                                </a>
                            @endif
                            @if ($user->role=='guru')
                                <a href="#jadwal-mengajar" class="text-white space">
                                    <li class="info p-2 rounded rounded-3" >
                                    Jadwal Mengajar
                                    <i class="fas fa-chevron-right" ></i>
                                    </li>
                                </a>
                                <a href="#mengajar-praktek" class="text-white space">
                                    <li class="info p-2 rounded rounded-3" >Mengajar Praktek
                                        <i class="fas fa-chevron-right" ></i>
                                    </li>
                                </a>
                                <a href="#jaga-uts-uas" class="text-white space">
                                    <li class="info p-2 rounded rounded-3">
                                    Jadwal jaga UTS & UAS
                                    <i class="fas fa-chevron-right"></i>
                                    </li>
                                </a>
                            @endif
                            @if ($user->role=='superadmin'||$user->role=='admin')
                            <a href="#data-pembayaran-spp" class="text-white space">
                                <li class="info p-2 rounded rounded-3">Data Pembayaran SPP
                                    <i class="fas fa-chevron-right"></i>
                                </li>
                            </a>
                            <a href="#data-jadwal-kelas" class="text-white space">
                                <li class="info p-2 rounded rounded-3" >
                                Data Jadwal Kelas
                                <i class="fas fa-chevron-right" ></i>
                                </li>
                            </a>
                            <a href="#data-praktek" class="text-white space">
                                <li class="info p-2 rounded rounded-3" >Data Praktek
                                    <i class="fas fa-chevron-right" ></i>
                                </li>
                            </a>
                            <a href="#data-uts-uas" class="text-white space">
                                <li class="info p-2 rounded rounded-3">
                                Data UTS & UAS
                                <i class="fas fa-chevron-right"></i>
                                </li>
                            </a>
                            @endif
                        </ul>
                </div>
                @if ($user->role=='murid')
                <div id="info-pembayaran-spp" class="col-md-8 mx-3 p-4 mt-5 bg-white rounded rounded-3 head hide shd-blue">
                    <h3 class="ttl text-center">Info Pembayaran SPP</h3>
                    <hr class="garis-biru">
                    <hr class="putih">
                </div>
                <div id="jadwal-kelas" class="col-md-8 mx-3 p-4 mt-5 bg-white rounded rounded-3 head hide shd-blue">
                    <h3 class="ttl text-center">Jadwal Kelas</h3>
                    <hr class="garis-biru">
                    <hr class="putih">
                </div>
                <div id="praktek" class="col-md-8 mx-3 p-4 mt-5 bg-white rounded rounded-3 head hide shd-blue">
                    <h3 class="ttl text-center">Praktek</h3>
                    <hr class="garis-biru">
                    <hr class="putih">
                </div>
                <div id="uts-uas" class="col-md-8 mx-3 p-4 mt-5 bg-white rounded rounded-3 head hide shd-blue">
                    <h3 class="ttl text-center">UTS & UAS </h3>
                    <hr class="garis-biru">
                    <hr class="putih">
                </div>
                @endif
                @if ($user->role=='guru')
                <div id="jadwal-mengajar" class="col-md-8 mx-3 p-4 mt-5 bg-white rounded rounded-3 head hide shd-blue">
                    <h3 class="ttl text-center">Jadwal Mengajar</h3>
                    <hr class="garis-biru">
                    <hr class="putih">
                </div>
                <div id="mengajar-praktek" class="col-md-8 mx-3 p-4 mt-5 bg-white rounded rounded-3 head hide shd-blue">
                    <h3 class="ttl text-center">Mengajar Praktek</h3>
                    <hr class="garis-biru">
                    <hr class="putih">
                </div>
                <div id="jaga-uts-uas" class="col-md-8 mx-3 p-4 mt-5 bg-white rounded rounded-3 head hide shd-blue">
                    <h3 class="ttl text-center">Jadwal jaga UTS & UAS </h3>
                    <hr class="garis-biru">
                    <hr class="putih">
                </div>
                @endif
                @if ($user->role=='superadmin'||$user->role=='admin')
                <div id="data-pembayaran-spp" class="col-md-8 mx-3 p-4 mt-5 bg-white rounded rounded-3 head hide shd-blue">
                    <h3 class="ttl text-center">Data Pembayaran SPP</h3>
                    <hr class="garis-biru">
                    <hr class="putih">
                </div>
                <div id="data-jadwal-kelas" class="col-md-8 mx-3 p-4 mt-5 bg-white rounded rounded-3 head hide shd-blue">
                    <h3 class="ttl text-center">Data Jadwal Kelas</h3>
                    <hr class="garis-biru">
                    <hr class="putih">
                </div>
                <div id="data-praktek" class="col-md-8 mx-3 p-4 mt-5 bg-white rounded rounded-3 head hide shd-blue">
                    <h3 class="ttl text-center">Data Praktek</h3>
                    <hr class="garis-biru">
                    <hr class="putih">
                </div>
                <div id="data-uts-uas" class="col-md-8 mx-3 p-4 mt-5 bg-white rounded rounded-3 head hide shd-blue">
                    <h3 class="ttl text-center">Data UTS & UAS </h3>
                    <hr class="garis-biru">
                    <hr class="putih">
                </div>
                @endif
        </div>
    </div>
</section>
<div class="mapelsection"></div>
@if ($user->role=='murid')
<script src="{{  asset('portal') }}/js/murid.js"></script>
@endif
@if ($user->role=='guru')
<script src="{{  asset('portal') }}/js/guru.js"></script>
@endif
@if ($user->role=='superadmin'||$user->role=='admin')
<script src="{{  asset('portal') }}/js/superadmin.js"></script>
@endif
@endsection
