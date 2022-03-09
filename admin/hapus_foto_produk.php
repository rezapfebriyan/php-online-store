<?php
include 'konek.php';
$id_foto = $_GET['id_foto'];
$id_produk = $_GET['id_produk'];

// perintah untuk menghapus foto di folder img
$tampil = mysqli_query($koneksi, "SELECT * FROM produk_foto WHERE id_produk_foto='$id_foto'");
$data_produk_foto = mysqli_fetch_assoc($tampil);
$file_foto = $data_produk_foto['nama_produk_foto']; // ambil file nama_produk_foto, lalu tarok di var

if (file_exists("../img/$file_foto")) {
    unlink("../img/$file_foto"); // hapus fotonya
}

// menghapus foto di db
$hapus = mysqli_query($koneksi, "DELETE FROM produk_foto WHERE id_produk_foto = '$id_foto'");

if($hapus) {
    echo "<script>
            alert('Foto berhasil dihapus');
            document.location='?hal=detail_produk&id=$id_produk';
        </script>";
}