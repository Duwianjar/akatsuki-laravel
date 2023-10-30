
@extends('portal.layout')

@section('konten')
<section id="services " class="services" style="background-color: #24395d !important;">
    <div class="container pt-5" data-aos="fade-up">
                @if (session('error'))
                    <div class="alert alert-danger text-center">
                        {{ session('error') }}
                    </div>
                    @php
                        session()->forget('error');
                    @endphp
                @endif
                @if (session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                    @php
                        session()->forget('success');
                    @endphp
                @endif
                <div id="add-row" class="container containerprofil  align-items-center" style="height: auto;">
                <div id="mapel" class="mapel col-12 p-4 bg-white rounded rounded-3 head shd-blue" style="height: auto;" >

                    <p class="px-2 ket fs-7" >
                        <a class="text-primary fs-6" href="/profil">Portal</a> / Mapel
                    </p>

                    @if ($user->role=='murid')
                    <p class="garis-abu"></p>
                    <h3 class="ttl text-center mt-3">Daftar Mata Pelajaran di kelas Anda</h3>
                    @endif
                    @if ($user->role=='guru')
                    <p class="garis-abu"></p>
                    <h3 class="ttl text-center mt-3">Daftar Mata Pelajaran yang Anda Ajar</h3>
                    @endif
                    @if ($user->role=='superadmin'||$user->role=='admin')
                    <h3 class="ttl text-center fs-3">Daftar Mata Pelajaran Berdasarkan Kelasnya</h3>
                    @endif
                    <hr class="garis-biru">

                    @if ($user->role=='murid')
                    <div class="container">
                        <div class="row">
                            @foreach ($mapel as $indexmapel)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="kotakmapel rounded rounded-3 ">
                                    <div class="px-3 pt-3">
                                    <h5 class="mx-2">
                                        <i class="text-primary fa fa-book p-2 fs-7 bg-blt"></i>
                                        <span class="text-mapel fs-5">{{ $indexmapel->namamapel }}</span>
                                    </h5>
                                    <div class="mx-2">
                                        <p class="garis-abu-abu"></p>
                                        @foreach ($semuaguru as $guru)
                                            @if ($guru->id == $indexmapel->id_guru)
                                            <div class="row">
                                                <div class="col-6" >
                                                    <p class="text-secondary fs-7 my-1 pengajar">Pengajar<br> {{ $guru->fullname }}</p>
                                                </div>
                                                <div class="col-6">
                                                    @foreach ($semuakelas as $kelas)
                                                        @if ($indexmapel->id_kelas == $kelas->id)
                                                            <p class="text-secondary fs-7 my-1 ruangan">Ruangan<br> Kelas {{ $kelas->kelas }} {{ $kelas->namakelas }} </p>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>

                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="container">
                                    @php
                                        $id=$indexmapel->id;
                                        $encryptedId = Crypt::encrypt($id);
                                    @endphp
                                    <a href="mapel/detail/{{$encryptedId}}"><button class="btn-detail-matkul"> Detail Mata Pelajaran</button></a>
                                </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if ($user->role=='guru')
                    <div class="container">
                        <div class="row">
                            @foreach ($ajarmapel as $indexmapel)
                            <div class="col-md-4 animate__animated animate__fadeInUp">
                                <div class="kotakmapel rounded rounded-3 ">
                                    <div class="px-3 pt-3">
                                    <h5 class="mx-2">
                                        <i class="text-primary fa fa-book p-2 fs-7 bg-blt"></i>
                                        <span class="text-mapel fs-5">{{ $indexmapel->namamapel }}</span>
                                    </h5>
                                    <div class="mx-2">
                                        <p class="garis-abu-abu"></p>
                                        @foreach ($semuaguru as $guru)
                                            @if ($guru->id == $indexmapel->id_guru)
                                            <div class="row">
                                                <div class="col-6" >
                                                    <p class="text-secondary fs-7 my-1 pengajar">Pengajar<br> {{ $guru->fullname }}</p>
                                                </div>
                                                <div class="col-6">
                                                    @foreach ($semuakelas as $kelas)
                                                        @if ( $kelas->id == $indexmapel->id_kelas)
                                                            <p class="text-secondary fs-7 my-1 ruangan">Ruangan<br> Kelas {{ $kelas->kelas }} {{ $kelas->namakelas }} </p>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>

                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="container">
                                    @php
                                        $id=$indexmapel->id;
                                        $encryptedId = Crypt::encrypt($id);
                                    @endphp
                                    <a href="mapel/detail/{{$encryptedId}}"><button class="btn-detail-matkul"> Detail Mata Pelajaran</button></a>
                                </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if ($user->role=='superadmin'||$user->role=='admin')
                    <label for="pilihan" class="mx-1 my-3">Pilih Kelas</label>
                    <select id="pilihan" class="mt-2 mx-1" >
                        @foreach ($semuakelas as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->kelas }} {{ $kelas->namakelas }}</option>
                        @endforeach
                    </select>
                    <button onclick="tampilkanPilihan()"  class="mx-1 mt-2 tampilkanpilihan">Tampilkan Pilihan</button>
                    <div class="table-responsive">
                        <table class="table col-12 mt-3">
                        <thead class="fs-6 ">
                            <tr>
                                <th>&emsp;#</th>
                                <th>Nama Mata Pelajaran</th>
                                <th>Kelas </th>
                                <th>Pengajar </th>
                                <th>Aksi </th>
                            </tr>
                        </thead>

                        <tbody class="fs-6">

                        </tbody>
                    </table>
                </div>
                    @endif
                </div>
        </div>
    </div>
    </div>
    </div>

    <div class="mapelsection"></div>
</section>
    <script>
        function tampilkanPilihan() {
            // Mendapatkan nilai yang dipilih dari dropdown
            var selectedValue = document.getElementById("pilihan").value;

            // Membangun URL dengan parameter query string
            var url = "/mapel/index/" + selectedValue;

            // Mengarahkan pengguna ke URL yang dibangun
            window.location.href = url;
        }
    </script>
    </section>

@endsection
