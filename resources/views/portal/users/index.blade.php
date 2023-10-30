
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
                        <a class="text-primary fs-6" href="/profil">Portal</a> / Users
                    </p>
                    <h3 class="ttl text-center fs-3">Daftar Users</h3>
                    <hr class="garis-biru">
                    <label for="pilihan" class="mx-1 my-3">Role User</label>
                    <select id="pilihanuser" class="mt-2 mx-1" onchange="checkSelection()">
                        <option value="pilih">Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="guru">Guru</option>
                        <option value="murid">Murid</option>
                    </select>

                    <div id="kelasDiv" class="" style="display: none;">
                        <label for="kelas" class="mx-1 my-3">Kelas&emsp;&emsp;</label>
                        <select id="pilihankelas" class="mt-2 mx-1" onchange="checkSelection()">
                            <option value="pilih">Pilih Kelas</option>
                            @foreach ($semuakelas as $kelas)
                            <option value="{{ $kelas->id }}">{{ $kelas->kelas }} {{ $kelas->namakelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button id="btnadmin" onclick="tampilkanPencarianAdmin()"  class="mx-1 mt-2 tampilkanpilihan" style="display: none;">Lihat Data Admin</button>
                    <button id="btnguru" onclick="tampilkanPencarianGuru()"  class="mx-1 mt-2 tampilkanpilihan" style="display: none;">Lihat Data Guru</button>
                    <button id="btnmurid" onclick="tampilkanPencarianMurid()"  class="mx-1 mt-2 tampilkanpilihan" style="display: none;">Lihat Data Murid</button>
                    @if (session('lihat'))
                    @if (!isset($users))
                    @else

                    @endif
                    @endif
                    <div class="table-responsive">
                        <table class="table col-12 mt-3">
                        <thead class="fs-6 ">
                            <tr>
                                <th>&emsp;#</th>
                                <th>Nama Lengkap</th>
                                <th>Telepon </th>
                                <th>Email </th>
                                <th>Role </th>
                                @if (session('lihatusermurid'))
                                    <th>Kelas</th>
                                @endif
                                <th>Aksi </th>
                            </tr>
                        </thead>
                        <tbody class="fs-6">
                            @if (session('lihat'))
                            @if (!isset($users))
                            @else
                            @foreach ($users as $lihatuser)
                                <tr class="abu">
                                    <td>&emsp;{{ $loop->iteration }}</td>
                                    <td>{{ $lihatuser->fullname }}</td>
                                    <td>{{ $lihatuser->telepon }}</td>
                                    <td>{{ $lihatuser->email }}</td>
                                    <td>{{ $lihatuser->role }}</td>
                                    @if (session('lihatusermurid'))
                                        @foreach ($semuakelas as $kelas)
                                            @if ($kelas->id == $lihatuser->id_kelas)
                                                <td>{{ $kelas->kelas }} {{ $kelas->namakelas }}</td>
                                            @endif
                                        @endforeach
                                    @endif
                                    <td>
                                        @php
                                            $id=$lihatuser->id;
                                            $encryptedId = Crypt::encrypt($id);
                                        @endphp
                                        <a href="/users/edit/{{$encryptedId}}" id="ubahLink">
                                            <button class="btn-edit"><i class="bi bi-pencil-square"></i></button>
                                        </a>
                                        <a href="/users/delete/{{$encryptedId}}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <button class="btn-delete"><i class="bi bi-trash"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            @endif
                        </tbody>
                    </table>
                    @if (session('lihat'))
                    @if (!isset($users))
                    @else
                    <div class="pgnt">
                        {{ $users->links() }}
                    </div>
                    <button onclick="tambahuser()"  class="mx-2 mt-1 mb-3 tambahmapel">Tambah User</button>
                    @endif
                    @endif
            </div>
        </div>
    </div>
    </div>

    <div class="mapelsection"></div>
</section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("pilihanuser").value = "pilih";
            document.getElementById("pilihankelas").value = "pilih";
        });
        function checkSelection() {
                var selectedValue = document.getElementById("pilihanuser").value;
                var selectedValueKelas = document.getElementById("pilihankelas").value;
                var kelasDiv = document.getElementById("kelasDiv");
                var BTNAdmin = document.getElementById("btnadmin");
                var BTNGuru = document.getElementById("btnguru");
                var BTNMurid = document.getElementById("btnmurid");

                if (selectedValue === "murid"&&selectedValueKelas ==="pilih")
                {
                    kelasDiv.style.display = "block";
                    BTNMurid.style.display = "none";
                    BTNAdmin.style.display = "none";
                    BTNGuru.style.display = "none";
                }
                if (selectedValue === "murid"&&selectedValueKelas !=="pilih")
                {
                    kelasDiv.style.display = "block";
                    BTNMurid.style.display = "block";
                    BTNAdmin.style.display = "none";
                    BTNGuru.style.display = "none";
                }
                if (selectedValue === "admin")
                {
                    kelasDiv.style.display = "none";
                    BTNMurid.style.display = "none";
                    BTNAdmin.style.display = "block";
                    BTNGuru.style.display = "none";
                }
                if (selectedValue === "guru")
                {
                    kelasDiv.style.display = "none";
                    BTNMurid.style.display = "none";
                    BTNAdmin.style.display = "none";
                    BTNGuru.style.display = "block";
                }
                if (selectedValue === "pilih")
                {
                    kelasDiv.style.display = "none";
                    BTNMurid.style.display = "none";
                    BTNAdmin.style.display = "none";
                    BTNGuru.style.display = "none";
                }
            }
        function tampilkanPencarianAdmin() {
            var url = "/users/admin";
            window.location.href = url;
        }
        function tampilkanPencarianGuru() {
            var url = "/users/guru";
            window.location.href = url;
        }
        function tampilkanPencarianMurid() {
            var selectedValue = document.getElementById("pilihankelas").value;
            var url = "/users/murid/" + selectedValue;
            window.location.href = url;
        }
        function tambahuser() {
            var url = "/users/baru";
            window.location.href = url;
        }
    </script>
    </section>

@endsection
