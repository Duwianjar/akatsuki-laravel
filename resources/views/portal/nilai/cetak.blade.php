@extends('portal.cetaklayout')
@section('konten')
<section id="services" class="services section-bg">
    <div class="container" data-aos="fade-up">
                <h4 class="fw-bold align-content-center"><img src="{{  asset('dashboard') }}/assets/img/sma.png" class="img-fluid animated" alt="" width="50px">
                    <span class="text-dark text-center"> SMAN 1 Bagan Sinembah</span>
                </h4>
        <h5 class="text-dark fw-bold">
            <center>Transkip Nilai</center>
        </h5>
        <br>
        <div class="row g-1">
            <div id="myCol" class="col-3 text-dark">
                <p>&emsp;&emsp;Nama Siswa
                    <br>&emsp;&emsp;Kelas<br>&emsp;&emsp;Telepon<br>&emsp;&emsp;Email
                </p>
            </div>
            <div class=" col-7 text-dark">
                <p>
                    :&emsp;{{ $murid->fullname }}<br>
                    @foreach ($semuakelas as $kelas)
                        @if ( $kelas->id == $murid->id_kelas)
                            :&emsp;{{ $kelas->kelas }} {{ $kelas->namakelas }} <br>
                        @endif
                    @endforeach
                    :&emsp;{{ $murid->telepon }}<br>
                    :&emsp;{{ $murid->email }}</p>
            </div>
        </div><br>
        <table class="table table-bordered">
            <thead>
                <tr class="table-secondary">
                    <th scope="col" colspan="3">
                        <center>Mata Pelajaran</center>
                    </th>
                    <th rowspan="2">
                        <center>Nilai</center>
                    </th>
                </tr>
                <tr class="table-secondary">

                    <th scope="col">ID</th>
                    <th scope="col">Nama Pelajaran</th>
                    <th scope="col">Nama Guru</th>

                </tr>

                @php
                    $ada=0;
                    $jumlah=0;
                @endphp
                @foreach ($allmapelmurid as $mapel)
                <tr>
                    <td class="text-center">{{ $mapel->id }}</td>
                    <td class="text-break">{{ $mapel->namamapel }}</td>
                    @foreach ($semuaguru as $guru)
                        @if ($guru->id == $mapel->id_guru)
                            <td class="text-break">{{ $guru->fullname }}</td>
                        @endif
                    @endforeach
                    @php
                        $ketemu=0;
                    @endphp
                    @foreach ($nilaimurid as $nilai)
                        @if ($nilai->id_mapel==$mapel->id)
                            @php
                                $ketemu=$nilai->id_mapel;
                                $ada=$ada+1;
                                $jumlah=$jumlah+$nilai->akhir;
                            @endphp
                            <td class="text-center fw-bold">{{ $nilai->akhir }}</td>
                        @endif
                    @endforeach
                    @if ($ketemu==$mapel->id)
                    @else
                    <td class="text-center">0</td>
                    @endif
                </tr>
                @endforeach
                <tr>
                    <th scope="row" colspan="3">
                        <center>Rata-rata</center>
                    </th>
                    @php
                        $ratarata=0;
                    @endphp
                    @if($ada!=0)
                        @php
                            $ratarata=$jumlah/$ada;
                        @endphp
                    @endif
                    <th scope="col" class="text-center">{{ number_format($ratarata, 2) }}</th>
                </tr>
            </thead>
        </table>
        <br>
    </div>
</section>
<script>
    function updateColumnClass() {
        const colElement = document.getElementById("myCol"); // Ganti dengan id yang sesuai
        const screenWidth = window.innerWidth; // Lebar layar browser

        if (screenWidth <= 510) {
            colElement.classList.remove("col-3");
            colElement.classList.add("col-5");
        } else {
            colElement.classList.remove("col-5");
            colElement.classList.add("col-3");
        }
    }

    window.addEventListener("resize", updateColumnClass);
    window.addEventListener("load", updateColumnClass);
</script>

@endsection
