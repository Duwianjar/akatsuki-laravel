@extends('dashboard.layout')

@section('konten')


<!-- ======= Hero Section ======= -->
<section id="hero2"></section>
<!-- End Hero -->

<section id="services" class="services section-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Data Murid</h2>
        </div>
        <!-- ======= awal tabel data murid ======= -->
        <table class="table table-hover table-striped table-bordered table-responsive-sm">
            <thead>
                <tr class="table-primary">
                    <th scope="col">ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Kelas</th>
                    <?php 
                    if (isset($_SESSION['admin'])||isset($_SESSION['guru']))
                        {?>
                    <th scope="col">
                        <center>Aksi</center>
                    </th>
                    <?php }?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php $ambil=$koneksi->query("SELECT * FROM murid");?>
                    <?php while($pecah = $ambil->fetch_assoc()) {?>
                <tr>
                    <th scope="row"><?php echo $pecah['id_murid'];?></th>
                    <td class="text-break">
                        <?php echo $pecah['nama_murid'];?>
                    </td>
                    <td class="text-break">
                        <?php echo $pecah['email_murid'];?>
                    </td>
                    <td class="text-break">
                        <?php echo $pecah['telepon_murid'];?>
                    </td>
                    <td class="text-break">
                        <?php echo $pecah['kelas'];?>
                    </td>
                    <?php 
                    if (isset($_SESSION['admin'])||isset($_SESSION['guru']))
                        {?>
                    <td>
                        <center>
                            <a href="hapus.php?&id=<?php echo $pecah['id_murid'];?>&hapus=murid"><INPUT TYPE="button"
                                    value="🗑️ Hapus" class="btn btn-outline-danger btn-kirim btn-sm "></a>
                            <a href="ubah.php?&id=<?php echo $pecah['id_murid'];?>&ubah=murid"><INPUT TYPE="button"
                                    value="✏️ Ubah" class="btn btn-outline-primary btn-kirim btn-sm "></a>
                        </center>
                    </td>
                    <?php }?>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <?php if (isset($_SESSION['admin'])||isset($_SESSION['guru']))
        {?>
        <tr>
            <a href="tambah.php?ke=murid"><INPUT TYPE="button" value="➕ Tambah Data"
                    class="btn btn-outline-success btn-kirim"></a>
        </tr>
        <?php }?>
    </div>
</section>
<!-- ======= akhir tabel data murid ======= -->

@endsection