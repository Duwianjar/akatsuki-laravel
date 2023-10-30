@extends('dashboard.layout')

@section('konten')


<!-- ======= Hero Section ======= -->
<section id="hero2"></section>

<!-- End Hero -->

<section id="services" class="services section-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Data Guru</h2>
        </div>
        <!-- ======= awal tabel data guru ======= -->
        <table class="table table-hover table-striped table-bordered">
            <thead>
                <tr class="table-primary">
                    <th scope="col">ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Mengajar</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php $ambil=$koneksi->query("SELECT * FROM guru");?>
                    <?php while($pecah = $ambil->fetch_assoc()) {?>
                <tr>
                    <th scope="row"><?php echo $pecah['id_guru'];?></th>
                    <td class="text-break">
                        <?php echo $pecah['nama_guru'];?>
                    </td>
                    <td class="text-break">
                        <?php echo $pecah['email_guru'];?>
                    </td>

                    <td class="text-break">
                        <?php echo $pecah['telepon_guru'];?>
                    </td>
                    <td class="text-break">
                        <?php echo $pecah['Mengajar'];?>
                    </td>
                
                </tr>
                <?php }?>
            </tbody>
        </table>
        
    </div>
</section>

@endsection