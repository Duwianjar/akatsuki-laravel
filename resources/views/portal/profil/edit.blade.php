
@extends('portal.layout')

@section('konten')

<section id="services " class="services" style="background-color: #24395d !important;">

    <div class="container pt-5" data-aos="fade-up">
        @if (Session::has('success'))
                <div class="alert alert-success mt-5 text-center">
                    {!! Session::get('success') !!}
                </div>
        @endif
        @if (Session::has('error'))
                <div class="alert alert-danger dgr">
                    {{ Session::get('error') }}
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


                        <h1 class="text-capitalize mt-3 fw-bold fs-5 text-center text-white">{{ $user->fullname }}</h1>
                        <ul class="mt-4 kelompok">
                                <a href="#edit-profil" class="text-white space ">
                                <li id="profil" class="info p-2 rounded rounded-3">Edit Profil
                                    <i class="fas fa-chevron-right"></i>
                                </li>
                                </a>
                                <a href="#edit-password" class="text-white space">
                                <li id="password" class="info p-2 rounded rounded-3">Ganti Password
                                    <i class="fas fa-chevron-right"></i>
                                </li>
                                </a>
                                <a href="#edit-foto" class="text-white space">
                                    <li id="foto" class="info p-2 rounded rounded-3">Ganti Foto Profil
                                        <i class="fas fa-chevron-right"></i>
                                    </li>
                                </a>
                                <a href="#" class="text-white space" onclick="konfirmasiBatal()">
                                <li class="info p-2 rounded rounded-3">Kembali
                                    <i class="fas fa-chevron-right"></i>
                                </li>
                                </a>
                        </ul>
                </div>
                <div id="edit-profil" class="col-md-8 mx-3 p-4 mt-5 bg-white rounded rounded-3 head shd-blue">
                    <hr class="garis-biru">
                    <p class="garis-abu-edit"></p>
                    <h3 class="ttl text-center">Edit Profil</h3>
                    <p class="garis-abu-edit"></p>
                    <hr class="garis-biru">
                    <form role="form" method="post" action="{{ url('profil/edit/post') }}">
                        @csrf
                        <div class="judul-edit">
                            <p id="judul-edit-p">Nama Lengkap</p>
                            <input class="@error('namalengkap') is-invalid @enderror inputan-edit" type="text" class="form-control" name="namalengkap" value="{{ $user->fullname }}"/>
                        </div>
                        <div class="judul-edit">
                            <p id="judul-edit-p">No Telepon</p>
                            <input class="@error('telepon') is-invalid @enderror inputan-edit" type="text" class="form-control" name="telepon" value="{{ $user->telepon }}"/>
                        </div>
                        <div class="judul-edit">
                            <p id="judul-edit-p">Email</p>
                            <input class="@error('email') is-invalid @enderror inputan-edit" type="email" class="form-control" name="email" value="{{ $user->email }}"/>
                        </div>
                        <div class="judul-edit">
                            <button name="edit" class="edit">Simpan</button>
                        </div>
                    </form>
                    <p class="garis-abu-edit-profil "></p>
                </div>
                <div id="edit-password" class="col-md-8 mx-3 p-4 mt-5 bg-white rounded rounded-3 head shd-blue">
                    <hr class="garis-biru">
                    <p class="garis-abu-edit"></p>
                    <h3 class="ttl text-center">Edit Password</h3>
                    <p class="garis-abu-edit"></p>
                    <hr class="garis-biru">
                    <form role="form" method="post" action="{{ url('profil/edit/password') }}">
                        @csrf
                        <div class="judul-edit judul-edit-password">
                            <p id="judul-edit-p">Password lama</p>
                            <div class="tambah-row">
                            <input type="password" class="inputan-edit-pass @error('passwordlama') is-invalid @enderror" name="passwordlama" placeholder="Password Lama" id="password-lama-input" />
                            <button type="button" class="btn-eye" id="show-password-button" onclick="togglePasswordVisibility()">
                                <i class="fas fa-eye" id="eye-icon"></i>
                            </button>
                            </div>
                        </div>
                        <div class="judul-edit judul-edit-password">
                            <p id="judul-edit-p">Password Baru</p>
                            <div class="tambah-row">
                            <input class="@error('passwordbaru') is-invalid @enderror inputan-edit-pass" type="password"  name="passwordbaru" placeholder="Password Baru" id="password-baru-input"/>
                            <button type="button" class="btn-eye" id="show-password-button" onclick="togglePasswordbaruVisibility()">
                                <i class="fas fa-eye" id="eye-icon2"></i>
                            </button>
                        </div>
                        </div>
                        <div class="judul-edit judul-edit-password">
                            <p id="judul-edit-p">konfirmasi Password</p>
                            <div class="tambah-row">
                            <input class="@error('konfirmasipassword') is-invalid @enderror inputan-edit-pass" type="password" name="konfirmasipassword" placeholder="Konfirmaasi Password" id="password-konfigurasi-input"/>
                            <button type="button" class="btn-eye" id="show-password-button" onclick="togglePasswordkonfigurasiVisibility()">
                                <i class="fas fa-eye" id="eye-icon3"></i>
                            </button>
                        </div>
                        </div>
                        <div class="judul-edit judul-edit-password">
                            <button name="edit" class="edit">Simpan</button>
                        </div>
                    </form>
                    <a href="/profil/lupapassword"><p class="lpa-pass">Lupa Password ?</p></a>
        </div>
        <div id="edit-foto" class="col-md-8 mx-3 p-4 mt-5 bg-white rounded rounded-3 head shd-blue">
            @if ($user->id_foto!='default.png')
                <img id="previewImage" src="{{ asset('foto') }}/{{ $user->id_foto }}"
                class="rounded mx-auto d-block rounded-circle  square-image" alt="{{ $user->id_foto }}">
            @else
                <img id="previewImage" src="{{ asset('foto') }}/default.png"
                class="rounded mx-auto d-block rounded-circle  square-image" alt="default.img">
            @endif


                <form action="/profil/edit/foto" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Tambahkan CSRF token untuk keamanan -->
                    <div class="form-group plh-foto my-2">
                        <input type="file" name="photo" class="form-control" id="photoInput">
                    </div>

                    <div class="judul-edit judul-edit-password">
                        <button type="submit" class="edit">Unggah Foto</button>
                    </div>
                </form>
                <p class="garis-abu-edit-profil "></p>

        </div>
    </div>
</section>
<div class="mapelsection"></div>
<script src="{{  asset('portal') }}/js/editprofil.js?<?php echo time(); ?>"></script>
<script src="{{  asset('portal') }}/js/editprofil2.js?<?php echo time(); ?>"></script>
<script src="{{  asset('portal') }}/js/eye.js"></script>
<script>
    // Ambil elemen input file
    var photoInput = document.getElementById('photoInput');

    // Ambil elemen gambar untuk ditampilkan
    var previewImage = document.getElementById('previewImage');

    // Tambahkan event listener untuk input file
    photoInput.addEventListener('change', function () {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                // Set src gambar sesuai dengan file yang dipilih
                previewImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>


@endsection
