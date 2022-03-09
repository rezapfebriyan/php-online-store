<?php
include 'admin/konek.php';
include 'admin/function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barkah Store</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'navbar.php'; ?>
 
<section class="konten">
    <div class="container">
        <div class="page-header">
            <h2>Produk Terbaru</h2>
        </div>

        <div class="row">
            <?php
                $data = mysqli_query($koneksi, "SELECT * FROM produk");
                while($produk = mysqli_fetch_assoc($data)) :
            ?>
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="img/<?= $produk['foto_produk']?>" alt="">
                    <div class="caption">
                        <h3><?= $produk['nama_produk']?></h3>
                        <h5><?= rupiah($produk['harga_produk'])?></h5>
                        <a href="beli.php?id=<?= $produk['id_produk']; ?>" class="btn btn-primary" onclick="return confirm('Masukan barang ke dalam keranjang?')">Beli</a>
                        <a href="detail.php?id=<?= $produk['id_produk']; ?>" class="btn btn-default">Detail</a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

</body>
</html>