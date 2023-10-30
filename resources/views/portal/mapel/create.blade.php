
@extends('portal.layout')

@section('konten')
<section id="services " class="services" style="background-color: #24395d !important; ;">
    <div class="container pt-5" data-aos="fade-up">
            @if (Session::has('error'))
                <div class="alert alert-danger dgr">
                    {{ Session::get('error') }}
                </div>
            @endif
            <div id="add-row" class="container mapel-edit containerprofil pt-5  align-items-center" style="height: auto;">

            <div id="mapel" class="mapel col-md-12 p-4 bg-white rounded rounded-3 head shd-blue">
                <p class="px-2 ket fs-7 " >

                        <a class="text-primary fs-6" href="/profil">Portal</a>
                        <a class="text-primary fs-6" href="/mapel"> <span class="text-secondary">/</span> Mapel</a>
                        <span class="text-secondary">/ Create</span>
                    </p>
                    <p class="garis-abu-edit"></p>
                    <hr class="garis-biru-edit">
                    <form role="form" method="post" action="{{ url('/mapel/baru/index') }}">
                        @csrf
                        <div class="judul-edit">
                            <p>Nama Mapel</p>
                            <input class="@error('namamapel') is-invalid @enderror namamapel " type="text" class="form-control" name="namamapel" placeholder="Tulis Nama Mata pelajaran disini"/>
                        </div>

                        <div class="judul-edit">
                            <p>Guru Pengajar</p>
                            <select id="pilihan_guru" name="id_guru" class="pil">
                                @foreach ($semuaguru as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="judul-edit">
                            <p>Ruang Kelas</p>
                            <select id="pilihan_kelas" name="id_kelas" class="pil">
                                 @foreach ($semuakelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->kelas }} {{ $kelas->namakelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="judul-edit">
                            <p>Deskripsi</p>
                            <textarea class="deskripsi @error('deskripsi') is-invalid @enderror" name="deskripsi" placeholder="Tulis Deskripsi Mapel disini"></textarea>
                        </div>
                        <div class="judul-edit">
                            <button name="create" class="edit">Simpan</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>

    <div class="detailmapelsection"></div>
    </section>
    @if (session('lihatkelas'))
    <script>
        var selectedValue = {!! json_encode(session('lihatkelas')) !!}; // Escape dan konversi nilai
        var selectElement = document.getElementById('pilihan_kelas');

        if (selectElement) { // Memeriksa apakah elemen ada
            selectElement.value = selectedValue;
        }
    </script>
    @endif

@endsection
