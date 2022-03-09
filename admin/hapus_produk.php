<?php
if (!isset($_SESSION['admin'])) {
    header('location:login.php');
}

$tampil = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$data = mysqli_fetch_array($tampil);
$foto_produk = $data['foto_produk'];
if (file_exists("../img/$foto_produk")) {
    unlink("../img/$foto_produk"); // hapus fotonya
}

$hapus = mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk='$_GET[id]'");

if($hapus) {
    echo "<script>
            alert('Data berhasil dihapus');
            document.location='?hal=produk';
        </script>";
}