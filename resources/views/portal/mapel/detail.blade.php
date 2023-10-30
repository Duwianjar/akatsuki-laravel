
@extends('portal.layout')

@section('konten')
<section id="services " class="services" style="background-color: #24395d !important; ;">
    <div class="container pt-5" data-aos="fade-up">
            <div id="add-row" class="container containerprofil pt-5  align-items-center" style="height: auto;">
            <div id="mapel" class="mapel col-md-12 mx-3 p-4 bg-white rounded rounded-3 head shd-blue">
                    <p class="px-2 ket fs-7" >
                        <a class="text-primary fs-6" href="/profil">Portal</a>
                        <a class="text-primary fs-6" href="/mapel"> <span class="text-secondary">/</span> Mapel</a>
                        <span class="text-secondary">/ Detail</span>
                    </p>
                    <p class="garis-abu"></p>
                    <h3 class="ttl text-center mt-3">Detail Mata Pelajaran</h3>
                    <hr class="garis-biru">
                    <div class="row">
                        <div class="kiri">
                            <p>Nama Mata Pelajaran</p>
                        </div>
                        <div class="tengah">
                            <p>:</p>
                        </div>
                        <div class="kanan">
                            <p class="text-white">{{ $mapel->namamapel }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="kiri">
                            <p >Nama Guru Pengajar </p>
                        </div>
                        <div class="tengah">
                            <p >:</p>
                        </div>
                        <div class="kanan">
                            <p class="text-white">{{ $guru->fullname }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="kiri">
                            <p >kelas Mata Pelajaran</p>
                        </div>
                        <div class="tengah">
                            <p >:</p>
                        </div>
                        <div class="kanan">
                            <p class="text-white">{{ $kelas->kelas }} {{ $kelas->namakelas }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="kiri">
                            <p>Keterangan</p>
                        </div>
                        <div class="tengah">
                            <p>:</p>
                        </div>
                        <div class="kanan">
                            <p class="text-white">{{ $mapel->deskripsi }}</p>
                        </div>
                        <a href="/mapel"><button class="btn-detail-matkul p-1 fs-6"> Kembali</button></a>
                    </div>

                </div>
        </div>
    </div>
    <div class="detailmapelsection"></div>
    </section>

@endsection
