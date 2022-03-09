<?php
session_start();
include 'admin/konek.php';
include 'admin/function.php';

$id_produk = $_GET['id'];
$tampil_produk = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk = '$id_produk' ");
$produk = mysqli_fetch_assoc($tampil_produk);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barkah Store - Detail Produk</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<section class="konten">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="img/<?= $produk['foto_produk']?>" class="img-responsive">
            </div>
            <div class="col-md-6">
                <h2><?= $produk['nama_produk']; ?></h2>
                <h4><?= rupiah($produk['harga_produk']); ?></h4>

                <h4>Stok : <?= $produk['stok_produk']; ?></h4>

                <form method="POST">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="number" min="1" class="form-control" name="jumlah" max="<?= $produk['stok_produk']; ?>">
                        </div>
                    </div>
                    <?php
                    if(isset($_POST['beli'])) {

                        // ambil jumlah yg dipilih di form
                        $jumlah = $_POST['jumlah'];

                        // masukan ke keranjang
                        $_SESSION['keranjang'][$id_produk] = $jumlah;
                        
                        header('Location: keranjang.php');
                    }
                    ?>
                    <button class="btn btn-primary" name="beli">Beli</button>
                </form>
                <p><?= $produk['deskripsi']; ?></p>
        </div>
    </div>
</section>