<?php
session_start();
include 'admin/konek.php';
include 'admin/function.php';
if(!isset($_SESSION['user'])){
	echo "<script>
            alert('Silahkan login terlebih dahulu');
            document.location='login.php';
        </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barkah Store - Nota Pembelian</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<section class="konten">
    <div class="container">
        <?php 
            // mengambil data pembelian
            $tampil = mysqli_query($koneksi,"SELECT * FROM pembelian JOIN pelanggan
                                            ON pembelian.id_pelanggan=pelanggan.id_pelanggan
                                            WHERE pembelian.id_pembelian='$_GET[id]' ");
            $data_beli = mysqli_fetch_array($tampil);
        ?>

        <!-- agar user tidak bisa melihat nota user lain -->
        <?php
        $user_nota = $data_beli['id_pelanggan'];
        $user_login = $_SESSION['user']['id_pelanggan'];

        if ($user_nota !== $user_login) {
            echo "<script>
                    alert('Anda tidak dapat mengakses halaman ini');
                    document.location='riwayat.php';
                </script>";
        }
        ?>

        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h4><strong>Data Pembelian</strong></h4>
                Nomor Pembelian: <?=$data_beli['id_pembelian'] ?><br>
                Tanggal : <?= date("d F Y", strtotime($data_beli['tanggal_beli'])); ?><br>
                Total   : <?= rupiah($data_beli['total_beli']); ?>
            </div>
            <div class="col-md-4">
                <h4><strong>Data Pembeli</strong></h4>
                Nama Pembeli : <?= $data_beli['nama_pelanggan']; ?><br>
                <p>
                Nomor Ponsel : <?= $data_beli['telepon']; ?><br>
                Alamat Email : <?= $data_beli['email']; ?>
                </p>
            </div>
            <div class="col-md-4">
                <h4><strong>Data Pengiriman</strong></h4>
                Tujuan : <?= $data_beli['tipe']." ".$data_beli['distrik']; ?><br>
                Ongkos Kirim : <?= rupiah($data_beli['ongkir']); ?><br>
                Ekspedisi : <?= $data_beli['ekspedisi']." | ".$data_beli['paket']." | ".$data_beli['estimasi']." hari"; ?><br>
                Alamat : <?= $data_beli['alamat_pengiriman']; ?>
            </div>
        </div>

        <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Berat</th>
                    <th>Jumlah</th>
                    <th>Subberat</th>
                    <th>Total Pembelian</th>
                </tr>
            <?php 
                $tampil = mysqli_query($koneksi,"SELECT * FROM pembelian_produk
                                                WHERE id_pembelian='$_GET[id]' ");
                $no = 1;
                while($data = mysqli_fetch_array($tampil)) :
            ?>
                <tr>
                    <td width='40px' align='center'><?= $no++ ?></td>
                    <td><?= $data['nama']; ?></td>
                    <td><?= rupiah($data['harga']); ?></td>
                    <td><?= $data['berat']; ?> gr</td>
                    <td><?= $data['jumlah']; ?></td>
                    <td><?= $data['sub_berat'];?> gr</td>
                    <td><?= rupiah($data['sub_harga']);?></td>
                </tr>
                <?php endwhile; ?>
        </table>
        
        <div class="row">
            <div class="col-md-7">
                <div class="alert alert-info">
                    <p>Silahkan lalukan pembayaran sebesar <?= rupiah($data_beli['total_beli']); ?></p>
                    <strong>BANK BCA 137-004098-7868 A.N Reza Putra Febriyan</strong>
                </div>
            </div>
        </div>

    </div>
</section>

</body>
</html>