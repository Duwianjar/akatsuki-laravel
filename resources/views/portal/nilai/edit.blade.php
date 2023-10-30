
@extends('portal.layout')

@section('konten')
<section id="services " class="services" style="background-color: #24395d !important; ;">
    <div class="container pt-5" data-aos="fade-up">
            <div id="add-row" class="container mapel-edit containerprofil pt-5  align-items-center" style="height: auto;">
            <div id="mapel" class="mapel col-md-12 p-4 bg-white rounded rounded-3 head shd-blue">
                <p class="px-2 ket fs-7 " >

                        <a class="text-primary fs-6" href="/profil">Portal</a>
                        <a class="text-primary fs-6" href="/nilai"> <span class="text-secondary">/</span> Nilai</a>
                        <span class="text-secondary">/ Edit</span>
                    </p>
                    <p class="garis-abu-edit"></p>
                    <h3 class="ttl text-center fs-3">Edit Nilai {{ $mapelpil->namamapel }} <br> {{ $muridpil->fullname }} Kelas {{ $kelas->kelas }} {{ $kelas->namakelas }}</h3>
                    <hr class="garis-biru-edit">
                    @if (!$nilai)
                    <form role="form" method="post" action="{{ url('/nilai/edit/index') }}">
                        @csrf
                        <input type="number" name="idmapel" value="{{ $mapelpil->id }}" hidden/>
                        <input type="number" name="idmurid" value="{{ $muridpil->id }}" hidden/>
                        <div class="judul-edit">
                            <p>Nilai Kehadiran</p>
                            <input class="namamapel" type="number" class="form-control" name="kehadiran" value="0"/>
                        </div>
                        <div class="judul-edit">
                            <p>Nilai Perilaku</p>
                            <input class="namamapel" type="number" class="form-control" name="perilaku" value="0"/>
                        </div>
                        <div class="judul-edit">
                            <p>Nilai Tugas</p>
                            <input class="namamapel" type="number" class="form-control" name="tugas" value="0"/>
                        </div>
                        <div class="judul-edit">
                            <p>Nilai Praktek</p>
                            <input class="namamapel" type="number" class="form-control" name="praktek" value="0"/>
                        </div>
                        <div class="judul-edit">
                            <p>Nilai UTS</p>
                            <input class="namamapel" type="number" class="form-control" name="uts" value="0"/>
                        </div>
                        <div class="judul-edit">
                            <p>Nilai UAS</p>
                            <input class="namamapel" type="number" class="form-control" name="uas" value="0"/>
                        </div>
                        <div class="judul-edit">
                            <p>Nilai Akhir</p>
                            <input class="namamapel" type="number" class="form-control" name="akhir" value="0"/>
                        </div>
                        <div class="judul-edit">
                            <button name="edit" class="edit">Simpan</button>
                        </div>
                    </form>

                    @else
                    <form role="form" method="post" action="{{ url('/nilai/edit/index') }}">
                        @csrf
                        <input type="number" name="idmapel" value="{{ $mapelpil->id }}" hidden/>
                        <input type="number" name="idmurid" value="{{ $muridpil->id }}" hidden/>
                        <div class="judul-edit">
                            <p>Nilai Kehadiran</p>
                            <input class="namamapel" type="number" class="form-control" name="kehadiran" min="0" max="100" required value="{{ $nilai->kehadiran }}"/>
                        </div>
                        <div class="judul-edit">
                            <p>Nilai Perilaku</p>
                            <input class="namamapel" type="number" class="form-control" name="perilaku" min="0" max="100" required value="{{ $nilai->perilaku }}"/>
                        </div>
                        <div class="judul-edit">
                            <p>Nilai Tugas</p>
                            <input class="namamapel" type="number" class="form-control" name="tugas" min="0" max="100" required value="{{ $nilai->tugas }}"/>
                        </div>
                        <div class="judul-edit">
                            <p>Nilai Praktek</p>
                            <input class="namamapel" type="number" class="form-control" name="praktek" min="0" max="100" required value="{{ $nilai->praktek }}"/>
                        </div>
                        <div class="judul-edit">
                            <p>Nilai UTS</p>
                            <input class="namamapel" type="number" class="form-control" name="uts" min="0" max="100" required value="{{ $nilai->uts }}"/>
                        </div>
                        <div class="judul-edit">
                            <p>Nilai UAS</p>
                            <input class="namamapel" type="number" class="form-control" name="uas" min="0" max="100" required value="{{ $nilai->uas }}"/>
                        </div>
                        <div class="judul-edit">
                            <p>Nilai Akhir</p>
                            <input class="namamapel" type="number" class="form-control" name="akhir" min="0" max="100" required value="{{ $nilai->akhir }}"/>
                        </div>
                        <div class="judul-edit">
                            <button name="edit" class="edit">Simpan</button>
                        </div>
                    </form>
                    @endif

                </div>
        </div>
    </div>

    <div class="detailmapelsection"></div>
    </section>


@endsection
