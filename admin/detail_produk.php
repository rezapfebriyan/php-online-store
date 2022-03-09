<?php
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}
include 'function.php'; 
?>

<div class="page-header">
    <h2>Detail Produk</h2>
</div>

<?php
$id_produk = $_GET['id'];
$tampil = mysqli_query($koneksi, "SELECT * FROM produk LEFT JOIN kategori ON 
                                                produk.id_kategori=kategori.id_kategori 
                                                WHERE id_produk = '$id_produk'");
$data = mysqli_fetch_assoc($tampil);

$foto_produk = []; // default
$tampil_foto = mysqli_query($koneksi, "SELECT * FROM produk_foto WHERE id_produk = '$id_produk'");
while ($data_foto = mysqli_fetch_assoc($tampil_foto)) {
    $foto_produk[] = $data_foto; // masukan data_foto ke array kosong
}

if(isset($_POST['tambah'])){

    $namaFoto = $_FILES['produk_foto']['name'];
    $lokasiFoto = $_FILES['produk_foto']['tmp_name'];
    move_uploaded_file($lokasiFoto, "../img/" .$namaFoto);
    
    $tambah = mysqli_query($koneksi,"INSERT INTO produk_foto VALUES
                            (null, '$id_produk', '$namaFoto')");
    
    if($tambah) {
        echo "<script>
                alert('Foto terbaru berhasil ditambahkan');
                document.location='?hal=detail_produk&id=$id_produk';
            </script>"; 
    } else {
        echo mysqli_error($koneksi);
    }
}
?>

<table class="table table-bordered">
    <tr>
        <th>Kategori</th>
        <td><?= $data['nama_kategori'] ?></td>
    </tr>
    <tr>
        <th>Nama Barang</th>
        <td><?=  $data['nama_produk'] ?></td>
    </tr>
    <tr>
        <th>Harga</th>
        <td><?=  rupiah($data['harga_produk']) ?></td>
    </tr>
    <tr>
        <th>Berat</th>
        <td><?=  $data['berat'] ?> g</td>
    </tr>
    <tr>
        <th>Jumlah</th>
        <td><?=  $data['stok_produk'] ?></td>
    </tr>
    <tr>
        <th>Deskripsi</th>
        <td><?=  $data['deskripsi'] ?></td>
    </tr>
</table>

<div class="row">

    <?php foreach ($foto_produk as $key => $value) : ?>
        <div class="col-md-3 text-center">
            <img src="../img/<?= $value['nama_produk_foto']?>" class="img-responsive"> <br>
            <a href="hapus_foto_produk.php?id_foto=<?= $value['id_produk_foto'] ?>&id_produk=<?= $id_produk ?>" class="btn btn-danger">Hapus</a>
        </div>
    <?php endforeach; ?>
    
</div>
<div style="margin-top: 40px;">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="file" name="produk_foto" required>
        </div>
        <button class="btn btn-primary btn-tambah" name="tambah">
            <i class="fa fa-plus"> Tambah foto</i>
        </button>
    </form>
</div>