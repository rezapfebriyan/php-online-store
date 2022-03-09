<?php
session_start();
$id = $_GET['id'];
// kalo ada produk (yg sama) dikeranjang, maka produk +1 (1 = dari keranjang)
// buat session keranjang buat nyimpan id_produk
if (isset($_SESSION['keranjang'][$id]) ) {
    $_SESSION['keranjang'][$id] +=1;
} else {
    $_SESSION['keranjang'][$id] = 1;
}

header('Location: keranjang.php');