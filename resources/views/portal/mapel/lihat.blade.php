
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
                    <h3 class="ttl text-center fs-3">Daftar Mata Pelajaran Berdasarkan Kelasnya</h3>
                    <hr class="garis-biru">

                    @if ($user->role=='murid'||$user->role=='guru')
                    @php
                        $redirectUrl = '/mapel';
                    @endphp
                    @endif
                    @if ($user->role=='superadmin'||$user->role=='superadmin')
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
                        @if (session('lihatkelas'))
                            @foreach ($allmapel as $mapel)
                                @if ($mapel->id_kelas==session('lihatkelas'))
                                <tr class="abu">
                                    <td>&emsp;{{ $loop->iteration }}</td>
                                    <td>{{ $mapel->namamapel }}</td>
                                    @foreach ($semuakelas as $kelas)
                                        @if ( $kelas->id == $mapel->id_kelas)
                                        <td>{{ $kelas->kelas }} {{ $kelas->namakelas }}</td>
                                        @endif
                                    @endforeach
                                    @foreach ($semuaguru as $guru)
                                        @if ($guru->id == $mapel->id_guru)
                                            <td>{{ $guru->fullname }}</td>
                                        @endif
                                    @endforeach
                                    <td>
                                        @php
                                            $id=$mapel->id;
                                            $encryptedId = Crypt::encrypt($id);
                                        @endphp
                                        <a href="/mapel/edit/{{$encryptedId}}" id="ubahLink">
                                            <button class="btn-edit"><i class="bi bi-pencil-square"></i></button>
                                        </a>
                                        <a href="/mapel/delete/{{$encryptedId}}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <button class="btn-delete"><i class="bi bi-trash"></i></button>
                                        </a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                    @endif

                    <button onclick="tambahmapel()"  class="mx-1 mt-2 tambahmapel">Tambah Mata Pelajaran</button>
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
            var url = "/mapel/index/" + selectedValue;
            window.location.href = url;
        }
        function tambahmapel() {
            var url = "/mapel/baru";
            window.location.href = url;
        }
    </script>
    @if (session('lihatkelas'))
    <script>
        var selectedValue = {!! json_encode(session('lihatkelas')) !!}; // Escape dan konversi nilai
        var selectElement = document.getElementById('pilihan');

        if (selectElement) { // Memeriksa apakah elemen ada
            selectElement.value = selectedValue;
        }
    </script>
    @endif
@endsection
