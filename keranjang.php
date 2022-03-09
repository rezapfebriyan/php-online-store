<?php
session_start();
include 'admin/konek.php';
include 'admin/function.php';

if (empty($_SESSION['keranjang']) || !isset($_SESSION['keranjang'])) {
    echo "<script>
            alert('Belum ada barang di keranjang, silahkan belanja terlebih dahulu');
            document.location='index.php';
        </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barkah Store - Keranjang</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<section class="konten">
    <div class="container">
        <div class="page-header">
            <h3>Keranjang Belanja</h3>
        </div>
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
                <?php $no = 1; ?>
                <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) : ?>
                <?php 
                $tampil = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk = '$id_produk' ");
                $data = mysqli_fetch_assoc($tampil);
                $subtotal = $data['harga_produk'] * $jumlah;
                ?>
                <tr>
                    <td width='40px' align='center'><?= $no++?></td>
                    <td><?= $data['nama_produk'];?></td>
                    <td><?= rupiah($data['harga_produk']);?></td>
                    <td><?= $jumlah;?></td>
                    <td><?= rupiah($subtotal);?></td>
                    <td><a href="hapus_keranjang.php?id=<?=$id_produk?>" class="btn btn-danger"
                    onclick="return confirm('Hapus barang dari keranjang?')">Delete</a></td>
                </tr>
                <?php endforeach; ?>
        </table>
    <a class="btn btn-default" style="margin-bottom: 10px" href="index.php">Lanjutkan Belanja</a>
    <a class="btn btn-primary" style="margin-bottom: 10px" href="checkout.php">Checkout</a>
    </div>
</section>