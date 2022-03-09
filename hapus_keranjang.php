<?php
session_start();
$id_produk = $_GET['id'];
unset($_SESSION['keranjang'][$id_produk]);
echo "<script>
        alert('Barang telah dihapus dari keranjang');
        document.location='keranjang.php';
    </script>";