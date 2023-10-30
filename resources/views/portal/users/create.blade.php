
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
                        <a class="text-primary fs-6" href="/mapel"> <span class="text-secondary">/</span> Users</a>
                        <span class="text-secondary">/ Create</span>
                    </p>
                    <p class="garis-abu-edit"></p>
                    <hr class="garis-biru-edit">
                    <form role="form" method="post" action="{{ url('/users/baru/index') }}">
                        @csrf
                        <div class="judul-edit">
                            <p>Nama Lengkap</p>
                            <input class="@error('namalengkap') is-invalid @enderror namamapel " type="text" class="form-control" name="namalengkap" placeholder="Tulis Nama Lengkap disini"/>
                        </div>
                        <div class="judul-edit">
                            <p>Telepon</p>
                            <input class="@error('telepon') is-invalid @enderror namamapel " type="number" class="form-control" name="telepon" placeholder="Tulis No Telepon disini"/>
                        </div>
                        <div class="judul-edit">
                            <p>Email</p>
                            <input class="@error('email') is-invalid @enderror namamapel " type="email" class="form-control" name="email" placeholder="Tulis email disini"/>
                        </div>
                        <div class="judul-edit">
                            <p>Password</p>
                            <input class="@error('password') is-invalid @enderror namamapel" type="text" class="form-control" name="password" placeholder="Tulis password disini"/>
                        </div>
                        <div class="judul-edit">
                            <p>Role</p>
                            <select id="pilihan_role" name="role" class="pil">
                                <option value="admin">Admin</option>
                                <option value="guru">Guru</option>
                                <option value="murid">Murid</option>
                            </select>
                        </div>
                        <div id="pilihankelas" class="judul-edit hide">
                            <p>Kelas</p>
                            <select id="pilihan_kelas" name="id_kelas" class="pil">
                                @foreach ($semuakelas as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->kelas }} {{ $kelas->namakelas }}</option>
                                @endforeach
                            </select>
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
        var selectedValue = {!! json_encode(session('lihat')) !!}; // Escape dan konversi nilai
        var selectElement = document.getElementById('pilihan_role');

        if (selectElement) { // Memeriksa apakah elemen ada
            selectElement.value = selectedValue;
        }
    </script>
    @endif
    <script>
        var pilihanRole = document.getElementById('pilihan_role');
        var pilihankelas = document.getElementById('pilihankelas');

        pilihanRole.addEventListener('change', function() {
            if (pilihanRole.value === 'murid') {
                pilihankelas.classList.remove('hide');
            } else {
                pilihankelas.classList.add('hide');
            }
        });

        // Menambah kelas hide saat halaman pertama kali dimuat
        if (pilihanRole.value !== 'murid') {
            pilihankelas.classList.add('hide');
        }
        if (pilihanRole.value === 'murid') {
            pilihankelas.classList.remove('hide');
        }
    </script>

@endsection
