<?php include 'admin/konek.php' ?>
<?php include 'admin/function.php' ?>
<?php $cari = $_GET['cari'];

$semua_data = []; // default
// cari nama/deskripsi produk berdasarkan apa yg ada di $cari
$tampil = mysqli_query($koneksi,"SELECT * FROM produk WHERE nama_produk LIKE '%$cari%' OR deskripsi LIKE '%$cari%' ");
while($produk = mysqli_fetch_assoc($tampil)) {
    $semua_data[] = $produk; // masukkan ke array kosong
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berkah Store - Pencarian</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'navbar.php'; ?>

    <div class="container">
        <div class="page-header text-center">
            <h3>Hasil pencarian <strong>"<?= $cari?>"</strong> </h3>
        </div>
        
        <?php if (empty($semua_data)) : ?>
            <div class="alert alert-danger text-center">
                Hasil pencarian <strong>"<?= $cari?>"</strong> tidak ditemukan
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- tampilkan pake foreach karna data dimasukan ke array assosiatif -->
            <?php foreach ($semua_data as $key => $value) :?> 
                <div class="col-md-3">
                    <div class="thumbnail">
                        <img src="img/<?= $value['foto_produk']?>" alt="image">
                        <div class="caption">
                            <h3><?= $value['nama_produk']?></h3>
                            <h5><?= rupiah($value['harga_produk'])?></h5>
                            <a href="beli.php?id=<?= $value['id_produk']; ?>" class="btn btn-primary" onclick="return confirm('Masukan barang ke dalam keranjang?')">Beli</a>
                            <a href="detail.php?id=<?= $value['id_produk']; ?>" class="btn btn-default">Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>