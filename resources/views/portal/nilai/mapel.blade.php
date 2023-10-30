
@extends('portal.layout')

@section('konten')
<section id="services " class="services" style="background-color: #24395d !important;">
    <div class="container pt-5" data-aos="fade-up">
                @if (session('error'))
                    <div class="alert alert-danger text-center">
                    {{ session('error') }}
                    </div>
                    @php session()->forget('error'); @endphp
                @endif
                @if (session('success'))
                    <div class="alert alert-success text-center">
                    {{ session('success') }}
                    </div>
                    @php session()->forget('success'); @endphp
                @endif
                <div id="add-row" class="container containerprofil  align-items-center" style="height: auto;">
                <div id="mapel" class="mapel col-12 p-4 bg-white rounded rounded-3 head shd-blue" style="height: auto;" >

                    <p class="px-2 ket fs-7" >
                    <a class="text-primary fs-6" href="/profil">Portal</a> / Nilai
                    </p>
                    <h3 class="ttl text-center fs-3">Data Nilai {{ $mapelpil->namamapel }} Kelas {{ $kelaspil->kelas }} {{ $kelaspil->namakelas }}</h3>
                    <hr class="garis-biru">
                    @if ($user->role=='murid')
                    @php
                    $redirectUrl = '/nilai';
                    @endphp
                    @endif
                    @if ($user->role=='superadmin'||$user->role=='guru'|| $user->role === 'admin')
                    <label for="pilihan" class="mx-1 my-3">Ganti Mapel</label>
                    <select id="pilihan" class="mt-2 mx-1 tampiloption" style="background-color:transparant; width:220px;">
                        @php
                            $encryptedIdpil = Crypt::encrypt($mapelpil->id);
                        @endphp
                        <option value="{{ $encryptedIdpil }}">{{ $mapelpil->namamapel }}</option>
                        @if ($user->role=='superadmin'|| $user->role === 'admin')
                            @foreach ($allmapelthisclass as $pelajaran)
                            @php
                                $encryptedId = Crypt::encrypt($pelajaran->id);
                            @endphp
                            <option value="{{ $encryptedId }}">{{ $pelajaran->namamapel }}</option>
                            @endforeach
                        @endif
                        @if ($user->role=='guru')
                            @foreach ($allmapelguru as $pelajaran)
                            @php
                                $encryptedId = Crypt::encrypt($pelajaran->id);
                            @endphp
                            @foreach ($allkelas as $kelas)
                            @if ($kelas->id==$pelajaran->id_kelas)
                                <option value="{{ $encryptedId }}">{{ $pelajaran->namamapel }} kelas {{ $kelas->kelas }} {{ $kelas->namakelas }}</option>
                            @endif
                            @endforeach
                            @endforeach
                        @endif

                    </select>
                    <button onclick="tampilkanPilihan()"  class="mx-1 mt-2 tampilkanpilihan">Tampilkan Pilihan</button>
                    <div class="table-responsive">
                        <table class="table col-12 mt-3">
                        <thead class="fs-6 ">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Siswa</th>
                                <th class="text-center">Nilai Kehadiran</th>
                                <th class="text-center">Nilai Perilaku</th>
                                <th class="text-center">Nilai Tugas</th>
                                <th class="text-center">Nilai Praktek</th>
                                <th class="text-center">Nilai UTS</th>
                                <th class="text-center">Nilai UAS</th>
                                <th class="text-center">Nilai Akhir</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="fs-6">
                            @foreach ($allmurid as $murid)
                            @php
                                $ketemu=0;
                            @endphp
                            <tr class="abu">
                                <td class="text-center">{{ $loop->iteration }}</td></td>
                                <td>{{ $murid->fullname }}</td>
                                @foreach ($nilaimapel as $nilai)
                                @if ($nilai->id_murid==$murid->id)
                                @php
                                    $ketemu=$nilai->id_murid;
                                @endphp
                                    <td class="text-center">{{ $nilai->kehadiran }}</td>
                                    <td class="text-center">{{ $nilai->perilaku }}</td>
                                    <td class="text-center">{{ $nilai->tugas }}</td>
                                    <td class="text-center">{{ $nilai->praktek }}</td>
                                    <td class="text-center">{{ $nilai->uts }}</td>
                                    <td class="text-center">{{ $nilai->uas }}</td>
                                    <td class="text-center fw-bold">{{ $nilai->akhir }}</td>
                                @endif
                                @endforeach
                                @if ($ketemu==$murid->id)

                                @else
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                <td class="text-center fw-bold">0</td>
                                @endif
                                <td class="text-center">
                                    @php
                                        $encryptedIdmurid = Crypt::encrypt($murid->id);
                                    @endphp
                                    @if ($user->role === 'admin')
                                    @else
                                    <a href="/nilai/edit/{{$encryptedIdmurid}}/{{ $encryptedIdpil }}" id="ubahLink">
                                        <button class="btn-edit m-3"><i class="bi bi-pencil-square m-1"></i></button>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
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
            var url = "/nilai/mapel/" + selectedValue;
            window.location.href = url;
        }
    </script>
@endsection
